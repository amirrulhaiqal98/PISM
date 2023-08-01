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

                        <form action="{{route('store.permission')}}" class="forms-sample" id="myForm" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Permission Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Group Name</label>
                            <select name="group_name" class="form-select" id="exampleFormControlSelect1">
                                <option selected="" disabled="">Select Group</option>
                                <option value="SAHABATYADIM">Sahabat YADIM</option>
                                <option value="SAHAM">SAHAM</option>
                                <option value="MyV">MyV</option>
                                <option value="ILHAM">ILHAM</option>
                                <option value="PERKIM">PERKIM</option>
                                <option value="MYUSRAH">MYUSRAH</option>
                                <option value="KELAB">KELAB</option>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules:{
                amenities_name:{
                    required : true,
                },
            
            },
            messages :{
                amenities_name:{
                    required : 'Please Enter Amenities Name',
                },
            },
            errorElement : 'span',
            errorPlacement : function(error,element){
                error.addClass('invalid-feedback');
                elemt.closet('.from-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

@endsection