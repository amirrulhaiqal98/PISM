@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
</script>

<link href="https://gitcdn.github.io/bootstrap-toogle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Application</h6>
                        <form method="POST" action="{{route('update.application',$approvals->id)}}" class="forms-sample">
                        @csrf
 
                        <input type="hidden" name="id" value="{{$approvals->id}}">

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Program Description</label>
                            <input id="desc" type="text" name="desc" class="form-control" value="{{$approvals->description}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Request Budget</label>
                            <input type="number" name="budget_request" class="form-control" value="{{$approvals->budget_request}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control" value="{{$approvals->venue}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Total Participants</label>
                            <input type="number" name="participant" class="form-control" value="{{$approvals->participant}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Start Date</label>
                            <input id="start_date" type="date" name="start_date" class="form-control" value="{{$approvals->start_date}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">End Date</label>
                            <input id="end_date" type="date" name="end_date" class="form-control" value="{{$approvals->start_date}}">
                        </div>

                        <div class="form-group mb-3" id="advisor_approval_label">
                            <label for="exampleInputEmail1" class="form-label">Advisor Approval</label>
                            <select id="advisor_approval" name="advisor_approval" class="form-select" id="exampleFormControlSelect1">
                                {{-- <option selected="" disabled="">PENDING</option> --}}
                                <option value="PENDING" {{$approvals->advisor_approval =='PENDING' ? 'selected' : ''}}>PENDING</option>
                                <option value="APPROVED" {{$approvals->advisor_approval =='APPROVED' ? 'selected' : ''}}>APPROVED</option>
                                <option value="REJECTED" {{$approvals->advisor_approval =='REJECTED' ? 'selected' : ''}}>REJECTED</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="remark_label">
                            <label for="exampleInputEmail1" class="form-label">Remark</label>
                            <input id="remark" type="text" name="remark" class="form-control" value="{{$approvals->remark}}">
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var isAdvisor = {!! json_encode($is_advisor) !!}; // Assuming $is_advisor is a boolean value
        
        console.log("isAdvisor value:", isAdvisor); // Debug statement

        if (isAdvisor == 1) {
            $("#advisor_approval_label").show(); // Show the label with ID "advisor_approval"
            $("#remark_label").show(); // Show the label with ID "advisor_approval"
        } else {
            $("#advisor_approval_label").hide(); // Hide the label with ID "advisor_approval"
            $("#remark_label").hide(); // Hide the label with ID "advisor_approval"
        }

    $("form").submit(function(event) {
        var advisorApproval = $("#advisor_approval").val();
        var remark = $("#remark").val();
        // console.log(remark);debugger

        if (advisorApproval == "REJECTED" && remark.trim() === "") {
            event.preventDefault(); // Prevent form submission

            // Display an error message or perform any desired action
            alert("Please provide a remark for the rejected application.");
        }
    });
});
</script>

@endsection