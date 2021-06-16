@php
 $feeds = \App\Http\Controllers\FunctionController::getLimetedFeeds();
@endphp
<aside class="asides left_aside">
    <div class="border-bottom pb-4 mb-2 px-2 py-3">
        <div class="title">World</div>
        <ul class="m-0 p-0 active">
            @if($feeds['world']->count() > 0)
                @foreach($feeds['world'] as $feed)
                    <li><a href=" {{route('feed', $feed->id)}} ">{{$feed->title}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="border-bottom pb-4 mb-2  px-2 py-3">
        <div class="title">Business/Money</div>
        <ul class="m-0 p-0">
            @if($feeds['business_money']->count() > 0)
                @foreach($feeds['business_money'] as $feed)
                    <li><a href=" {{route('feed', $feed->id)}} ">{{$feed->title}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="border-bottom pb-4 mb-2  px-2 py-3">
        <div class="title">Entertainment</div>
        <ul class="m-0 p-0">
            @if($feeds['entertainment']->count() > 0)
                @foreach($feeds['entertainment'] as $feed)
                    <li><a href=" {{route('feed', $feed->id)}} ">{{$feed->title}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
</aside>
