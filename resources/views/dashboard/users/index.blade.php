@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            <a href="{{route('dashboard.users.create')}}"><button class="btn btn-primary">Create</button></a>
                            <div class="row d-flex justify-content-end mr-4">
                                <form action="{{route('dashboard.users.index')}}" method="GET" >
                                    @csrf
                                    <div class="d-flex">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  name="search" value="">
                                        </div>
                                        <div class="form-group ml-2">
                                            <button class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row mt-4" >
                                <div class="col-12 ">
                                    <table  class="table table-striped service-datatable" >
                                        <thead class="thead-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Author</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->first_name}}</td>
                                                <td>{{$item->last_name}}</td>
                                                <td>{{$item->company_name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>
                                                    <a href="{{route('dashboard.users.show', $item->id)}}"><button class="btn btn-light w-60 btn-sm"><i class="fas fa-info text-primary"></i></button></a>
                                                    <a href="{{route('dashboard.users.edit', $item->id)}}"><button class="btn btn-light btn-sm w-60"><i class="fas fa-edit"></i></button></a>
                                                    <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                                    <form action="{{route('dashboard.users.destroy',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-start mt-4">
                                        {{$items->links('pagination::bootstrap-4')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
