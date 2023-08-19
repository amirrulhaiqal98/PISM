@extends('admin.admin_dashboard')
@section('admin')
    
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
<a href="{{route('add.application')}}" class="btn btn-inverse-info"> Add Application </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Application</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table"></div>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Request From</th>
                                <th>Description</th>
                                <th>Budget</th>
                                <th>Venue</th>
                                <th>Created At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $key => $item)
							{{-- <@php
								print_r($item);die;
							@endphp --}}
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->budget}}</td>
                                <td>{{$item->venue}}</td>
                                <td>{{($item->created_at)->format('d-m-Y')}}</td>
                                <td class="@if($item->status === 'pending') badge bg-danger @endif">
                                    {{ $item->status }}
                                </td>
                                {{-- <td>
                                    <a href="{{route('edit.permission',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                                    <a href="{{route('delete.permission',$item->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
                                </td> --}}
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