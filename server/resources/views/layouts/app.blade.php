@php
    $currentLocale = LaravelLocalization::getCurrentLocale();
    $themeMode = \Cookie::get('theme-mode');
    $layoutColor = \Cookie::get('layout-color');
@endphp


@include('layouts.partials.header')
<div class="wrapper" id="app">
    @auth('admin')
    @include('layouts.partials.sidebar')
    @endauth
    <div class="main-panel">
        @auth('admin')
        @include('layouts.partials.navbar')
        @endauth
        <div class="content">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </div>
</div>
    @include('layouts.partials.scripts')

