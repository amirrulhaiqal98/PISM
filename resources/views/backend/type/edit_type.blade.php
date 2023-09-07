@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-content">

        
        <div class="row profile-body">

          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
      
                        <h6 class="card-title">Edit Club</h6>

                        <form method="POST" action="{{route('update.type')}}" class="forms-sample">
                          @csrf
        
                            <input type="hidden" name="id" value="{{$types->id}}">
                        
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Club Name</label>
                                <input type="text" name="type_name" class="form-control
                                @error('type_name') is-invalid @enderror" value="{{$types->type_name}}">
                                @error('type_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Club Description</label>
                                <input type="text" name="club_description" class="form-control
                                @error('club_description') is-invalid @enderror" value="{{$types->club_description}}">
                                @error('club_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                              <label for="exampleInputUsername1" class="form-label">Club Email</label>
                              <input type="email" name="club_email" class="form-control
                              @error('club_email') is-invalid @enderror" value="{{$types->club_email}}">
                              @error('club_email')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>

                          <div class="form-group mb-3">
                            <label for="exampleInputEmail1" class="form-label">Advisor Name</label>
                            <select name="advisor_id" class="form-select" id="exampleFormControlSelect1">
                                <option selected disabled>Select Advisor</option>
                                @foreach ($advisorIds as $advisorId)
                                    <option value="{{$advisorId->id}}" {{$types->advisor_id == $advisorId->id ? 'selected' : ''}}>
                                        {{$advisorId->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                          <div class="mb-3">
                              <label for="exampleInputUsername1" class="form-label">President ID</label>
                              <input type="text" name="president_id" class="form-control
                              @error('president_id') is-invalid @enderror" value="{{$types->president_id}}">
                              @error('president_id')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="exampleInputUsername1" class="form-label">Secretary ID</label>
                              <input type="text" name="secretary_id" class="form-control
                              @error('secretary_id') is-invalid @enderror" value="{{$types->secretary_id}}">
                              @error('secretary_id')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="exampleInputUsername1" class="form-label">Treasury ID</label>
                              <input type="text" name="treasurer_id" class="form-control
                              @error('treasurer_id') is-invalid @enderror" value="{{$types->treasurer_id}}">
                              @error('treasurer_id')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                           

                            <button type="submit" class="btn btn-primary me-2">Save Changes </button>
                        </form>
      
                    </div>
                  </div>

            </div>
          </div>
          <!-- middle wrapper end -->
          <!-- right wrapper start -->
          <!-- right wrapper end -->
        </div>

			</div>

@endsection