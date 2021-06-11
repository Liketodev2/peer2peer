@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            @include('dashboard.partials.crud-notifications')
                            <a href="{{route('dashboard.feeds.create')}}"><button class="btn btn-primary">Create</button></a>
                            <div class="row mt-4" >
                                <div class="col-12 ">
                                    <table  class="table table-striped" >
                                        <thead class="thead-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Article</th>
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
                                                <td>{{$item->article}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->category->name}}</td>
                                                <td>{{$item->user->company_name ? $item->user->company_name : $item->user->first_name .' '. $item->user->last_name}}</td>
                                                <td>
                                                    <a href="{{route('dashboard.feeds.edit', $item->id)}}"><button class="btn btn-primary btn-sm mb-2 w-60">edit</button></a>
                                                    <button class="btn btn-danger btn-sm admin-remove-btn w-60">delete</button>
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
