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
    @auth
        <div class="text-center pt-4 pb-4 url_whitelist_box">
            <form action="{{route('rss.to-whitelist')}}" method="POST" >
                @csrf
                <input type="text" name="url_whitelist" class="url_whitelist" placeholder="Send source to whitelist">
                <button class="btn btn-sm btn-success"><i class="far fa-envelope"></i></button>
                @error('url_whitelist')
                <span class="invalid-feedback url_whitelist_error" style="display: block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                @if ($message = Session::get('success'))
                    <span class="invalid-feedback  url_whitelist_error" style="display: block" role="alert"><strong>{{ $message }}</strong></span>
                @endif
            </form>
        </div>
    @endauth
</aside>
