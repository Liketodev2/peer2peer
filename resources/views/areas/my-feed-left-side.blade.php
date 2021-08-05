<div class="my-feed_content">
    <aside class="asides left_aside">
        <div class="pb-4 mb-2 py-3">
            <div class="title px-3">My Feeds</div>
            <div class="bg-white  px-3">
               @foreach($channels as $channel)
                   <div class="cursor-pointer"><a href="{{route('my-feeds',['id' => $channel->id])}}">{{$channel->company_name}}</a></div>
               @endforeach
            </div>
            <hr>
            <div class="title px-3">Followed Feeds</div>
            <ul class="p-0 active list-unstyled">
                @foreach($peers as $peer)
                    <li class="{{(\Request::route()->getName() == 'followed-feeds' && \Request::segment(2) == $peer->id) ? 'active' : '' }} cursor-pointer"><a href="{{route('followed-feeds', $peer->id)}}">{{$peer->company_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
