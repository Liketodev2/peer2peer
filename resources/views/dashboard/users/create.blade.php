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
                                        <form action="{{route('dashboard.users.store')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>First name</label>
                                                <input type="text" class="form-control"  name="first_name" value="{{old('first_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" class="form-control"  name="last_name" value="{{old('last_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Company name</label>
                                                <input type="text" class="form-control"  name="company_name" value="{{old('company_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label >Type</label>
                                                <select class="form-control" name="type">
                                                    <option value="10" {{old('type') == 10 ? 'selected' : ''}}>Company</option>
                                                    <option value="20" {{old('type') == 20 ? 'selected' : ''}}>User</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control"  name="email" value="{{old('email')}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control"  name="password">
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
