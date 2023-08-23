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
                            <input type="text" name="desc" class="form-control" value="{{$approvals->description}}">
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
                            <input type="date" name="start_date" class="form-control" value="{{$approvals->start_date}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{$approvals->start_date}}">
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection