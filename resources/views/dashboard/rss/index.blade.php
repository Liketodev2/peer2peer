@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            @include('dashboard.partials.crud-notifications')
                            <div class="row mt-4" >
                                <div class="col-12 mb-4">
                                    <form action="{{route('dashboard.rss.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputLink">Rss Link</label>
                                            <input type="url" class="form-control" id="exampleInputLink" aria-describedby="emailHelp" name="url" placeholder="Enter link">
                                        </div>
                                        <div class="form-group">
                                            <label >Companies</label>
                                            <select class="form-control" name="user_id">
                                                    @foreach($users as $item)
                                                        <option value="{{$item->id}}">{{$item->company_name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Categories</label>
                                            <select class="form-control" name="category_id">
                                                @foreach($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                                <hr>
                                <div class="col-12 ">
                                    <table  class="table table-striped" >
                                        <thead class="thead-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Link</th>
                                            <th>User</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->url}}</td>
                                                <td>{{$item->user->company_name}}</td>
                                                <td>{{$item->category->name}}</td>
                                                <td>
                                   {{-- <a href="{{route('dashboard.users.show', $item->id)}}"><button class="btn btn-success btn-sm">show</button></a>--}}
                                                    <button class="btn btn-light w-60 btn-sm admin-remove-btn"><i class="fas fa-trash text-danger"></i></button>
                                                    <form action="{{route('dashboard.rss.destroy',$item->id)}}" method="POST" class="d-none admin-remove-form">
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
