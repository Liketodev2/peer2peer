@extends('layouts.main')
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1 search-content p-4">
            @include('areas.back-btn')
            <h1 class="title">Search</h1>
            <div class="color-gray my-3">
                Founded {{$results_count}} results
            </div>
            <div class="">
                <div class="card-body">
                    @foreach($results as $result)
                        <div class="d-flex row-news">
                            <div class="w-40"><a href="{{route('feed', $result->id)}}">{{$result->title}}</a></div>
                            <div class="mx-auto flex-1 d-flex justify-content-center">{{$result->category->name}}</div>
                            <div class="mx-auto flex-1 d-flex pl-4">{{$result->user->type == 10 ? $result->user->company_name : $result->user->first_name .' '. $result->user->last_name}}</div>
                            <div class="mx-auto flex-1 d-flex justify-content-center">{{\Carbon\Carbon::parse($result->created_at)->format('D, M d H:i')}}</div>
                        </div>
                    @endforeach

             {{--       <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Why Trump will fail</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">US politics</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>--}}

                </div>
                <div class="d-flex justify-content-end">
                    {{$results->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>
@endsection
