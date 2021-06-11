@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            @include('dashboard.partials.crud-notifications')
                            <a href="{{route('dashboard.users.create')}}"><button class="btn btn-primary">Create</button></a>
                            <div class="row mt-4" >
                                <div class="col-12 ">
                                    <table  class="table table-striped service-datatable" >
                                        <thead class="thead-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Company name</th>
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
                                                <td><a href="{{route('dashboard.users.show', $item->id)}}"><button class="btn btn-success btn-sm">show</button></a></td>
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
