@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
</script>
    
<div class="page-content">

    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Permission</h6>

                        <form action="{{route('update.permission')}}" class="forms-sample" id="myForm" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{$permission->id}}">

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Permission Name</label>
                            <input type="text" name="name" class="form-control" value="{{$permission->name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Group Name</label>
                            <select name="group_name" class="form-select" id="exampleFormControlSelect1">
                                <option selected="" disabled="">Select Group</option>
                                <option value="SAHABATYADIM" {{$permission->group_name == 'SAHABATYADIM' ? 'selected' : ''}}>Sahabat YADIM</option>
                                <option value="SAHAM" {{$permission->group_name == 'SAHAM' ? 'selected' : ''}}>SAHAM</option>
                                <option value="MyV" {{$permission->group_name == 'MyV' ? 'selected' : ''}}>MyV</option>
                                <option value="ILHAM" {{$permission->group_name == 'ILHAM' ? 'selected' : ''}}>ILHAM</option>
                                <option value="PERKIM" {{$permission->group_name == 'PERKIM' ? 'selected' : ''}}>PERKIM</option>
                                <option value="MYUSRAH" {{$permission->group_name == 'MYUSRAH' ? 'selected' : ''}}>MYUSRAH</option>
                            </select>
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