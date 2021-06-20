<!DOCTYPE html>
<html lang="{{$currentLocale}}">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/{{siteSettings('site_icon')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>{{siteSettings('site_name')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{asset('design/admin')}}/css/nucleo-icons.css" rel="stylesheet" />
    <!-- Font awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{asset('design/admin')}}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset('design/admin')}}/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />

    @if($currentLocale == 'ar')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" />
    @endif
    <script src="{{route('admin.assets.lang')}}"></script>
</head>

<body class="{{$themeMode ?: 'white-content'}} {{$currentLocale == 'ar' ? 'rtl menu-on-right' : ''}}">
