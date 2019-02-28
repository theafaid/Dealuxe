@extends('layouts.app')
@section('content')


    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{{__('front.search')}}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('shop.index')}}">{{__('front.shop')}}</a></li>
                            <li>{{__('front.search')}}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <template>
        <ais-index
                app-id="{{config('scout.algolia.id')}}"
                api-key="{{config('scout.algolia.key')}}"
                index-name="products"
                query="{{request('q')}}"
        >

            <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2">
                            <!-- Shop Toolbar Start -->
                            <div class="row">
                                <div class="col">
                                    <div class="shop-toolbar">
                                        <div class="product-showing mr-auto">
                                            <p>
                                                <a href="{{route('shop.index', ['category' => request('category'), 'sortBy' => 'price_high_low'])}}">
                                                    {{__('front.price_high_low')}}
                                                </a>
                                                |
                                                <a href="{{route('shop.index', ['category' => request('category'), 'sortBy' => 'price_low_high'])}}">
                                                    {{__('front.price_low_high')}}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Shop Toolbar End -->


                            <ais-results>
                                <template slot-scope="{ result }">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-12 mb-30">
                                        <div class="product-item list">
                                            <!-- Image -->
                                            <div class="product-image">
                                                <!-- Image -->
                                                <a :href="result.path" class="image"><img :src="result.image" alt=""></a>
                                                <!-- Product Action -->
                                                <div class="product-action">
                                                    <a href="#" class="cart"><span></span></a>
                                                    <a href="#" class="wishlist"><span></span></a>
                                                    <a href="#" class="quickview"><span></span></a>
                                                </div>
                                            </div>
                                            <!-- Content -->
                                            <div class="product-content">
                                                <div class="head">
                                                    <!-- Title-->
                                                    <div class="top">
                                                        <h3>
                                                            <a :href="result.path">
                                                                <ais-highlight :result="result" attribute-name="name.{{lang()}}"></ais-highlight>
                                                            </a>
                                                        </h3>
                                                    </div>
                                                    <!-- Price & Ratting -->
                                                    <div class="bottom">
                                                        <span class="price" v-text="'$'+(result.price/100)"></span>
                                                    </div>
                                                </div>
                                                <div class="body">
                                                    <ul>
                                                        <li v-text="result.details.{{lang()}}"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Item End -->
                                </template>
                            </ais-results>
                            <!-- Product Item Start -->
                        </div>

                        <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">


                            <div class="sidebar">
                                <h4 class="sidebar-title">Search</h4>
                                <div class="sidebar-search">
                                    <ais-search-box></ais-search-box>

                                </div>
                            </div>

                            <div class="sidebar">
                                <ais-refinement-list attribute-name="categories"></ais-refinement-list>
                            </div>

                            <div class="sidebar">
                                <h4 class="sidebar-title">Price</h4>
                                <div id="price-range"></div>
                            </div>

                            <div class="sidebar">
                                <div class="banner"><a href="#"><img src="{{asset('design')}}/images/banner/banner-3.jpg" alt=""></a></div>
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
