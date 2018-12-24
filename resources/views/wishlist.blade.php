@extends('layouts.app')
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{{__('front.wishlist')}}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                            <li>{{__('front.wishlist')}}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- Page Banner Section End -->

    <!-- Cart Section Start -->
    <div class="cart-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    @if($successMsg = session("success"))
                        <div class="alert alert-success">{{$successMsg}}</div>
                    @endif

                <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-30">
                        @if($count = count($wishlist))
                            <div class="section-title left section col mb-40 mb-xs-30">
                                <h1> {{ "( {$count} ) " . __('front.items_in_your_wishlist')}}</h1>
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="pro-thumbnail">{{__('front.image')}}</th>
                                    <th class="pro-title">{{__('front.name')}}</th>
                                    <th class="pro-price">{{__('front.price')}}</th>
                                    <th class="pro-subtotal">{{__('front.add_to_cart')}}</th>
                                    <th class="pro-remove">{{__('front.remove')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wishlist as $item)
                                    <tr>
                                        <td class="pro-thumbnail">
                                            <a href="{{route('shop.show', $item->slug)}}">
                                                <img src="{{asset('design')}}/images/product/product-1.jpg" alt="Product">
                                            </a>
                                        </td>
                                        <td class="pro-title"><a href="{{route('shop.show', $item->slug)}}">{{$item->name}}</a></td>
                                        <td class="pro-price"><span>{{presentPrice($item->price)}}</span></td>
                                        <td class="pro-addtocart">
                                            <form method="POST" action="{{route('cart.store')}}">
                                                @csrf
                                                <input type="hidden" name="product" value="{{$item->slug}}">
                                                <!-- Product Action -->
                                                <div class="product-action">
                                                    <button type="submit" class="cart">{{__('front.add_to_cart')}}</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="pro-remove">
                                            <form action="{{route('wishlist.remove')}}" method="POST">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <input type="hidden" name="product" value="{{$item->slug}}">
                                                <button type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="section-title left section col mb-40 mb-xs-30">
                                <h1>{{__('front.your_wishlist_is_empty')}}</h1>
                            </div>
                        @endif
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-12 mb-5">
                            <!-- Calculate Shipping -->
                            <div class="calculate-shipping">
                                <h4>Calculate Shipping</h4>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-25">
                                            <select class="nice-select">
                                                <option>Bangladesh</option>
                                                <option>China</option>
                                                <option>country</option>
                                                <option>India</option>
                                                <option>Japan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 mb-25">
                                            <select class="nice-select">
                                                <option>Dhaka</option>
                                                <option>Barisal</option>
                                                <option>Khulna</option>
                                                <option>Comilla</option>
                                                <option>Chittagong</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="text" placeholder="Postcode / Zip">
                                        </div>
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="submit" value="Estimate">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Discount Coupon -->
                            <div class="discount-coupon">
                                <h4>Discount Coupon Code</h4>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="text" placeholder="Coupon Code">
                                        </div>
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="submit" value="Apply Code">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Cart Summary -->
                        <div class="col-lg-6 col-12 mb-30 d-flex">
                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <p>Sub Total <span>$296.00</span></p>
                                    <p>Shipping Cost <span>$00.00</span></p>
                                    <h2>Grand Total <span>$296.00</span></h2>
                                </div>
                                <div class="cart-summary-button">
                                    <button class="checkout-btn">Checkout</button>
                                    <button class="update-btn">Update Cart</button>
                                    @if($wishlist->count())
                                        <form action="{{route('wishlist.clear')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">{{__('front.empty_your_wishlist')}}</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div><!-- Cart Section End -->
@endsection