@extends('layouts.app')

@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{{__('front.checkout')}}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                            <li>{{__('front.checkout')}}</li>
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

                    {{--<!-- Checkout Form s-->--}}
                    {{--<form action="#" class="checkout-form">--}}
                    <div class="row row-40">

                        <div class="col-lg-7">

                            <!-- Billing Address -->
                            <div id="billing-form" class="mb-10">
                                <h4 class="checkout-title">Billing Address</h4>

                                <div class="row">

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>First Name*</label>
                                        <input type="text" placeholder="First Name">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Last Name*</label>
                                        <input type="text" placeholder="Last Name">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Email Address*</label>
                                        <input type="email" placeholder="Email Address">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Phone no*</label>
                                        <input type="text" placeholder="Phone number">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label>Company Name</label>
                                        <input type="text" placeholder="Company Name">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label>Address*</label>
                                        <input type="text" placeholder="Address line 1">
                                        <input type="text" placeholder="Address line 2">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Country*</label>
                                        <select class="nice-select">
                                            <option>Bangladesh</option>
                                            <option>China</option>
                                            <option>country</option>
                                            <option>India</option>
                                            <option>Japan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Town/City*</label>
                                        <input type="text" placeholder="Town/City">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>State*</label>
                                        <input type="text" placeholder="State">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Zip Code*</label>
                                        <input type="text" placeholder="Zip Code">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <div class="check-box">
                                            <input type="checkbox" id="create_account">
                                            <label for="create_account">Create an Acount?</label>
                                        </div>
                                        <div class="check-box">
                                            <input type="checkbox" id="shiping_address" data-shipping>
                                            <label for="shiping_address">Ship to Different Address</label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- Shipping Address -->
                            <div id="shipping-form">
                                <h4 class="checkout-title">Shipping Address</h4>

                                <div class="row">

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>First Name*</label>
                                        <input type="text" placeholder="First Name">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Last Name*</label>
                                        <input type="text" placeholder="Last Name">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Email Address*</label>
                                        <input type="email" placeholder="Email Address">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Phone no*</label>
                                        <input type="text" placeholder="Phone number">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label>Company Name</label>
                                        <input type="text" placeholder="Company Name">
                                    </div>

                                    <div class="col-12 mb-20">
                                        <label>Address*</label>
                                        <input type="text" placeholder="Address line 1">
                                        <input type="text" placeholder="Address line 2">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Country*</label>
                                        <select class="nice-select">
                                            <option>Bangladesh</option>
                                            <option>China</option>
                                            <option>country</option>
                                            <option>India</option>
                                            <option>Japan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Town/City*</label>
                                        <input type="text" placeholder="Town/City">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>State*</label>
                                        <input type="text" placeholder="State">
                                    </div>

                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Zip Code*</label>
                                        <input type="text" placeholder="Zip Code">
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-5">
                            <div class="row">

                                <!-- Cart Total -->
                                <div class="col-12 mb-60">

                                    <h4 class="checkout-title">{{__('front.cart_total')}}</h4>

                                    <div class="checkout-cart-total">

                                        <h4>{{__('front.product')}} <span>{{__('front.total')}}</span></h4>

                                        <ul>
                                            @foreach($cartItems as $item)
                                                <li>{{$item->name}} X {{$item->quantity}} <span>{{presentPrice($item->price)}}</span></li>
                                            @endforeach
                                        </ul><br>


                                        @if($coupon != null)
                                            <div>
                                                <form style="display: inline" action="{{route('coupon.remove')}}" method="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button>
                                                </form>
                                                <h4 style="display: inline">{{__('front.coupon')}} [{{$coupon['code']}}]<span>{{$discount}}</span></h4>
                                            </div>
                                        @endif
                                        <h4>{{__('front.grand_total')}} <span>{{$grandTotal}}</span></h4>


                                    </div>

                                </div>

                                @if(count($cartItems))
                                    <!-- Store a coupon -->
                                    <div class="col-12 mb-30">
                                        <h4 class="checkout-title">{{__('front.having_a_coupon')}}</h4>
                                        @if($successMsg = session('success'))
                                            <div class="alert alert-success">
                                                {{$successMsg}}
                                            </div>
                                        @endif
                                        @if(count($errors))
                                            <div class="alert alert-danger">
                                                {{$errors->first('coupon')}}
                                            </div>
                                        @endif

                                        <form method="post" action="{{route('coupon.store')}}">
                                            @csrf
                                            <input type="text" name="coupon" class="form-control" placeholder="{{__('front.coupon_code')}}" required>
                                            <input class="place-order btn btn-sm" type="submit" value="add coupon">
                                        </form>
                                    </div>
                                @endif

                                <!-- Payment Method -->
                                <div class="col-12 mb-30">
                                    <checkout-form 
                                    checkout-route={{ route('checkout.store') }}
                                    stripe-key={{ config('services.stripe.key') }}
                                    thankyou-route={{ route('thankyou') }}>
                                    </checkout-form>
                                </div>

                            </div>
                        </div>

                    </div>
                    {{--</form>--}}

                </div>
            </div>
        </div>

    </div><!-- Cart Section End -->
@endsection
