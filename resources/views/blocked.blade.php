@extends('layouts.main')
@section('content')
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            <div class="container text-center">
                <h4 class="mt-5">You cant see that information</h4>
            </div>
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
