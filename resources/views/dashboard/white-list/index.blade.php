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
                                    <form action="{{route('dashboard.white-list.store-csv')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="csv-file"><b>Choose CSV file</b></label>
                                            <input style="padding: 5px" type="file" class="form-control" id="exampleInputLink" aria-describedby="csv-file" name="file" >
                                        </div>

                                        <button type="submit" class="btn btn-primary">Insert</button>
                                    </form>
                                </div>

                                <div class="col-12 mb-4">
                                    <form action="{{route('dashboard.white-list.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputLink"><b>Link</b></label>
                                            <input type="url" class="form-control" id="exampleInputLink" aria-describedby="emailHelp" name="url" placeholder="Enter link" value="{{Request::get('url')}}">
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
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->url}}</td>
                                                <td>
                                                    {{-- <a href="{{route('dashboard.users.show', $item->id)}}"><button class="btn btn-success btn-sm">show</button></a>--}}
                                                    <button class="btn btn-light w-60 btn-sm admin-remove-btn"><i class="fas fa-trash text-danger"></i></button>
                                                    <form action="{{route('dashboard.white-list.destroy',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    @if($item->status == 0)
                                                        <form action="{{route('dashboard.rss.approve')}}" method="POST" class="ml-2 admin-remove-form" style="display: inline-block">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                            <button class="btn btn-success btn-sm d-block mb-2 w-60"><i class="fas fa-check"></i></button>
                                                        </form>
                                                    @endif
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

