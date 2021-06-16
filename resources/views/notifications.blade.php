@extends('layouts.main')
@section('content')
    <div class="d-xl-flex ">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content notification_content px-lg-4 py-5">
            <div class="col-12 col-xl-9">
                <div class="alert bg-light-gray alert-red d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">Tom Smith commented on your post “Trump extradites Robert Mueller to Ecuador”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 2 hours ago</div>
                </div>
                <div class="alert bg-light-gray  d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">-Robert Makerman replied to the comment on post “CNN World is banned from Venezuela”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 4 hours ago</div>
                </div>
                <div class="alert bg-light-gray d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">-Robert Makerman replied to the comment on post “CNN World is banned from Venezuela”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 4 hours ago</div>
                </div>
                <div class="alert bg-light-gray d-flex align-items-center position-relative mb-3" role="alert">
                    <p class="m-0">-Robert Makerman replied to the comment on post “CNN World is banned from Venezuela”...</p>
                    <div class="abs"><i class="far fa-clock mr-1"></i> 4 hours ago</div>
                </div>
            </div>
        </main>
    </div>
@endsection
