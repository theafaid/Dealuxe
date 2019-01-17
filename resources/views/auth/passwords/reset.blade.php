@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
    {{--<div class="col-md-8">--}}
    {{--<div class="card">--}}
    {{--<div class="card-header">{{ __('Reset Password') }}</div>--}}

    {{--<div class="card-body">--}}
    {{--<form method="POST" action="{{ route('password.update') }}">--}}
    {{--@csrf--}}

    {{--<input type="hidden" name="token" value="{{ $token }}">--}}

    {{--<div class="form-group row">--}}
    {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>--}}

    {{--@if ($errors->has('email'))--}}
    {{--<span class="invalid-feedback" role="alert">--}}
    {{--<strong>{{ $errors->first('email') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

    {{--@if ($errors->has('password'))--}}
    {{--<span class="invalid-feedback" role="alert">--}}
    {{--<strong>{{ $errors->first('password') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row mb-0">--}}
    {{--<div class="col-md-6 offset-md-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--{{ __('Reset Password') }}--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{{ __('Reset Password') }}</h1>
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
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-20">
                                <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="{{__('front.email_address')}}">
                                @if ($errors->has('email'))
                                <strong class="badge badge-danger">{{ $errors->first('email') }}</strong>
                                @endif
                                </div>
                                <div class="col-6 mb-20">
                                    <input type="password" name="password" placeholder="{{__('front.password')}}">
                                    @if ($errors->has('password'))
                                        <strong class="badge badge-danger">{{ $errors->first('password') }}</strong>
                                    @endif
                                </div>
                                <div class="col-6 mb-20">
                                    <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <strong class="badge badge-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-round btn-lg">
                                        {{ __('Reset Password') }}
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
