@extends('layouts.app')

@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{!!__('front.login_and_register') !!}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                            <li>{!!__('front.login_and_register') !!}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- Page Banner Section End -->
    <!-- Login & Register Section Start -->
    <div class="login-register-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
                <!-- Login Form Start -->
                <div class="col-lg-4 col-md-6 col-12 mr-auto mb-30">
                    <div class="login-register-form">
                        <h3>{{__('front.already_member')}}</h3>
                        @include('layouts.partials._login_form')
                    </div>
                </div>
                <!-- Login Form End -->
                <!-- Login Form Start -->
                <div class="col-lg-7 col-md-6 col-12 mb-30">
                    <div class="login-register-form">
                        <h3>{{__('front.new_member')}}</h3>
                        @include('layouts.partials._register_form')
                    </div>
                </div>
                <!-- Login Form End -->
            </div>
        </div>
    </div>
    <!-- Login & Register Section End -->
@endsection
