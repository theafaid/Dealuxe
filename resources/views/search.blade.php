@extends('layouts.app')
@section('content')


    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>Shop</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li>Shop</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <shop-page inline-template>
                    <ais-index
                    app-id="{{config('scout.algolia.id')}}"
                    api-key="{{config('scout.algolia.key')}}"
                    index-name="products"
                    query="{{request('q')}}"
            >
                <!-- Product Section Start -->
                <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">
                    <div class="container">

                        <!-- Shop Toolbar Start -->
                        <div class="row">
                            <div class="col">
                                <div class="shop-toolbar">
                                    <div class="product-view-mode">
                                        <button class="grid" data-mode="grid"><span>grid</span></button>
                                        <button class="list active" data-mode="list"><span>list</span></button>
                                    </div>
                                    <div class="product-showing mr-auto">
                                        <p>Showing 9 of 72</p>
                                    </div>
                                    <div class="product-short">
                                        <ais-search-box></ais-search-box>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Shop Toolbar End -->

                        <div class="col-xl-4 col-lg-4 col-sm-4 col-4 mb-30">
                            <ais-refinement-list attribute-name="categories"></ais-refinement-list>
                        </div>
                        <!-- Product Section End -->
                        <div class="shop-product-wrap list row">

                            <!-- Product Item Start -->
                            <ais-results>
                                <template slot-scope="{ result }">
                                    <product
                                            inline-template
                                            v-cloak
                                            :product="result"
                                            qnt="1"
                                            to-cart-route="{{route('cart.store')}}"
                                            remove-from-cart-route="{{route('cart.remove')}}"
                                            to-wishlist-route="{{route('wishlist.store')}}"
                                            remove-from-wishlist-route="{{route('wishlist.remove')}}">
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
                                                        <p v-text="result.description.{{lang()}}"></p>
                                                        <ul>
                                                            <li v-text="result.details.{{lang()}}"></li>
                                                        </ul>
                                                        <!-- Product Action -->
                                                        <div class="product-action">
                                                            <a href="#" class="cart"><span></span></a>
                                                            <a href="#" class="wishlist"><span></span></a>
                                                            <a href="#" class="quickview"><span></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </product>
                                    <!-- Product Item End -->
                                </template>
                            </ais-results>

                            <ais-no-results>
                                <template slot-scope="props">
                                <span class="alert alert-warning">
                                    {{__('front.no_products_founded')}} [ <i>@{{ props.query }}</i> ].
                                </span>
                                </template>
                            </ais-no-results>

                        </div>

                        <div class="row mt-20">
                            <div class="col">

                                <!-- ... -->
                                <ais-pagination class="page-pagination" v-on:page-change="onPageChange"></ais-pagination>
                                <!-- ... -->

                            </div>
                        </div>
                    </div>
                </div>
            </ais-index>
    </shop-page>
@endsection