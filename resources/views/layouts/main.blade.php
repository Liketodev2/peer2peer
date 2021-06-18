<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NEWS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/secondary/owl-carousel-min.css')}}">
    <link rel="stylesheet" href="{{asset('css/secondary/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/css/main.css')}}">
    @stack('styles')
</head>

<body class="container-1636">
<header class="navigation-wrap">
    <nav class="navbar navbar-expand-xl p-0 nav-top">
        <div class="d-xl-flex align-items-center w-100 justify-content-between">
            <div class="d-flex align-items-center">
                <a class="navbar-brand p-0" href="/">
                    <div class="d-flex">
                        <img src="{{asset('img/logo.png')}}" alt="logo" width="247" height="139">
                        <img src="{{asset('img/Group-99.png')}}" alt="logo" width="247" height="139">
                    </div>
                </a>
                <div class="header-date_info d-none d-lg-block">{{\Carbon\Carbon::now()->format('D, M d')}}th {{\Carbon\Carbon::now()->format(' g:i A')}}</div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    @auth
                    @if(\Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard.index')}}"><button class="btn-sm btn-primary">Dashboard</button></a>
                        </li>
                     @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('peers')}}">Peers</a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="nav-link" href="#" id="Notification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Notification <i class="fa fa-bell ml-1 {{\App\Http\Controllers\FunctionController::getNotifications()->count() > 0 ? 'text-danger' : ''}}"></i>
                        </a>
                        <div class="dropdown-menu notification_dropdown" aria-labelledby="Notification">
                            <main class="notification_content">
                                <div class="px-3">

                                    @if( \App\Http\Controllers\FunctionController::getNotifications()->count() > 0)
                                        @foreach(\App\Http\Controllers\FunctionController::getNotifications() as $notify)
                                            <div class="alert bg-light-gray alert-red d-flex align-items-center position-relative mb-3" role="alert">
                                                <p class="m-0">{{$notify->text}}</p>
                                                <div class="abs"><i class="far fa-clock mr-1"></i> {{\Carbon\Carbon::parse($notify->created_at)->diffForHumans(\Illuminate\Support\Carbon::now())}}</div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center mt-3 text-info">Notifications are empty</p>
                                    @endif
                                    <div>
                                        <a href="{{route('notifications')}}" role="button" class="btn-red px-5">View all in full window</a>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link message-check-icon" href="{{route('messages')}}">
                            Messages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('my-feeds')}}">My Feeds</a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('img/profile-user.svg')}}" alt="login">
                        </a>
                        <div class="dropdown-menu px-3" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('my-profile', \Auth::id())}}">Profile</a>
                            <hr>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit()">Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <button type="submit" class="btn-red log-in-btn"  data-toggle="modal" data-target="#logIn">Log in</button>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <nav class="nav-bottom">
        <div class="d-flex align-items-center w-100">
            <div class="d-flex justify-content-between  py-lg-0 py-3 bg-dark border-top w-100 position-relative flex-wrap">
                <ul class="list-unstyled m-0 d-flex flex-wrap">
                    <li class="nav-item {{\Request::route()->getName() == "home" ? 'active' : ''}}">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item  {{\Request::segment(2) == $category->id ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('category', $category->id)}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
                <form class="form-inline" action="{{route('search')}}" method="POST">
                    @csrf
                    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search ">
                    <button class="btn my-sm-0 border-0 abs" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>
@yield('content')
<div class="modal fade logReg" id="signUp" tabindex="-1" role="dialog" aria-labelledby="signUpTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content login-content">
            <div class="d-none d-md-block">
                <div class="d-flex flex-column align-items-center" style="width: 345px">
                    <img src="{{asset('img/logo-transparent.png')}}" alt="" width="166" height="60" class="mt-5">
                    <div class="mt-5 mb-4 pt-5 text-white text-center">
                        Do you already have <br> an account?
                    </div>
                    <button type="submit" class="btn-red py-2 remove-auth-validation"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#logIn">Sign In</button>
                </div>
            </div>
            <div class="flex-1  d-flex flex-column align-items-center">
                <div class="mb-md-2 ml-auto py-md-2 px-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 py-0 w-100">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="d-block d-md-none my-2 text-center">
                            <img src="img/Peer2Peer-red.png" alt="">
                        </div>
                        <ul class="list-unstyled p-0 m-0 d-flex justify-content-center align-items-center">
                            <li class="mx-2"><a href="{{ url('auth/facebook') }}"><img src="{{asset('img/facebook%20(4).svg')}}" alt=""></a></li>
                            <li class="mx-2"><a href="{{ url('auth/google') }}"><img src="{{asset('img/Group%20101.svg')}}" alt=""></a></li>
                        </ul>
                        <div class="position-relative mt-2">
                            <div class="or">or</div>
                        </div>
                        <div  class="w-100">
                            <div class="form-group">
                                <label for="Email_reg">Email</label>
                                <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="Email_reg" name="email" aria-describedby="emailHelp">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>First name</label>
                                    <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control @error('first_name') is-invalid @enderror">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col">
                                    <label>Last name</label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control @error('last_name') is-invalid @enderror">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Password_reg">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="Password_reg">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="re_password_reg">Confirm password</label>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="re_password_reg">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('agreement') is-invalid @enderror" id="exampleCheck1" name="agreement">
                                <label class="form-check-label" for="exampleCheck1">
                                    I agree to the
                                    <a href="#" class="modal_link"> Privacy Policy</a>
                                    and
                                    <a href="#" class="modal_link"> Terms of Service</a>
                                </label>
                                @error('agreement')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn-bordered py-2 mx-auto sign-up-submit">Sign Up</button>
                                <button type="submit" class="btn-red my-3 d-block d-md-none mx-auto"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#logIn">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade logReg" id="logIn"  tabindex="-1" role="dialog" aria-labelledby="logInTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content login-content">
            <div class="d-none d-md-block">
                <div class="d-flex flex-column align-items-center " style="width: 345px">
                    <img src="{{asset('img/logo-transparent.png')}}" alt="" width="166" height="60" class="mt-5">
                    <div class="mt-5 mb-4 pt-5 text-white">
                        Would you like to Register?
                    </div>
                    <button type="submit" class="btn-red py-2 remove-auth-validation" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#signUp">Sigh Up</button>
                </div>
            </div>
            <div class="flex-1  d-flex flex-column align-items-center">
                <div class="mb-md-4 ml-auto py-md-2 px-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 py-0 w-100">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="d-block d-md-none my-2 text-center">
                            <img src="img/Peer2Peer-red.png" alt="">
                        </div>
                        <ul class="list-unstyled p-0 m-0 d-flex justify-content-center align-items-center">
                            <li class="mx-2"><a href="{{ url('auth/facebook') }}"><img src="{{asset('img/facebook%20(4).svg')}}" alt=""></a></li>
                            <li class="mx-2"><a href="{{ url('auth/google') }}"><img src="{{asset('img/Group%20101.svg')}}" alt=""></a></li>
                        </ul>
                        <div class="position-relative my-4">
                            <div class="or">or</div>
                        </div>
                        <div style="max-width: 375px; width: 100%" class="mx-auto">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" id="Email" aria-describedby="emailHelp" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <a href="#" class="modal_link forgot-btn" data-toggle="modal" data-target="#forgotPassword" data-dismiss="modal" aria-label="Close">Forgot password?</a>
                            <div class="mt-4">
                                <button type="submit" class="btn-bordered py-2 mx-auto log-in-submit">Log in</button>
                                <button type="submit" class="btn-red mx-auto mt-3 d-block  d-md-none" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#signUp">Sigh Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade logReg" id="forgotPassword"  tabindex="-1" role="dialog" aria-labelledby="logInTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="d-flex flex-column align-items-center" style="width: 345px">
                <img src="{{asset('img/logo-transparent.png')}}" alt="" width="166" height="60" class="mt-5">
                <div class="mt-5 mb-4 pt-5 text-white">
                    Would you like to Register?
                </div>
                <button type="submit" class="btn-red py-2" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#signUp">Sigh Up</button>
            </div>
            <div class="flex-1  d-flex flex-column align-items-center">
                <div class="mb-4 ml-auto py-2 px-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 py-0 w-100">
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <ul class="list-unstyled p-0 m-0 d-flex justify-content-center align-items-center">
                            <li class="mx-2"><a href="{{ url('auth/facebook') }}"><img src="{{asset('img/facebook%20(4).svg')}}" alt=""></a></li>
                            <li class="mx-2"><a href="{{ url('auth/google') }}"><img src="{{asset('img/Group%20101.svg')}}" alt=""></a></li>
                        </ul>
                        <div class="position-relative my-4">
                            <div class="or">or</div>
                        </div>
                        <div style="max-width: 375px; width: 100%" class="mx-auto">
                            <h3 class="text-center">Forgot Your Password?</h3>
                            <p class="text-gray text-center mb-0 px-lg-3">Don't Worry !Just fill in your email and we'll send you a link to reset your password .</p>
                            <div class="form-group">
                                <label for="Email_fp">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="Email_fp" aria-describedby="emailHelp" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn-bordered py-2 mx-auto reset-submit"
                                        {{--data-toggle="modal"
                                        data-target="#resetPassword" data-dismiss="modal" aria-label="Close"--}}
                                >Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade logReg" id="resetPassword"  tabindex="-1" role="dialog" aria-labelledby="logInTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="d-flex flex-column align-items-center" style="width: 345px">
                <img src="{{asset('img/logo-transparent.png')}}" alt="" width="166" height="60" class="mt-5">
                <div class="mt-5 mb-4 pt-5 text-white">
                    Would you like to Register?
                </div>
                <button type="submit" class="btn-red py-2 sign-up-btn " data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#signUp">Sigh Up</button>
            </div>
            <div class="flex-1  d-flex flex-column align-items-center">
                <div class="mb-4 ml-auto py-2 px-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 py-0 w-100">
                    <form action="#">
                        <ul class="list-unstyled p-0 m-0 d-flex justify-content-center align-items-center">
                            <li class="mx-2"><a href="{{ url('auth/facebook') }}"><img src="{{asset('img/facebook%20(4).svg')}}" alt=""></a></li>
                            <li class="mx-2"><a href="{{ url('auth/google') }}"><img src="{{asset('img/Group%20101.svg')}}" alt=""></a></li>
                        </ul>
                        <div class="position-relative my-4">
                            <div class="or">or</div>
                        </div>
                        <div style="max-width: 375px; width: 100%" class="mx-auto">
                            <h3 class="text-center">Reset Password</h3>
                            <div class="form-group">
                                <label for="re_password">Password</label>
                                <input type="password" class="form-control" id="re_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_re_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_re_password">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn-bordered py-2 mx-auto" data-toggle="modal" data-target="#resetPassword" data-dismiss="modal" aria-label="Close">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
@stack('scripts')
@if(!$errors->isEmpty())
    <script>
        let login_type = localStorage.getItem('login_type');
        if(login_type == "login"){
                    setTimeout(function () {
                        $('.log-in-btn').click();
                    })
                }else if(login_type == "register"){
                    setTimeout(function () {
                        $('.sign-up-btn').click();
                    })
                }else if(login_type == "forgot"){
                    setTimeout(function () {
                        $('.forgot-btn').click();
                    })
                }
        </script>

@endif
@if(\Auth::user())
    <script>
        checkMessages();
    </script>
@endif
</body>
</html>

