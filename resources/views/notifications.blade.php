@extends('layouts.main')
@push('styles')
    <style>
        .notify-empty{
            font-size: 40px;
        }
    </style>
@endpush
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
                    <div>
                        <div class="text-center"><i class="far fa-folder-open notify-empty"></i></div>
                        <div class="text-center">
                            <h5 class=" text-dark mt-2">Notifications are empty</h5>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
@endsection
