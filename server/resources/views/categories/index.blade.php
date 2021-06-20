@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <categories-collection :categories="{{json_encode($categories)}}"></categories-collection>
        </div>
    </div>
    {{--    <section class="content contact">--}}
{{--        <div class="block-header">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-7 col-md-6 col-sm-12">--}}
{{--                    <h2>Modals Popups--}}
{{--                        <small class="text-muted">Welcome to Nexa Application</small>--}}
{{--                    </h2>--}}
{{--                </div>--}}
{{--                <div class="col-lg-5 col-md-6 col-sm-12">--}}
{{--                    <ul class="breadcrumb float-md-right">--}}
{{--                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Nexa</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="javascript:void(0);">UI</a></li>--}}
{{--                        <li class="breadcrumb-item active">Modals</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container-fluid">--}}
{{--            <categories-collection :categories="{{json_encode($categories)}}"></categories-collection>--}}
{{--        </div>--}}
{{--    </section>--}}

@endsection

{{--<section class="content contact">--}}
{{--    <categories-collection :categories="{{json_encode($categories)}}"></categories-collection>--}}
{{--</section>--}}
