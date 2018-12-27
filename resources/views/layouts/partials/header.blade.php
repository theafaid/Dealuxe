<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bardy - SHARED ON THEMELOCK.COM</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('design')}}/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('design')}}/css/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('design')}}/css/font-awesome.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('design')}}/css/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('design')}}/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('design')}}/css/style.css">
    <script src="https://js.stripe.com/v3/"></script>
    @stack('header')
    <!-- Modernizer JS -->
    <script src="{{asset('design')}}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<div class="main-wrapper">