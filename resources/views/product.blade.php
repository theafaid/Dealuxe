@extends('layouts.app')
@section('content')
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="page-banner text-center">
                    <h1>{{__('front.product_details')}}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                        <li><a href="{{route('shop.index')}}">{{__('front.shop')}}</a></li>
                        <li>{{$product->name}}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div><!-- Page Banner Section End -->

<shop-page inline-template>
    <!-- Product Section Start -->
    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <product
                            inline-template
                            v-cloak
                            :product="{{$product}}"
                            to-cart-route="{{route('cart.store')}}"
                            remove-from-cart-route="{{route('cart.remove')}}"
                            to-wishlist-route="{{route('wishlist.store')}}"
                            remove-from-wishlist-route="{{route('wishlist.remove')}}">
                        <div class="product-details mb-50">
                            <!-- Image -->
                            <div class="product-image left-thumbnail mb-xs-20">
                                <!-- Image -->
                                <div class="product-slider single-product-slider-syn">
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-1.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-2.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-3.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-4.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-5.jpg" alt=""></div>
                                </div>
                                <div class="product-slider single-product-thumb-slider-syn" data-vertical="true">
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-1.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-2.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-3.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-4.jpg" alt=""></div>
                                    <div class="item"><img src="{{asset('design')}}/images/product/product-5.jpg" alt=""></div>
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="product-content">
                                <div class="product-content-inner">
                                    <div class="head">
                                        <!-- Title-->
                                        <div class="top">
                                            <h4 class="title">{{$product->name}}</h4>
                                        </div>
                                        <!-- Price & Ratting -->
                                        <div class="bottom">
                                            <span class="price">{{$product->presentPrice()}}<span class="old">$75</span></span>
                                            <span class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <p>
                                            {{$product->description}}
                                        </p>

                                        <form method="POST" action="{{route('cart.store')}}">
                                            @csrf
                                            <input type="hidden" name="product" value="{{$product->slug}}">

                                            <div class="quantity">
                                                <h4>Quantity:</h4>
                                                <div class="pro-qty"><input type="number" name="qnt" value="1" min="1" max="15"></div>
                                            </div>

                                            @auth
                                                <!-- Product Action -->
                                                <div class="product-action">
                                                    <a
                                                            :class="inCart ? 'btn btn-primary' : 'btn btn-default'"
                                                            @click.prevent="storeUpdate('cart')">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                    <a
                                                            :class="inWishlist ? 'btn btn-danger' : 'btn btn-default'"
                                                            @click.prevent="storeUpdate('wishlist')" :class="inWishlist ? 'btn-action' : ''">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <a class="btn btn-danger" href="{{route('auth_portal')}}">
                                                    {{__('front.interested_signin')}}
                                                </a>
                                            @endauth
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </product>

                    <ul class="product-details-tab-list nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a></li>
                        <li><a data-toggle="tab" href="#specification">Details</a></li>
                        <li><a data-toggle="tab" href="#reviews">Reviews(15)</a></li>
                    </ul>
                    <div class="product-details-tab-content tab-content">
                        <div class="tab-pane active" id="description">
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="tab-pane" id="specification">
                            {{$product->details}}
                            {{--<ul class="specification">--}}
                            {{--<li>We provide the best Beard oil all over the world</li>--}}
                            {{--<li>We are the worldd best store for Beard Oil</li>--}}
                            {{--<li>You can buy our product without any hegitation.</li>--}}
                            {{--<li>We always consus about our product quality</li>--}}
                            {{--<li>Your can trust our product and this is our main goal.</li>--}}
                            {{--</ul>--}}
                        </div>
                        <div class="tab-pane" id="reviews">
                            <div class="review-list">
                                <div class="review">
                                    <h4 class="name">Joe Flores <span>9 March 2018</span></h4>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam.</p>
                                    </div>
                                </div>
                                <div class="review">
                                    <h4 class="name">Amber Roberts <span>9 March 2018</span></h4>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="review-form">
                                <h3>Give your Review:</h3>
                                <form action="#">

                                    <div class="ratting">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="row row-10">
                                        <div class="col-md-6 col-12 mb-20"><input type="text" placeholder="Name"></div>
                                        <div class="col-md-6 col-12 mb-20"><input type="email" placeholder="Email"></div>
                                        <div class="col-12 mb-20"><textarea placeholder="Review"></textarea></div>
                                        <div class="col-12"><input type="submit" value="Submit"></div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    @include('layouts.partials._might_like')
                </div>

            </div>
        </div>
    </div>
    <!-- Product Section End -->
</shop-page>
@endsection