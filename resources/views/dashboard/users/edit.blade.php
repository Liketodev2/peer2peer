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
                                    <form action="{{route('dashboard.users.update', $user->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label>First name</label>
                                            <input type="text" class="form-control"  name="first_name" value="{{$user->first_name}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control"  name="last_name" value="{{$user->last_name}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Company name</label>
                                            <input type="text" class="form-control"  name="company_name" value="{{$user->company_name}}">
                                        </div>
                                        <div class="form-group">
                                            <label >Type</label>
                                            <select class="form-control" name="type">
                                                <option value="10" {{$user->type == 10 ? 'selected' : ''}}>Company</option>
                                                <option value="20" {{$user->type == 20 ? 'selected' : ''}}>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Account type</label>
                                            <select class="form-control" name="account">
                                                <option value="0" {{$user->account == 0 ? 'selected' : ''}}>Basic</option>
                                                <option value="1" {{$user->account == 1 ? 'selected' : ''}}>Pro</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control"  name="email" value="{{$user->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control"  name="password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
