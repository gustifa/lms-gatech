@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Category</li>
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
        <a href="{{route('add.category')}}" class="btn btn-primary">Add Category</a>
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
                            <th style="width: 70px;">Category Image</th>
                            <th>Category Name</th>
                            <th style="width: 20px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{asset($item->image)}}" alt="" style="height: 70px" width="70px" >
                            </td>
                            <td>{{$item->category_name}}</td>
                            <td>
                                <a href="{{route('edit.category',$item->id)}}" class="px-5 btn btn-primary">Edit</a>
                                <a href="{{route('delete.category',$item->id)}}" id="delete" class="px-5 btn btn-danger">Delete</a>
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