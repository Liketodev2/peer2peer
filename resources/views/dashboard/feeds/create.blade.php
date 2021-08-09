@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="card card-shadow col-md-12">
                    <div class="card-block p-20 pt-10">
                        <div class="panel-body">
                            <div class="row mt-4" >
                                <div class="col-12 mb-4">
                                    <form action="{{route('dashboard.feeds.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control"  name="title" value="{{old('title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control"  name="description" value="{{old('description')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input type="url" class="form-control"  name="url" value="{{old('url')}}">
                                        </div>
                                        <div class="form-group">
                                            <label >Category</label>
                                            <select class="form-control" name="category_id">
                                               @foreach($categories as $category)
                                                    <option value="{{$category->id}}"> {{$category->name}} </option>
                                               @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Status</label>
                                            <select class="form-control" name="status">
                                                <option value="0">Inactive</option>
                                                <option value="1" selected>Active</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Creator</label>
                                            <select class="form-control" name="user_id">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"> {{$user->company_name}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
