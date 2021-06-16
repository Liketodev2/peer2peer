@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            <div class="row mt-5" >
                                <div class="col-md-2">
                                    <img class="img-fluid" src="{{$user->avatar ? asset('images') .'/'.$user->avatar : asset('img/profile-user-gray.svg') }}" alt="">
                                </div>
                                <div class="col-md-3">
                                    <li class="list-group-item"><b>Id: </b>{{$user->id}}</li>
                                    <li class="list-group-item"><b>First_name:</b> {{$user->first_name}}</li>
                                    <li class="list-group-item"><b>Last name:</b> {{$user->last_name}}</li>
                                </div>
                                <div class="col-md-3">
                                    <li class="list-group-item"><b>Company name:</b> {{$user->company_name}}</li>
                                    <li class="list-group-item"><b>Email:</b> {{$user->email}}</li>
                                    <li class="list-group-item"><b>Type:</b> {{$user->type == 20 ? 'User' : 'Company'}}</li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            <div class="row mt-4" >
                                <div class="col-12 ">
                                    <h3>Peers</h3>
                                    <table  class="table table-striped" >
                                        <thead class="thead-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Article</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($feeds as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->category->name}}</td>
                                                <td>
                                                    <a href="{{route('dashboard.feeds.edit', $item->id)}}"><button class="btn btn-light btn-sm mb-2 w-60"><i class="fas fa-edit"></i></button></a>
                                                    <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                                    <form action="{{route('dashboard.feeds.destroy',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-start mt-4">
                                        {{$feeds->links('pagination::bootstrap-4')}}
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
