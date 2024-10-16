@extends('frontend.layouts.layout')

@section('content')
    <main class="bashboard-main">
        <div class="container-fluid">
            <div class="row m-0">
                <div class="d-flex align-items-stretch">
                    @include('frontend.includes.sidebar')
                    <div class="right-side w-100">
                        @if (session('success'))
                        <div class="alert alert-success"  style=" font-family: 'Graphik';">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('message'))
                        <div class="alert alert-success"  style=" font-family: 'Graphik';">
                            {{ session('message') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger"   style=" font-family: 'Graphik';">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="dashboard-icon" id="mobile-menu-toggle">
                            <a href="#" class="menu-icon indent">
                                <span class="menu-icon__text">Show Menu</span>
                            </a>
                            <!-- <h6>Menu</h6> -->
                        </div>
                        <div class="right-side-main h-100 analytics-sec">
                            <div class="row">
                                <div class="col-xl-3 col-md-4">
                                    <div class="sub-text">
                                        <p>Active Plan</p>
                                        <h6 class="basic-title {{ ($buy->plan_id == 2 || $buy->plan_id == 3) ? 'd-none' : '' }}">Basic Listing</h6>
                                        <h6 class="Enhanced-title {{ ($buy->plan_id == 1 || $buy->plan_id == 3) ? 'd-none' : '' }} ">Enhanced Visability</h6>
                                        <h6 class="Premium-title {{ ($buy->plan_id == 2 || $buy->plan_id == 1) ? 'd-none' : '' }} ">Premium Showcase</h6>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-4">
                                    <div class="sub-text">
                                        <p>Exprired on</p>
                                         <h6 class="basic-title {{ ($buy->plan_id == 2 || $buy->plan_id == 3) ? 'd-none' : '' }}">There is no Expiry date on Basic Plan</h6>
                                         
                                        <h6 class="Enhanced-title {{ ($buy->plan_id == 1 || $buy->plan_id == 3)  ? 'd-none' : '' }} ">@php
                                        
                                            $currentDate = now();

                                            // Add one month to the current date
                                            $expiryDate = $currentDate->addMonth()->format('j F Y');
                                        @endphp {{$expiryDate}}</h6>
                                        <h6 class="Premium-title {{ ($buy->plan_id == 1 || $buy->plan_id == 2)  ? 'd-none' : '' }} ">@php
                                        
                                            $currentDate = now();

                                            // Add one month to the current date
                                            $expiryDate = $currentDate->addMonth()->format('j F Y');
                                        @endphp {{$expiryDate}}</h6>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-4">
                                    <div class="sub-text">
                                        <p>Invoice</p>
                                        <h6>Download Invoice <a href="{{ route('business.downloadInvoice',encrypt($sdata->id)) }}"><span class="download-btn ms-2"><span class="icon-download"></span></span></a></h6>
                                    </div>
                                </div>
                                <div class="col-xl-3 text-xl-end text-center">
                                    <form action="{{ route('business.updateSub',encrypt($sdata->id)) }}" method="Post">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="id" value="{{$sdata->id}}">
                                        <button class="btn btn-primary px-xl-5 basic-title {{ ($buy->plan_id == 2 || $buy->plan_id == 3) ? 'd-none' : '' }}" name="plan" value="basic" type="submit" disabled >Update</button>
                                        <button class="btn btn-primary px-xl-5 Enhanced-title {{ ($buy->plan_id == 1 || $buy->plan_id == 3) ? 'd-none' : '' }}" name="plan" value="enhanced" type="submit" disabled >Update</button>
                                        <button class="btn btn-primary px-xl-5 Premium-title {{ ($buy->plan_id == 2 || $buy->plan_id == 1) ? 'd-none' : '' }}" name="plan" value="premium" type="submit" disabled >Update</button>

                                    </form>
                                </div>
                            </div>
                            <hr>
                            <h4 class="all-right-head my-4">Subscription </h4>
                            <div class="row gy-5">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="box-sub basic {{ $buy->plan_id == 1 ? 'active' : '' }}">
                                            <div class="top-box">
                                                <p>Basic Listing</p>
                                            </div>
                                            <div class="center-text">
                                                <h6><span class="doll">$</span><span class="big">100</span></h6>
                                                <p>+GST (one-off)</p>
                                            </div>
                                            <ul class="list-ul">
                                                <li><span class="icon-list-check"></span> Listed on BeHere</li>
                                                <li><span class="icon-list-close"></span> Highlighted listing’s</li>
                                                <li><span class="icon-list-close"></span> Priority placement</li>
                                                <li><span class="icon-list-close"></span> Offer deals and discounts</li>
                                                <li><span class="icon-list-close"></span> Reward users with points</li>
                                                <li><span class="icon-list-close"></span> Push notifications</li>
                                                <li><span class="icon-list-close"></span> Advanced analytics</li>
                                                <li><span class="icon-list-close"></span> User spend and tracking</li>
                                                <li><span class="icon-list-close"></span> Customer insights</li>
                                                <li><span class="icon-list-close"></span> Users can spend points with you</li>

                                            </ul>
                                            <div class="button-div">
                                                <a href="#" class="btn btn-primary px-xl-5 {{ ($buy->plan_id == 2 || $buy->plan_id == 3) ? 'gray-btn' : '' }}" type="submit"
                                                    id="basic">Select</a>
                                            </div>
                                            <figure class="box-fig"><img
                                                    src="{{ asset('public/business_assets/images/box-bottom.svg') }}"
                                                    alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="box-sub Enhanced {{ $buy->plan_id == 2 ? 'active' : '' }}">
                                            <div class="top-box">
                                                <p>Enhanced Visability</p>
                                            </div>
                                            <div class="center-text">
                                                <h6><span class="doll">$</span><span class="big">50</span></h6>
                                                <p>+GST (Per Month, Minimum 3 Months)</p>
                                            </div>
                                            <ul class="list-ul">
                                                <li><span class="icon-list-check"></span> Listed on BeHere</li>
                                                <li><span class="icon-list-check"></span> Highlighted listing’s</li>
                                                <li><span class="icon-list-check"></span> Priority placement</li>
                                                <li><span class="icon-list-check"></span> Offer deals and discounts</li>
                                                <li><span class="icon-list-check"></span> Reward users with points</li>
                                                <li><span class="icon-list-check"></span> Push notifications</li>
                                                <li><span class="icon-list-close"></span> Advanced analytics</li>
                                                <li><span class="icon-list-close"></span> User spend and tracking</li>
                                                <li><span class="icon-list-close"></span> Customer insights</li>
                                                <li><span class="icon-list-close"></span> Users can spend points with you</li>

                                            </ul>
                                            <div class="button-div">
                                                <a href="#" class="btn btn-primary px-xl-5 {{ ($buy->plan_id == 3 || $buy->plan_id == 1) ? 'gray-btn' : '' }}" type="submit"
                                                    id="Enhanced">Select</a>
                                            </div>
                                            <figure class="box-fig"><img
                                                    src="{{ asset('public/business_assets/images/box-bottom.svg') }}"
                                                    alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="box-sub Premium {{ $buy->plan_id == 3 ? 'active' : '' }}">
                                            <div class="top-box">
                                                <p>Premium Showcase</p>
                                            </div>
                                            <div class="center-text">
                                                <h6><span class="doll">$</span><span class="big">70</span></h6>
                                                <p>+GST (Per Month, Minimum 3 Months)</p>
                                            </div>
                                            <ul class="list-ul">
                                                <li><span class="icon-list-check"></span> Listed on BeHere</li>
                                                <li><span class="icon-list-check"></span> Highlighted listing’s</li>
                                                <li><span class="icon-list-check"></span> Priority placement</li>
                                                <li><span class="icon-list-check"></span> Offer deals and discounts</li>
                                                <li><span class="icon-list-check"></span> Reward users with points</li>
                                                <li><span class="icon-list-check"></span> Push notifications</li>
                                                <li><span class="icon-list-check"></span> Advanced analytics</li>
                                                <li><span class="icon-list-check"></span> User spend and tracking</li>
                                                <li><span class="icon-list-check"></span> Customer insights</li>
                                                <li><span class="icon-list-check"></span> Users can spend points with you</li>

                                            </ul>
                                            <div class="button-div">
                                                <a href="#" class="btn btn-primary  px-xl-5 {{ ($buy->plan_id == 2 || $buy->plan_id == 1) ? 'gray-btn' : '' }}" type="submit"
                                                    id="Premium">Select</a>
                                            </div>
                                            <figure class="box-fig"><img
                                                    src="{{ asset('public/business_assets/images/box-bottom.svg') }}"
                                                    alt=""></figure>
                                        </div>
                                    </div>
                            </div>
                            <!-- <div class="slider-sub owl-carousel owl-theme owl-loaded owl-drag">
                                <div class="item">
                                    <div class="box-sub basic {{ $buy->plan_id == 1 ? 'active' : '' }}">
                                        <div class="top-box">
                                            <p>Basic Listing</p>
                                        </div>
                                        <div class="center-text">
                                            <h6><span class="doll">$</span><span class="big">100</span></h6>
                                            <p>+GST (one-off)</p>
                                        </div>
                                        <ul class="list-ul">
                                            <li><span class="icon-list-check"></span> Listed on BeHere</li>
                                            <li><span class="icon-list-close"></span> Highlighted listing’s</li>
                                            <li><span class="icon-list-close"></span> Priority placement</li>
                                            <li><span class="icon-list-close"></span> Offer deals and discounts</li>
                                            <li><span class="icon-list-close"></span> Reward users with points</li>
                                            <li><span class="icon-list-close"></span> Push notifications</li>
                                            <li><span class="icon-list-close"></span> Advanced analytics</li>
                                            <li><span class="icon-list-close"></span> User spend and tracking</li>
                                            <li><span class="icon-list-close"></span> Customer insights</li>
                                            <li><span class="icon-list-close"></span> Users can spend points with you</li>

                                        </ul>
                                        <div class="button-div">
                                            <a href="#" class="btn btn-primary px-xl-5 {{ ($buy->plan_id == 2 || $buy->plan_id == 3) ? 'gray-btn' : '' }}" type="submit"
                                                id="basic">Select</a>
                                        </div>
                                        <figure class="box-fig"><img
                                                src="{{ asset('public/business_assets/images/box-bottom.svg') }}"
                                                alt=""></figure>
                                    </div>
                                    <p class="bottom-pra">50% Discount</p>
                                </div>
                                <div class="item">
                                    <div class="box-sub Enhanced {{ $buy->plan_id == 2 ? 'active' : '' }}">
                                        <div class="top-box">
                                            <p>Enhanced Visability</p>
                                        </div>
                                        <div class="center-text">
                                            <h6><span class="doll">$</span><span class="big">50</span></h6>
                                            <p>+GST (Per Month, Minimum 3 Months)</p>
                                        </div>
                                        <ul class="list-ul">
                                            <li><span class="icon-list-check"></span> Listed on BeHere</li>
                                            <li><span class="icon-list-check"></span> Highlighted listing’s</li>
                                            <li><span class="icon-list-check"></span> Priority placement</li>
                                            <li><span class="icon-list-check"></span> Offer deals and discounts</li>
                                            <li><span class="icon-list-check"></span> Reward users with points</li>
                                            <li><span class="icon-list-check"></span> Push notifications</li>
                                            <li><span class="icon-list-close"></span> Advanced analytics</li>
                                            <li><span class="icon-list-close"></span> User spend and tracking</li>
                                            <li><span class="icon-list-close"></span> Customer insights</li>
                                            <li><span class="icon-list-close"></span> Users can spend points with you</li>

                                        </ul>
                                        <div class="button-div">
                                            <a href="#" class="btn btn-primary px-xl-5 {{ ($buy->plan_id == 3 || $buy->plan_id == 1) ? 'gray-btn' : '' }}" type="submit"
                                                id="Enhanced">Select</a>
                                        </div>
                                        <figure class="box-fig"><img
                                                src="{{ asset('public/business_assets/images/box-bottom.svg') }}"
                                                alt=""></figure>
                                    </div>
                                    <p class="bottom-pra">50% Discount</p>
                                </div>
                                <div class="item">
                                    <div class="box-sub Premium {{ $buy->plan_id == 3 ? 'active' : '' }}">
                                        <div class="top-box">
                                            <p>Premium Showcase</p>
                                        </div>
                                        <div class="center-text">
                                            <h6><span class="doll">$</span><span class="big">70</span></h6>
                                            <p>+GST (Per Month, Minimum 3 Months)</p>
                                        </div>
                                        <ul class="list-ul">
                                            <li><span class="icon-list-check"></span> Listed on BeHere</li>
                                            <li><span class="icon-list-check"></span> Highlighted listing’s</li>
                                            <li><span class="icon-list-check"></span> Priority placement</li>
                                            <li><span class="icon-list-check"></span> Offer deals and discounts</li>
                                            <li><span class="icon-list-check"></span> Reward users with points</li>
                                            <li><span class="icon-list-check"></span> Push notifications</li>
                                            <li><span class="icon-list-check"></span> Advanced analytics</li>
                                            <li><span class="icon-list-check"></span> User spend and tracking</li>
                                            <li><span class="icon-list-check"></span> Customer insights</li>
                                            <li><span class="icon-list-check"></span> Users can spend points with you</li>

                                        </ul>
                                        <div class="button-div">
                                            <a href="#" class="btn btn-primary  px-xl-5 {{ ($buy->plan_id == 2 || $buy->plan_id == 1) ? 'gray-btn' : '' }}" type="submit"
                                                id="Premium">Select</a>
                                        </div>
                                        <figure class="box-fig"><img
                                                src="{{ asset('public/business_assets/images/box-bottom.svg') }}"
                                                alt=""></figure>
                                    </div>
                                    <p class="bottom-pra">50% Discount</p>
                                </div>

                            </div> -->
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
<style>
    .change-hike {
        display: none
    }
</style>
@section('script')
    <script>
        $(document).ready(function() {
            $('#basic').on('click', function() {
                $(".basic-title").removeClass("d-none");
                $(".Enhanced-title").addClass("d-none");
                $(".Premium-title").addClass("d-none");

                $("#basic").removeClass("gray-btn");
                $("#Enhanced").addClass("gray-btn");
                $("#Premium").addClass("gray-btn");

                $(".basic").addClass("active");
                $(".Enhanced").removeClass("active");
                $(".Premium").removeClass("active");
            })
        });
        $(document).ready(function() {
            $('#Enhanced').on('click', function() {
                $(".basic-title").addClass("d-none");
                $(".Enhanced-title").removeClass("d-none");
                $(".Premium-title").addClass("d-none");

                $("#basic").addClass("gray-btn");
                $("#Enhanced").removeClass("gray-btn");
                $("#Premium").addClass("gray-btn");

                $(".basic").removeClass("active");
                $(".Enhanced").addClass("active");
                $(".Premium").removeClass("active");
            })
        });
        $(document).ready(function() {
            $('#Premium').on('click', function() {
                $(".basic-title").addClass("d-none");
                $(".Enhanced-title").addClass("d-none");
                $(".Premium-title").removeClass("d-none");

                $("#basic").addClass("gray-btn");
                $("#Enhanced").addClass("gray-btn");
                $("#Premium").removeClass("gray-btn");

                $(".basic").removeClass("active");
                $(".Enhanced").removeClass("active");
                $(".Premium").addClass("active");
            })
        });
    </script>
@endsection
