@extends('layouts.app')
@section('content')
<template>
    <ais-index
            app-id="{{config('scout.algolia.id')}}"
            api-key="{{config('scout.algolia.key')}}"
            index-name="products"
            query="{{request('q')}}"
    >
        <!-- Product Section Start -->
        <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">
            <div class="container">
                <div class="row">



                    <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2">

                        <ais-results>
                            <template slot-scope="{ result }">
                               <div class="col-md-3">
                                   testtest
                               </div>
                            </template>
                        </ais-results>

                        <div class="row mt-20">
                            <div class="col">

                                <ul class="page-pagination">
                                    <li><a href="#"><i class="fa fa-angle-left"></i>Back</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li>-----</li>
                                    <li><a href="#">18</a></li>
                                    <li><a href="#">19</a></li>
                                    <li><a href="#">20</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i>Next</a></li>
                                </ul>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">

                        <div class="sidebar">
                            <h4 class="sidebar-title">Search</h4>
                            <div class="sidebar-search">
                                <ais-search-box></ais-search-box>
                                {{--<form action="#">--}}
                                    {{--<input type="text" placeholder="Enter key words">--}}
                                    {{--<input type="submit" value="search">--}}
                                {{--</form>--}}
                            </div>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">Brand</h4>
                            <ul class="sidebar-list">
                                <li><a href="#">Baizidale Momone</a></li>
                                <li><a href="#">Murikhete Paris</a></li>
                                <li><a href="#">Vortahole Valohoi</a></li>
                                <li><a href="#">Origeno Veledita</a></li>
                                <li><a href="#">Buffekhete Parbi</a></li>
                                <li><a href="#">Makorone Cicile</a></li>
                            </ul>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">Price</h4>
                            <div id="price-range"></div>
                        </div>

                        <div class="sidebar">
                            <div class="banner"><a href="#"><img src="assets/images/banner/banner-3.jpg" alt=""></a></div>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">Tags</h4>
                            <div class="tag-cloud">
                                <a href="#">Oil</a>
                                <a href="#">Beard oil</a>
                                <a href="#">Beard</a>
                                <a href="#">Stylish</a>
                                <a href="#">Ecommerce</a>
                                <a href="#">Shop</a>
                                <a href="#">Shopping</a>
                                <a href="#">Store</a>
                                <a href="#">Online Store</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Product Section End -->
    </ais-index>
</template>
@endsection