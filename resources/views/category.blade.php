@extends('layouts.main')
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            <div class="accordion p-lg-5">
                <div class="card">
                    <div class="card-body">
                        @if($feeds->count() > 0)
                            @foreach($feeds as $key => $feed_item)
                                <div class="d-flex row-news">
                                    <div class=" w-40 text-left"><a href="{{route('feed',$feed_item->id)}}">{{$feed_item->title}}</a></div>
                                    <div class="flex-1 text-center">{{$feed_item->user->company_name ? $feed_item->user->company_name : $feed_item->author_name}}</div>
                                    <div class="flex-1 text-right">{{\Carbon\Carbon::parse($feed_item->created_at)->format('D, M d H:i')}}</div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="text-danger text-center mt-2">Current category feeds are empty</h4>
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
