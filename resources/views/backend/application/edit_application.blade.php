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
                                <option selected="" disabled="">Select Status</option>
                                {{-- <option value="PENDING" {{$approvals->advisor_approval =='PENDING' ? 'selected' : ''}}>PENDING</option> --}}
                                <option value="APPROVED" {{$approvals->advisor_approval =='APPROVED' ? 'selected' : ''}}>APPROVED</option>
                                <option value="REJECTED" {{$approvals->advisor_approval =='REJECTED' ? 'selected' : ''}}>REJECTED</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="remark_label_advisor">
                            <label for="exampleInputEmail1" class="form-label">Remark</label>
                            <input id="remark_advisor" type="text" name="remark_advisor" class="form-control" value="{{$approvals->advisor_remark}}">
                        </div>

                        <div class="form-group mb-3" id="director_approval_label">
                            <label for="exampleInputEmail1" class="form-label">Director Approval</label>
                            <select id="director_approval" name="director_approval" class="form-select" id="exampleFormControlSelect1">
                                {{-- <option selected="" disabled="">PENDING</option> --}}
                                <option value="PENDING" {{$approvals->director_approval =='PENDING' ? 'selected' : ''}}>PENDING</option>
                                <option value="APPROVED" {{$approvals->director_approval =='APPROVED' ? 'selected' : ''}}>APPROVED</option>
                                <option value="REJECTED" {{$approvals->director_approval =='REJECTED' ? 'selected' : ''}}>REJECTED</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="remark_label_director">
                            <label for="exampleInputEmail1" class="form-label">Remark</label>
                            <input id="remark_director" type="text" name="remark_director" class="form-control" value="{{$approvals->director_remark}}">
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
        var isDirector = {!! json_encode($is_director) !!}; // Assuming $is_advisor is a boolean value
        
        console.log("isAdvisor value:", isAdvisor); // Debug statement
        console.log("isDirector value:", isDirector); // Debug statement

        if (isAdvisor == 1) {
            $("#advisor_approval_label").show(); // Show the label with ID "advisor_approval"
            $("#remark_label_advisor").show(); // Show the label with ID "advisor_approval"
        } else {
            $("#advisor_approval_label").hide(); // Hide the label with ID "advisor_approval"
            $("#remark_label_advisor").hide(); // Hide the label with ID "advisor_approval"
        }

        if (isDirector  == 1) {
            $("#advisor_approval_label").show(); // Show the label with ID "advisor_approval"
            $("#remark_label_advisor").show(); // Show the label with ID "advisor_approval"
            $("#remark_advisor").prop("disabled", true);
            $("#director_approval_label").show(); // Show the label with ID "director_approval"
            // $("#remark_director").val("");
            $("#remark_label_director").show(); // Show the label with ID "director_approval"
        } else {
            $("#director_approval_label").hide(); // Hide the label with ID "director_approval"
            $("#remark_label_director").hide(); // Hide the label with ID "director_approval"
        }


    $("form").submit(function(event) {
        var advisorApproval = $("#advisor_approval").val();
        var directorApproval = $("#director_approval").val();
        var advisorRemark = $("#remark_advisor").val();
        var directorRemark = $("#remark_director").val();

        // Enable the remark_advisor & remark_director field before form submission
        $("#remark_advisor").prop("disabled", false);
        $("#remark_director").prop("disabled", false);
        $("#advisor_approval").prop("disabled", false);
        $("#director_approval").prop("disabled", false);

        if ((advisorApproval == "REJECTED" && advisorRemark.trim() === "") || (directorApproval == "REJECTED" && directorRemark.trim() === "")) {
            event.preventDefault(); // Prevent form submission

            // Display an error message or perform any desired action
            alert("Please provide a remark for the rejected application.");
        }
    });

    // Disable the advisor_approval field if the value is "REJECTED" or "APPROVED"
    var advisorApprovalValue = {!! json_encode($approvals->advisor_approval) !!};
    var directorApprovalValue = {!! json_encode($approvals->director_approval) !!};
    console.log("advisorApprovalValue value:", advisorApprovalValue); // Debug statement
    console.log("directorApprovalValue value:", directorApprovalValue); // Debug statement
 
    if (advisorApprovalValue === "REJECTED" || advisorApprovalValue === "APPROVED") {
        $("#advisor_approval").prop("disabled", true);
        $("#remark_advisor").prop("disabled", true);
    }else{
        $("#director_approval").prop("disabled", true);
        $("#remark_director").prop("disabled", true);
    }

    if (directorApprovalValue === "REJECTED" || directorApprovalValue === "APPROVED") {
        $("#director_approval").prop("disabled", true);
        $("#remark_advisor").prop("disabled", true);
        $("#remark_director").prop("disabled", true);

    }
});
</script>

@endsection