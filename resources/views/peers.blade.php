@extends('layouts.main')
@push('styles')
    <style>
        .peer_status_item{
            cursor: pointer;
        }
        .active-peer{
            font: normal normal 600 14px/21px Poppins !important;
            color: #0019FF !important;
        }
        .empty-peers{
            font-size: 40px;
        }
    </style>
@endpush
@section('content')
    <div class="d-xl-flex peers_content">
        <aside class="asides left_aside">
            <div class="pb-4 mb-2">
                <ul class="p-0 m-0 active list-unstyled">
                    <li class="{{!Request::has('trust') ? 'active': ''}}"><a href="{{route('peers')}}">All</a></li>
                    <li class="{{Request::has('trust') && Request::get('trust') == 5 ? 'active' : ''}}"><a href="{{route('peers',['trust' => 5])}}">Very Trustworthy [5]</a></li>
                    <li class="{{Request::has('trust') && Request::get('trust') == 4 ? 'active' : ''}}"><a href="{{route('peers',['trust' => 4])}}">Trustworthy [4]</a></li>
                    <li class="{{Request::has('trust') && Request::get('trust') == 3 ? 'active' : ''}}"><a href="{{route('peers',['trust' => 3])}}">OK Trust [3]</a></li>
                    <li class="{{Request::has('trust') && Request::get('trust') == 2 ? 'active' : ''}}"><a href="{{route('peers',['trust' => 2])}}">Untrustworthy [2]</a></li>
                    <li class="{{Request::has('trust') && Request::get('trust') == 1 ? 'active' : ''}}"><a href="{{route('peers',['trust' => 1])}}">Not my peer [1]</a></li>
               {{--     <li><a href="#">BLOCKED [0]</a></li>--}}
                </ul>
            </div>
        </aside>
        <main class="flex-1 main-content px-lg-4 py-5">
            @include('areas.back-btn')
     {{--       <div class="d-flex justify-content-center align-items-center">
                <div class="mr-3 color-red">Sort by</div>
                <ul class="d-flex">
                    <li><a href="#">ABC</a></li>
                    <li class="active"><a href="#">Date added</a></li>
                    <li><a href="#">Date created</a></li>
                </ul>
            </div>--}}
            @if(count($peers) > 0)
            @foreach($peers as $peer)
                        <div class="alert bg-light my-2 peer-main-block" role="alert" data-id="{{$peer->id}}" style="cursor: pointer">
                            <a href="{{route('profile', $peer->id)}}">{{$peer->company_name}}  [{{\App\Http\Controllers\FunctionController::trustStatus(Auth::user()->following()->wherePivot('follow_id', $peer->id)->first()->pivot->trust)}}] </a>
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
                                    <div class="info_name">Following:</div>
                                    <div class="info_name-description">{{$peer->followers()->count()}}</div>
                                </div>
                                <hr>
                                    <div class="parent-peer-block" data-id="{{$peer->id}}">
                                        <div><b>Select status : </b></div>
                                        <div class="info_name-description peer_status_item {{Auth::user()->following()->wherePivot('follow_id', $peer->id)->first()->pivot->trust == 5 ? 'active-peer' : ''}}" data-value="5">Very Trustworthy [5]</div>
                                        <div class="info_name-description peer_status_item {{Auth::user()->following()->wherePivot('follow_id', $peer->id)->first()->pivot->trust == 4 ? 'active-peer' : ''}}" data-value="4">Trustworthy [4]</div>
                                        <div class="info_name-description peer_status_item {{Auth::user()->following()->wherePivot('follow_id', $peer->id)->first()->pivot->trust == 3 ? 'active-peer' : ''}}" data-value="3">OK Trust [3]</div>
                                        <div class="info_name-description peer_status_item {{Auth::user()->following()->wherePivot('follow_id', $peer->id)->first()->pivot->trust == 2 ? 'active-peer' : ''}}" data-value="2">Untrustworthy [2]</div>
                                        <div class="info_name-description peer_status_item {{Auth::user()->following()->wherePivot('follow_id', $peer->id)->first()->pivot->trust == 1 ? 'active-peer' : ''}}" data-value="1">Not my peer [1]</div>
                                       {{-- <div class="info_name-description peer_status_item {{Auth::user()->following()->first()->pivot->trust == 0 ? 'info_name' : ''}}">BLOCKED [0]</div>--}}
                                    </div>
                            </div>
                        </div>
            @endforeach
            @else
                <div>
                    <div class="text-center"><i class="far fa-folder-open empty-peers"></i></div>
                    <div class="text-center">
                        <h5 class=" text-dark mt-2">Peers are empty</h5>
                    </div>
                </div>
            @endif
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
