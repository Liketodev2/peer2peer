<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}" type="image/x-icon">

    <title>Dashboard | Peer2peer </title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('global/css/bootstrap-extend.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{asset('global/vendor/animsition/animsition.css')}}">
    <link rel="stylesheet" href="{{asset('global/vendor/asscrollable/asScrollable.css')}}">
    <link rel="stylesheet" href="{{asset('global/vendor/switchery/switchery.css')}}">
    <link rel="stylesheet" href="{{asset('global/vendor/intro-js/introjs.css')}}">
    <link rel="stylesheet" href="{{asset('global/vendor/slidepanel/slidePanel.css')}}">
    <link rel="stylesheet" href="{{asset('global/vendor/flag-icon-css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{asset('global/vendor/waves/waves.css')}}">
    {{--<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">--}}
    <link rel="stylesheet" href="{{asset('global/vendor/jvectormap/jquery-jvectormap.css')}}">
    {{--<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/examples/css/dashboard/v1.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.min.css">
    @stack('styles')
    @stack('partner.styles')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">

<!-- Fonts -->
    <link rel="stylesheet" href="{{asset('global/fonts/material-design/material-design.min.css')}}">
    <link rel="stylesheet" href="{{asset('global/fonts/brand-icons/brand-icons.min.css')}}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>



<!--[if lt IE 9]>
    <script src="{{asset('global/vendor/html5shiv/html5shiv.min.js')}}"></script>
    <![endif]-->

<!--[if lt IE 10]>
    <script src="{{asset('global/vendor/media-match/media.match.min.js')}}"></script>
    <script src="{{asset('global/vendor/respond/respond.min.js')}}"></script>
    <![endif]-->
    <link rel='stylesheet' href='{{asset('css/dashboard.css')}}'>

    <!-- Scripts -->
    <script src="{{asset('global/vendor/breakpoints/breakpoints.js')}}"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="animsition dashboard">
<div id="preloader-wrap" style="display: none">
    <div id="preloader"></div>
</div>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center " >
            <a class="text-white" href="/"><span class="navbar-brand-text hidden-xs-down"> <img src="{{asset("img/logo.png")}}" alt="Peer2peer title" width="100" class="footer-logo img-fluid "></span></a>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon md-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="{{asset('img/profile-user-gray.svg')}}" alt="...">
                  <i></i>
                </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                       {{-- <a class="dropdown-item" href="" role="menuitem"><i class="icon md-settings"
                                                                                                       aria-hidden="true"></i>
                            Settings</a>--}}
                  {{--      <div class="dropdown-divider" role="presentation"></div>--}}
                        <a class="dropdown-item" href="{{ route('logout') }}" role="menuitem"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="icon md-power" aria-hidden="true"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search" action="" method="get">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon md-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="text" placeholder="Search...">
                        <input type="hidden" name="type" value="{{ collect(request()->segments())->last() }}">
                        <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.index') ? 'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.index')}}">
                            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.categories.index') ? 'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.categories.index')}}">
                            <i class="site-menu-icon  md-view-list" aria-hidden="true"></i>
                            <span class="site-menu-title">Categories</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.users.index') ? 'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.users.index')}}">
                            <i class="site-menu-icon md-accounts" aria-hidden="true"></i>
                            <span class="site-menu-title">Users</span>
                        </a>
                    </li>

                    <li class="site-menu-item has-sub  {{(\Request::route()->getName() == 'dashboard.feeds.index') || (\Request::route()->getName() == 'dashboard.inactiveFeeds')   ? ' open active' : ''}}">
                        <a class="animsition-link"  href="javascript:void(0)">
                            <i class="site-menu-icon md-view-list" aria-hidden="true"></i>
                            <span class="site-menu-title">Feeds</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.feeds.index') ? 'active' : ''}}" >
                                <a class="animsition-link" href="{{route('dashboard.feeds.index')}}">
                                    <i class="site-menu-icon md-view-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">All</span>
                                </a>
                            </li>
                            <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.inactiveFeeds') ? 'active' : ''}}" >
                                <a class="animsition-link" href="{{route('dashboard.inactiveFeeds')}}">
                                    <i class="site-menu-icon md-view-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">Inactive</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.white-list.index') ? 'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.white-list.index')}}">
                            <i class="site-menu-icon md-view-list" aria-hidden="true"></i>
                            <span class="site-menu-title">White List</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{(\Request::route()->getName() == 'dashboard.rss.index') ? 'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.rss.index')}}">
                            <i class="site-menu-icon  md-upload" aria-hidden="true"></i>
                            <span class="site-menu-title">Rss</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@yield('content')
@if ($flash = session('success'))
    <div id="flash-message" class="alert alert-success">
        {{ $flash }}
    </div>
@endif

@if ($flash = session('error'))
    <div id="flash-message" class="alert alert-warning">
        {{ $flash }}
    </div>
@endif

<!-- Footer -->
<footer class="site-footer">

</footer>
<!-- Core  -->

<script src="{{asset('global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.min.js"></script>
<script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
@stack('partner.script')
@stack('scripts')
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="{{asset('global/vendor/popper-js/umd/popper.min.js')}}"></script>
<script src="{{asset('global/vendor/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('global/vendor/animsition/animsition.js')}}"></script>
<script src="{{asset('global/vendor/mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('global/vendor/asscrollbar/jquery-asScrollbar.js')}}"></script>
<script src="{{asset('global/vendor/asscrollable/jquery-asScrollable.js')}}"></script>
<script src="{{asset('global/vendor/ashoverscroll/jquery-asHoverScroll.js')}}"></script>
<script src="{{asset('global/vendor/waves/waves.js')}}"></script>


<!-- Plugins -->
<script src="{{asset('global/vendor/switchery/switchery.js')}}"></script>
<script src="{{asset('global/vendor/intro-js/intro.js')}}"></script>
<script src="{{asset('global/vendor/screenfull/screenfull.js')}}"></script>
<script src="{{asset('global/vendor/slidepanel/jquery-slidePanel.js')}}"></script>
{{--<script src="{{asset('global/vendor/chartist/chartist.min.js')}}"></script>--}}
{{--<script src="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js')}}"></script>--}}
<script src="{{asset('global/vendor/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('global/vendor/matchheight/jquery.matchHeight-min.js')}}"></script>
<script src="{{asset('global/vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Scripts -->
<script src="{{asset('global/js/Component.js')}}"></script>
<script src="{{asset('global/js/Plugin.js')}}"></script>
<script src="{{asset('global/js/Base.js')}}"></script>
<script src="{{asset('global/js/Config.js')}}"></script>

<script src="{{asset('assets/js/Section/Menubar.js')}}"></script>
<script src="{{asset('assets/js/Section/GridMenu.js')}}"></script>
<script src="{{asset('assets/js/Section/Sidebar.js')}}"></script>
<script src="{{asset('assets/js/Section/PageAside.js')}}"></script>
<script src="{{asset('assets/js/Plugin/menu.js')}}"></script>

<script src="{{asset('global/js/config/colors.js')}}"></script>
<script src="{{asset('assets/js/config/tour.js')}}"></script>
<script>Config.set('assets', 'assets');</script>

<!-- Page -->
<script src="{{asset('assets/js/Site.js')}}"></script>
<script src="{{asset('global/js/Plugin/asscrollable.js')}}"></script>
<script src="{{asset('global/js/Plugin/slidepanel.js')}}"></script>
<script src="{{asset('global/js/Plugin/switchery.js')}}"></script>
<script src="{{asset('global/js/Plugin/matchheight.js')}}"></script>
<script src="{{asset('global/js/Plugin/jvectormap.js')}}"></script>
<script src="{{asset('global/js/Plugin/peity.js')}}"></script>

<script src="{{asset('assets/examples/js/dashboard/v1.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-scroller/dataTables.scroller.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons/dataTables.buttons.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons/buttons.html5.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons/buttons.flash.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons/buttons.print.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons/buttons.colVis.js')}}"></script>
<script src="{{asset('global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js')}}"></script>
{{--<script src="{{asset('js/dropzone.js')}}"></script>--}}



<script src="{{asset('js/dashboard.js')}}"></script>

</body>
</html>
