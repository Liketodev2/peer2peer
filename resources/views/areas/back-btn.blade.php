@if(\Request::route()->getName() != 'home')
    <a class="nav-link back-page-btn" href="{{ url()->previous() }}"><img src="{{asset('img/arrow-right.svg')}}" alt=""></a>
@endif
