@php
    $feeds = \App\Http\Controllers\FunctionController::getLimetedFeeds();
@endphp
<aside class="asides right_aside">
    <div class="aside-accordion alert p-0">
        <div class="btn btn-red w-100 d-flex justify-content-between align-items-center">

            <a class="d-flex justify-content-between align-items-center w-100" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                <div class="title">Trending of US</div>
                <img class="toggle_triangle" src="{{asset('img/Polygon%204.png')}}" width="21" height="12">
            </a>
            <img src="{{asset('img/x%20(5).svg')}}" alt="" class="ml-3" data-dismiss="alert" aria-label="Close">
        </div>
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <ul class="m-0 p-0">
                    @if(isset($trending_feeds))
                        @foreach($trending_feeds as $trend)
                            <li>
                                <a href="{{route('feed', $trend->id)}}"> {{$trend->title}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="border-bottom pb-4 px-2 py-3">
        <div class="title">Tech</div>
        <ul class="m-0 p-0">
            @if($feeds['tech']->count() > 0)
                @foreach($feeds['tech'] as $feed)
                    <li><a href=" {{route('feed', $feed->id)}} ">{{$feed->title}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="border-bottom pb-4 px-2 py-3">
        <div class="title">Health</div>
        <ul class="m-0 p-0">
            @if($feeds['health']->count() > 0)
                @foreach($feeds['health'] as $feed)
                    <li><a href=" {{route('feed', $feed->id)}} ">{{$feed->title}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
</aside>
