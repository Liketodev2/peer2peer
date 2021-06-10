@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            <h3>User</h3>
                            <div class="row mt-5" >
                              <div>
                                  <ul class="list-group">
                                      <li class="list-group-item"><b>Id: </b>{{$user->id}}</li>
                                      <li class="list-group-item"><b>First_name:</b> {{$user->first_name}}</li>
                                      <li class="list-group-item"><b>Last name:</b> {{$user->last_name}}</li>
                                      <li class="list-group-item"><b>Company name:</b> {{$user->company_name}}</li>
                                  </ul>
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
                                    <table  class="table table-bordered service-datatable " >
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Article</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($feeds as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->article}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{--<a href="{{route('dashboard.users.show', $item->id)}}"><button class="btn btn-success btn-sm">show</button></a>--}}</td>
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
