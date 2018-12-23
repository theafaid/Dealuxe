@extends('layouts.app')
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{{__('front.cart')}}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                            <li>{{__('front.cart')}}</li>
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
                    
                    <form action="" method="POST">
                        @csrf
                        <!-- Cart Table -->
                        <div class="cart-table table-responsive mb-30">
                            @if($cartItems->count())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#"><img src="{{asset('design')}}/images/product/product-1.jpg" alt="Product"></a></td>
                                            <td class="pro-title"><a href="#">{{$item->name}}</a></td>
                                            <td class="pro-price"><span>$35.00</span></td>
                                            <td class="pro-quantity"><div class="pro-qty"><input type="text" value="1"></div></td>
                                            <td class="pro-subtotal"><span>$35.00</span></td>
                                            <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <p class="alert alert-danger">{{__('front.you_cart_is_empty')}}</p>
                            @endif
                        </div>
                    </form>

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
                                    @if($cartItems->count())
                                        <form action="{{route('cart.clear')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">{{__('front.empty_cart')}}</button>
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

    <!-- Brand Section Start -->
    <div class="brand-section section pb-90 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts.partials._might_like')
                </div>
            </div>
        </div>
    </div><!-- Brand Section End -->

@endsection