@extends('layouts.app')
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{!!__('front.reset_my_pass') !!}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('home')}}">{{__('front.home')}}</a></li>
                            <li>
                                {{ __('Reset Password') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Page Banner Section End -->
    <!-- Login & Register Section Start -->
    <div class="text-center login-register-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container text-center">
            <div class="row">
                <!-- Login Form Start -->
                <div class="col-lg-12 col-md-12 col-12 mr-auto mb-30">
                    <div class="login-register-form">
                        @if (session('status'))
                            <div class="badge badge-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6 mb-20">
                                    <input type="email" name="email" placeholder="{{__('front.email_address')}}" value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <strong class="badge badge-danger">{{ $errors->first('email') }}</strong>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-round btn-lg">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login Form End -->
            </div>
        </div>
    </div>
    <!-- Login & Register Section End -->
@endsection
