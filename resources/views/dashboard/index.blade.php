@extends('dashboard.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row dashboard-area mt-4 p-4" data-plugin="matchHeight" data-by-row="true">
                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card card-block p-30 bg-primary-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon md-accounts" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{$info['users']}}</span>
                                <span class="counter-number-related text-capitalize">Users</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card card-block p-30 bg-primary-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon md-accounts" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{$info['companies']}}</span>
                                <span class="counter-number-related text-capitalize">Companies</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card card-block p-30 bg-primary-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon md-view-list" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{$info['feeds']}}</span>
                                <span class="counter-number-related text-capitalize">Feeds</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
        </div>
    </div>
    </div>
@endsection
