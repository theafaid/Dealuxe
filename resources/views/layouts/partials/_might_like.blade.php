<!-- Product Slider 4 Column Start-->
<div class="row mt-50">
    <div class="section-title left section col mb-40 mb-xs-30">
        <h1>{{__('front.you_may_like')}}</h1>
    </div>

    <div class="product-slider product-slider-4 section">
        <!-- Product Slider 4 Column End-->

        @foreach($mightLike as $product)
            <product
                    inline-template
                    v-cloak
                    :product="{{$product}}"
                    to-cart-route="{{route('cart.store')}}"
                    remove-from-cart-route="{{route('cart.remove')}}"
                    to-wishlist-route="{{route('wishlist.store')}}"
                    remove-from-wishlist-route="{{route('wishlist.remove')}}"
            >
                <!-- Product Item Start -->
                <div class="col">
                    <div class="product-item">
                        <!-- Image -->
                        <div class="product-image">
                            <!-- Image -->
                            <a href="product-details-variable.html" class="image"><img src="{{asset('design/images/product/product-1.jpg')}}" alt=""></a>
                        @if(auth()->user() && auth()->user()->hasVerifiedEmail())
                            <!-- Product Action -->
                                <div class="product-action">
                                    <a @click.prevent="storeUpdate('cart')" :class="inCart ? 'btn btn-primary' : 'btn btn-default'">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                    <a @click.prevent="storeUpdate('wishlist')" :class="inWishlist ? 'btn btn-danger' : 'btn btn-default'">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a href="#" class="quickview"><span></span></a>
                                </div>
                            @endauth
                        </div>
                        <!-- Content -->
                        <div class="product-content">
                            <div class="head">
                                <!-- Title-->
                                <div class="top">
                                    <h4 class="title"><a href="{{route('shop.show', $product->slug)}}">{{$product->name}}</a></h4>
                                </div>
                                <!-- Price & Ratting -->
                                <div class="bottom">
                                    <span class="price">{{presentPrice($product->price)}} <span class="old">$65</span></span>
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
                                <!-- Product Action -->
                                <div class="product-action">
                                    <a @click.prevent="toCart()" class="cart"><span></span></a>
                                    <a href="#" class="wishlist"><span></span></a>
                                    <a href="#" class="quickview"><span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Item End -->
            </product>
        @endforeach
    </div>
</div>