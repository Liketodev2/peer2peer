@extends('layouts.main')
@section('content')
    @push('styles')
        <style>
            .pricing-table{
                min-height: 360px;
            }
        </style>
    @endpush
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1 search-content p-4">
            <div class="container">
                <h4 class="mb-5">Select plan</h4>
                <div class="d-flex flex-column flex-md-row justify-content-md-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="pricing-table">
                            <div class="package-title">
                                <span>Free</span>
                            </div>
                            <div class="package-layout">
                                <div class="package-currency">$</div>
                                <div class="package-value">
                                    <div class="value">0</div>
                                    <div class="period">/ month</div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="terms">
                                <div class="term">
                                    <span>&#x2022; 2 channels maximum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="pricing-table offer">
                            <div class="package-title">
                                <span>Pro</span>
                          {{--      <span class="sale">Save 12%</span>--}}
                            </div>
                            <div class="package-layout">
                                <div class="package-currency">$</div>
                                <div class="package-value">
                                    <div class="value">49</div>
                                    <div class="period">/ month</div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="terms">
                                <div class="term">
                                    <span>&#x2022; more than 2 channels </span>
                                </div>
                   {{--             <div class="term">
                                    <span>2GB</span> RAM
                                </div>
                                <div class="term">
                                    <span>30GB</span> Storage <span>(SSD)</span>
                                </div>
                                <div class="term">
                                    <span>1TB</span> Bandwidth (100Mbit)
                                </div>
                                <div class="term">
                                    <span>1</span> IPv4 &amp; <span>1</span> IPv6
                                </div>--}}
                            </div>
                            <button class="buy-now">
                                <span>Buy now</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>
    @push('scripts')
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500);
            html, body {
                height: 100%;
            }

            html {
                font-size: 16px;
            }

            body {
                background-color: #eee;
                font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 1rem;
                color: rgba(0, 0, 0, 0.87);
            }

            h1 {
                margin-top: 0;
            }

            .pricing-table {
                display: flex;
                flex-direction: column;
                margin: 0 0 32px;
                background-color: #fff;
                border-radius: 3px;
                overflow: hidden;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.14), 0 2px 1px -1px rgba(0, 0, 0, 0.12);
            }
            .pricing-table.offer {
                box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.4);
            }
            .pricing-table .package-title {
                display: flex;
                justify-content: space-between;
                padding: 16px 24px;
                background-color: #263238;
                font-size: 1.125rem;
                color: #fff;
                text-transform: uppercase;
            }
            .pricing-table .package-title .sale {
                padding: 0 0.5rem;
                border-radius: 3px;
                background-color: #fff;
                font-size: 0.8125rem;
                font-weight: 500;
                color: #263238;
                line-height: 1.7;
            }
            .pricing-table .package-layout {
                display: flex;
                justify-content: center;
                padding: 2rem 2rem 1rem;
            }
            .pricing-table .package-layout .package-currency {
                padding-right: 4px;
                font-size: 1.5rem;
                font-weight: 500;
                color: rgba(0, 0, 0, 0.54);
            }
            .pricing-table .package-layout .package-value {
                display: flex;
                align-items: flex-end;
            }
            .pricing-table .package-layout .package-value .value {
                font-size: 4.5rem;
                font-weight: 300;
                line-height: 1;
            }
            .pricing-table .package-layout .package-value .period {
                padding: 0 0 5px 4px;
                font-size: 1.125rem;
                font-weight: 300;
                color: rgba(0, 0, 0, 0.54);
            }
            .pricing-table .terms {
                display: flex;
                flex-direction: column;
                padding: 1rem 2rem;
                font-size: 0.9125rem;
            }
            .pricing-table .terms .term span {
                font-weight: 500;
            }
            .pricing-table .buy-now {
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 1rem auto 2rem;
                padding: 2px 18px;
                min-width: 128px;
                border: none;
                border-radius: 3px;
                background-color: #2196F3;
                font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 0.875rem;
                font-weight: 500;
                color: #fff;
                line-height: 39px;
                text-transform: uppercase;
                overflow: hidden;
                will-change: box-shadow;
                transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                outline: none;
                cursor: pointer;
                text-decoration: none;
                text-align: center;
                vertical-align: middle;
                -webkit-tap-highlight-color: transparent;
                -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
                box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
            }
            .pricing-table .buy-now:hover, .pricing-table .buy-now:focus {
                box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.4);
            }
            .pricing-table .divider {
                display: block;
                border-top: 1px solid rgba(0, 0, 0, 0.12);
                margin: 16px 32px;
            }
        </style>
    @endpush
@endsection
