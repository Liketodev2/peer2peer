@extends('layouts.main')
@section('content')
    <div class="d-xl-flex ">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content notification_content px-lg-4 py-5">
            <div class="col-12 col-xl-9">
                @if($notifications->count() > 0)
                    @foreach($notifications as $notify)
                        <div class="alert bg-light-gray  d-flex align-items-center position-relative mb-3" role="alert">
                            <p class="m-0">{{$notify->text}}.</p>
                            <div class="abs"><i class="far fa-clock mr-1"></i>{{\Carbon\Carbon::parse($notify->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}}</div>
                        </div>

                    @endforeach
                        <div class="d-flex justify-content-center mt-4">
                            {{$notifications->links('pagination::bootstrap-4')}}
                        </div>
                @else
                    <h4 class="text-center mt-3 text-info">Notifications are empty</h4>
                @endif
            </div>
        </main>
    </div>
@endsection
