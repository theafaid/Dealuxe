@extends('layouts.app')
@section('content')
    <!-- Slider Start -->
    <div class="slider-area">
        <div class="slider-active owl-dot-style owl-carousel">
            <div class="single-slider ptb-240 bg-img" style="background-image:url({{asset('design')}}/img/slider/slider-1.jpg);">
                <div class="container">
                    <div class="slider-content slider-animated-1">
                        <h1 class="animated">Want to stay <span class="theme-color">healthy</span></h1>
                        <h1 class="animated">drink matcha.</h1>
                        <p>Lorem ipsum dolor sit amet, consectetu adipisicing elit sedeiu tempor inci ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="single-slider ptb-240 bg-img" style="background-image:url({{asset('design')}}/img/slider/slider-1-1.jpg);">
                <div class="container">
                    <div class="slider-content slider-animated-1">
                        <h1 class="animated">Want to stay <span class="theme-color">healthy</span></h1>
                        <h1 class="animated">drink matcha.</h1>
                        <p>Lorem ipsum dolor sit amet, consectetu adipisicing elit sedeiu tempor inci ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider End -->
    <!-- Product Area Start -->
    <div class="product-area bg-image-1 pt-100 pb-95">
        <div class="container">
            <div class="featured-product-active hot-flower owl-carousel product-nav">
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img alt="" src="{{asset('design')}}/img/product/product-1.jpg">
                        </a>
                        <span>-20%</span>
                        <div class="product-action">
                            <a class="action-wishlist" href="#" title="Wishlist">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                            <a class="action-cart" href="#" title="Add To Cart">
                                <i class="ion-ios-shuffle-strong"></i>
                            </a>
                            <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content text-left">
                        <div class="product-hover-style">
                            <div class="product-title">
                                <h4>
                                    <a href="product-details.html">Nature Close Tea</a>
                                </h4>
                            </div>
                            <div class="cart-hover">
                                <h4><a href="product-details.html">+ Add to cart</a></h4>
                            </div>
                        </div>
                        <div class="product-price-wrapper">
                            <span>$100.00 -</span>
                            <span class="product-price-old">$120.00 </span>
                        </div>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img alt="" src="{{asset('design')}}/img/product/product-2.jpg">
                        </a>
                        <div class="product-action">
                            <a class="action-wishlist" href="#" title="Wishlist">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                            <a class="action-cart" href="#" title="Add To Cart">
                                <i class="ion-ios-shuffle-strong"></i>
                            </a>
                            <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content text-left">
                        <div class="product-hover-style">
                            <div class="product-title">
                                <h4>
                                    <a href="product-details.html">Pink wave Cup</a>
                                </h4>
                            </div>
                            <div class="cart-hover">
                                <h4><a href="product-details.html">+ Add to cart</a></h4>
                            </div>
                        </div>
                        <div class="product-price-wrapper">
                            <span>$100.00 -</span>
                            <span class="product-price-old">$120.00 </span>
                        </div>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img alt="" src="{{asset('design')}}/img/product/product-3.jpg">
                        </a>
                        <span>-50%</span>
                        <div class="product-action">
                            <a class="action-wishlist" href="#" title="Wishlist">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                            <a class="action-cart" href="#" title="Add To Cart">
                                <i class="ion-ios-shuffle-strong"></i>
                            </a>
                            <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content text-left">
                        <div class="product-hover-style">
                            <div class="product-title">
                                <h4>
                                    <a href="product-details.html">Tea and Chai</a>
                                </h4>
                            </div>
                            <div class="cart-hover">
                                <h4><a href="product-details.html">+ Add to cart</a></h4>
                            </div>
                        </div>
                        <div class="product-price-wrapper">
                            <span>$100.00 -</span>
                            <span class="product-price-old">$120.00 </span>
                        </div>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img alt="" src="{{asset('design')}}/img/product/product-4.jpg">
                        </a>
                        <div class="product-action">
                            <a class="action-wishlist" href="#" title="Wishlist">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                            <a class="action-cart" href="#" title="Add To Cart">
                                <i class="ion-ios-shuffle-strong"></i>
                            </a>
                            <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content text-left">
                        <div class="product-hover-style">
                            <div class="product-title">
                                <h4>
                                    <a href="product-details.html">Pearly Everlasting</a>
                                </h4>
                            </div>
                            <div class="cart-hover">
                                <h4><a href="product-details.html">+ Add to cart</a></h4>
                            </div>
                        </div>
                        <div class="product-price-wrapper">
                            <span>$100.00 -</span>
                            <span class="product-price-old">$120.00 </span>
                        </div>
                    </div>
                </div>
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img alt="" src="{{asset('design')}}/img/product/product-5.jpg">
                        </a>
                        <span>-30%</span>
                        <div class="product-action">
                            <a class="action-wishlist" href="#" title="Wishlist">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                            <a class="action-cart" href="#" title="Add To Cart">
                                <i class="ion-ios-shuffle-strong"></i>
                            </a>
                            <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content text-left">
                        <div class="product-hover-style">
                            <div class="product-title">
                                <h4>
                                    <a href="product-details.html">Que herbal Tea</a>
                                </h4>
                            </div>
                            <div class="cart-hover">
                                <h4><a href="product-details.html">+ Add to cart</a></h4>
                            </div>
                        </div>
                        <div class="product-price-wrapper">
                            <span>$100.00 -</span>
                            <span class="product-price-old">$120.00 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End -->
    <!-- Banner Start -->
    <div class="banner-area pt-100 pb-70">
        <div class="container">
            <div class="banner-wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner img-zoom mb-30">
                            <a href="#">
                                <img src="{{asset('design')}}/img/banner/banner-1.png" alt="">
                            </a>
                            <div class="banner-content">
                                <h4>-50% Sale</h4>
                                <h5>Summer Vacation</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner img-zoom mb-30">
                            <a href="#">
                                <img src="{{asset('design')}}/img/banner/banner-2.png" alt="">
                            </a>
                            <div class="banner-content">
                                <h4>-20% Sale</h4>
                                <h5>Winter Vacation</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- New Products Start -->
    <div class="product-area gray-bg pt-90 pb-65">
        <div class="container">
            <div class="product-top-bar section-border mb-55">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title">New Products</h3>
                </div>
            </div>
            <div class="tab-content jump">
                <div class="tab-pane active">
                    <div class="featured-product-active owl-carousel product-nav">
                        <div class="product-wrapper-single">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-1.jpg">
                                    </a>
                                    <span>-30%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">BeBe Bloom tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-2.jpg">
                                    </a>
                                    <span>-50%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Every spice Tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrapper-single">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-3.jpg">
                                    </a>
                                    <span>-60%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Que herbal Tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-4.jpg">
                                    </a>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Tea and Chai</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrapper-single">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-5.jpg">
                                    </a>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Society Ice Tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-6.jpg">
                                    </a>
                                    <span>-40%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Green Tea Tulsi</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrapper-single">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-7.jpg">
                                    </a>
                                    <span>-60%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Best Friends Tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-8.jpg">
                                    </a>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Instant Tea Premix</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrapper-single">
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-4.jpg">
                                    </a>
                                    <span>-30%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Black Ossum Tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wrapper mb-30">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img alt="" src="{{asset('design')}}/img/product/product-3.jpg">
                                    </a>
                                    <span>-70%</span>
                                    <div class="product-action">
                                        <a class="action-wishlist" href="#" title="Wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                        <a class="action-cart" href="#" title="Add To Cart">
                                            <i class="ion-ios-shuffle-strong"></i>
                                        </a>
                                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content text-left">
                                    <div class="product-hover-style">
                                        <div class="product-title">
                                            <h4>
                                                <a href="product-details.html">Le Bongai Tea</a>
                                            </h4>
                                        </div>
                                        <div class="cart-hover">
                                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                                        </div>
                                    </div>
                                    <div class="product-price-wrapper">
                                        <span>$100.00 -</span>
                                        <span class="product-price-old">$120.00 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Products End -->
    <!-- Testimonial Area Start -->
    <div class="testimonials-area bg-img pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="testimonial-active owl-carousel">
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <img alt="" src="{{asset('design')}}/img/icon-img/testi.png">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore</p>
                            <h4>Gregory Perkins</h4>
                            <h5>Customer</h5>
                        </div>
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <img alt="" src="{{asset('design')}}/img/icon-img/testi.png">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore</p>
                            <h4>Khabuli Teop</h4>
                            <h5>Marketing</h5>
                        </div>
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <img alt="" src="{{asset('design')}}/img/icon-img/testi.png">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore </p>
                            <h4>Lotan Jopon</h4>
                            <h5>Admin</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area End -->
    <!-- News Area Start -->
    <div class="blog-area bg-image-1 pt-90 pb-70">
        <div class="container">
            <div class="product-top-bar section-border mb-55">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title">Latest News</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-single mb-30">
                        <div class="blog-thumb">
                            <a href="#"><img src="{{asset('design')}}/img/blog/blog-single-1.jpg" alt="" /></a>
                        </div>
                        <div class="blog-content pt-25">
                            <span class="blog-date">14 Sep</span>
                            <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut labore et dolore</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-single mb-30">
                        <div class="blog-thumb">
                            <a href="#"><img src="{{asset('design')}}/img/blog/blog-single-2.jpg" alt="" /></a>
                        </div>
                        <div class="blog-content pt-25">
                            <span class="blog-date">20 Dec</span>
                            <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut labore et dolore</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-single mb-30">
                        <div class="blog-thumb">
                            <a href="#"><img src="{{asset('design')}}/img/blog/blog-single-3.jpg" alt="" /></a>
                        </div>
                        <div class="blog-content pt-25">
                            <span class="blog-date">18 Aug</span>
                            <h3><a href="#">Lorem ipsum sit ame co.</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eius tempor incididunt ut labore et dolore</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- News Area End -->
    <!-- Newsletter Araea Start -->
    <div class="newsletter-area bg-image-2 pt-90 pb-100">
        <div class="container">
            <div class="product-top-bar section-border mb-45">
                <div class="section-title-wrap text-center">
                    <h3 class="section-title">Join to our Newsletter</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-10 col-md-auto">
                    <div class="footer-newsletter">
                        <div id="mc_embed_signup" class="subscribe-form">
                            <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll" class="mc-form">
                                    <input type="email" value="" name="EMAIL" class="email" placeholder="Your Email Address*" required>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div class="mc-news" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                    <div class="submit-button">
                                        <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Araea End -->
@endsection