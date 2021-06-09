@extends('layouts.main')
@section('content')
    <div class="d-xl-flex peers_content">
        <aside class="asides left_aside">
            <div class="pb-4 mb-2">
                <ul class="p-0 m-0 active list-unstyled">
                    <li class="active"><a href="#">All</a></li>
                    <li><a href="#">Very Trustworthy [5]</a></li>
                    <li><a href="#">Trustworthy [4]</a></li>
                    <li><a href="#">OK Trust [3]</a></li>
                    <li><a href="#">Untrustworthy [2]</a></li>
                    <li><a href="#">Not my peer [1]</a></li>
                    <li><a href="#">BLOCKED [0]</a></li>
                </ul>
            </div>
        </aside>
        <main class="flex-1 main-content px-lg-4 py-5">
     {{--       <div class="d-flex justify-content-center align-items-center">
                <div class="mr-3 color-red">Sort by</div>
                <ul class="d-flex">
                    <li><a href="#">ABC</a></li>
                    <li class="active"><a href="#">Date added</a></li>
                    <li><a href="#">Date created</a></li>
                </ul>
            </div>--}}
            @foreach($peers as $peer)
                <div class="alert bg-light my-2 peer-main-block" role="alert" data-id="{{$peer->id}}" style="cursor: pointer">
                    <a href="{{route('profile', $peer->id)}}">{{$peer->company_name}} [ Very Trustworthy - Change ]</a>
                    <i class="fa fa-eye color-gray"></i>
                    <div class="d-none hided-peer">
                        <div class="d-flex align-items-center">
                            <div class="info_name">Author:</div>
                            <div class="info_name-description">{{$peer->company_name}}</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Peer status:</div>
                            <div class="info_name-description">Very Trust Worthy</div>
                            <i class="fa fa-pencil"></i>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Date created:</div>
                            <div class="info_name-description">{{\Carbon\Carbon::parse($peer->created_at)->format('M d Y')}}</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Followers:</div>
                            <div class="info_name-description">{{$peer->following()->count()}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>
        <aside class="asides right_aside">
            <div class="aside-accordion alert p-0">
                <div class="btn btn-red w-100 d-flex justify-content-between align-items-center">
                    <a class="d-flex justify-content-between align-items-center w-100" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <div class="title">Profile</div>
                        <img src="img/Polygon%204.png" width="21" height="12">
                    </a>
                    <img src="img/x%20(5).svg" alt="" class="ml-3" data-dismiss="alert" aria-label="Close">
                </div>
                <div class="collapse multi-collapse show" id="multiCollapseExample1">
                    <div class="card card-body p-1 bg-transparent border-0 put-clicked-content">

                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection
