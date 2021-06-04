@extends('layouts.main')
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1">
            <h1>search</h1>
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
