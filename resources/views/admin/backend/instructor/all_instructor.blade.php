@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Sub Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Sub Category</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="mb-3">
        <a href="{{route('add.instructor')}}" class="btn btn-primary">Add Instructor</a>
    </div>
    {{-- <hr/>
    <h6 class="mb-0 text-uppercase">Data Category</h6>
    <hr /> --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5px;">No</th>
                            <th>Instructor Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allInstructor as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            
                            <td>
                                @if ($item->status == 1)
                                    <span class="btn btn-success">Active</span>
                                @else
                                    <span class="btn btn-danger">InActive</span>
                                @endif
                            </td>
                            <td>
                                <a href="" class="px-2 btn btn-primary">Edit</a>
                                <a href="" id="delete" class="px-2 btn btn-danger">Delete</a>
                            </td>
                            
                        </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>


@endsection