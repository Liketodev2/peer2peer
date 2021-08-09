@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            <a href="{{route('dashboard.feeds.create')}}"><button class="btn btn-primary">Create</button></a>
                            <div class="row d-flex justify-content-end mr-4">
                                <form action="{{route('dashboard.feeds.index')}}" method="GET" >
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
                                    <table  class="table table-striped" >
                                        <thead class="thead-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Creator</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->category->name}}</td>
                                                <td>{{$item->user->company_name ? $item->user->company_name : $item->user->first_name .' '. $item->user->last_name}}</td>
                                                <td>
                                                  <div>
                                                      <a href="{{route('dashboard.feeds.edit', $item->id)}}"><button class="btn btn-light btn-sm w-60"><i class="fas fa-edit"></i></button></a>
                                                      <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                                      <form action="{{route('dashboard.feeds.destroy',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                          @method('DELETE')
                                                          @csrf
                                                      </form>
                                                  </div>
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
