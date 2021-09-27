@extends('layouts.main')
@section('content')
    <div class="d-xl-flex ">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            @include('areas.back-btn')
            <div class="accordion px-lg-5">
                <div class="card alert alert-dismissible fade show">
                    <div class="card-header">
                        My Commented
                    </div>
                    <div class="card-body">
                        @if($articles->count() > 0)
                            @foreach($articles as $item)
                                <div class="d-flex row-news">
                                    <div class=" w-40 text-left"><a href="{{route('feed',$item->id)}}">{{$item->title}}</a></div>
                                    <div class="flex-1 text-center">{{$item->user->company_name ? $item->user->company_name : $item->user->first_name .''.$item->user->last_name}}</div>
                                    <div class="flex-1 text-right">{{\Carbon\Carbon::parse($item->created_at)->format('D, M d H:i')}}</div>
                                </div>
                            @endforeach
                        @else
                            <h6 class="mt-2">Empty</h6>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{$articles->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
