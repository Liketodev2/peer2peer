@extends('layouts.main')
@section('content')
    <div class="d-xl-flex ">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            <div class="accordion px-lg-5 pt-lg-4">
                <div class="card alert alert-dismissible fade show">
                    <div class="card-header">
                        My feeds
                    </div>
                    <div class="card-body">
                        @if($feeds->count() > 0)
                            @foreach($feeds as $key => $feed_item)
                                <div class="d-flex row-news">
                                    <div class=" w-40 text-left"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->title}}</a></div>
                                    <div class="flex-1 text-center">{{$feed_item->category->name}}</div>
                                    <div class="flex-1 text-right">{{\Carbon\Carbon::parse($feed_item->created_at)->format('D, M d H:i')}}</div>
                                    <div class="flex-1 text-right">
                                        <a href="{{route('feed.edit', $feed_item->id)}}"><button class="btn btn-light btn-sm"><i class="fas fa-edit"></i></button></a>
                                        <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                        <form action="{{route('feed.delete',$feed_item->id)}}" method="POST" class="d-none admin-remove-form">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h6 class="mt-2">Feeds are empty</h6>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{$feeds->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
