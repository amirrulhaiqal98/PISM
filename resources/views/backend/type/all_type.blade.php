@extends('admin.admin_dashboard')
@section('admin')
@php
 use App\Models\User;
@endphp

<div class="page-content">
				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
                        <a href="{{route('add.type')}}" class="btn btn-inverse-info">Add Club</a>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">SENARAI KELAB</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>S1</th>
                        <th>Type Name</th>
                        <th>Club Description</th>
                        <th>Club Email</th>
                        <th>Advisor Club</th>
                        <th>President Club</th>
                        <th>Secreatry Club</th>
                        <th>Treasury Club</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->type_name}}</td>
                            <td>{{$item->club_description}}</td>
                            <td>{{$item->club_email}}</td>
                            <td>
                              @if ($item->advisor)
                                  @if ($item->advisor->name)
                                      {{ $item->advisor->name }}
                                  @else
                                    Advisor Name Not Available
                                  @endif
                              @else
                                  Advisor Not Assigned
                              @endif
                            </td>
                            <td>
                              @if ($item->president)
                                  @if ($item->president->name)
                                      {{ $item->president->name }}
                                  @else
                                      President Name Not Available
                                  @endif
                              @else
                                  President Not Assigned
                              @endif
                            </td>
                            <td>
                              @if ($item->secretary)
                                  @if ($item->secretary->name)
                                      {{ $item->secretary->name }}
                                  @else
                                      Secretary Name Not Available
                                  @endif
                              @else
                                  Secretary Not Assigned
                              @endif
                            </td>
                            <td>
                              @if ($item->treasurer)
                                  @if ($item->treasurer->name)
                                      {{ $item->treasurer->name }}
                                  @else
                                      Treasurer Name Not Available
                                  @endif
                              @else
                                  Treasurer Not Assigned
                              @endif
                            </td>
                            <td>
                              @if(Auth::user()->can('club.update'))
                                <a href="{{route('edit.type',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                                @endif
                              @if(Auth::user()->can('club.delete'))
                                <a href="{{route('delete.type',$item->id)}}" class="btn btn-inverse-danger" id="delete" >Delete</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>

@endsection