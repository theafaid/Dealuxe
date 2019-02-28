@extends('layouts.app')
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                        <h1>{{__('front.my_account')}}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                            <li>{{__('front.my_account')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- My Account Section Start -->
    <div class="my-account-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="row">

                        <!-- My Account Tab Menu Start -->
                        <div class="col-lg-3 col-12 mb-30">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>

                                <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

                                <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> Download</a>

                                <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                    Method</a>

                                <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>

                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

                                <a href="login-register.html"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-12 mb-30">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    @include('layouts.partials._message')
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>

                                        <div class="welcome">
                                            <p>Hello, <strong>Alex Tuntuni</strong> (If Not <strong>Tuntuni !</strong><a href="login-register.html" class="logout"> Logout</a>)</p>
                                        </div>

                                        <p class="mb-0">From your account dashboard. you can easily check &amp; view your
                                            recent orders, manage your shipping and billing addresses and edit your
                                            password and account details.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>

                                        @foreach($user->orders as $order)
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>{{$order->created_at->format('Y-m-d H:i')}} | ({{$order->products()->count()}}) {{__('front.products')}}</h3>
                                                    <h4>{{__('front.total')}} {{presentPrice($order->total)}}</h4>
                                                    <h4>{{__('front.discount')}} {{presentPrice($order->discount)}}</h4>
                                                    <h4>
                                                        @if($order->shipped)
                                                            <span class="badge badge-success">{{__('front.shipped')}}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{__('front.not_shipped')}}</span>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{__('front.name')}}</th>
                                                                <th>{{__('front.product_details')}}</th>
                                                                <th>{{__('front.product_price')}}</th>
                                                                <th>{{__('front.quantity')}}</th>
                                                                <th>{{__('front.action')}}</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            @foreach($order->products as $key => $product)
                                                                <tr>
                                                                    <td>{{$key + 1}}</td>
                                                                    <td>
                                                                        {{$product->name}}<br>
                                                                        <img class="img-thumbnail img-rounded" src="{{$product->image}}" width="100" height="50">
                                                                    </td>
                                                                    <td>{{$product->details}}</td>
                                                                    <td>{{presentPrice($product->price)}}</td>
                                                                    <td>{{$product->pivot->quantity}}</td>
                                                                    <td><a href="{{route('shop.show', $product->slug)}}" class="btn btn-round">View</a></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><hr>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="download" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Downloads</h3>

                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Expire</th>
                                                    <th>Download</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr>
                                                    <td>Moisturizing Oil</td>
                                                    <td>Aug 22, 2018</td>
                                                    <td>Yes</td>
                                                    <td><a href="#" class="btn btn-round">Download File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Katopeno Altuni</td>
                                                    <td>Sep 12, 2018</td>
                                                    <td>Never</td>
                                                    <td><a href="#" class="btn btn-round">Download File</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>

                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>{{__('front.address_details')}}</h3>

                                        <address>
                                            <div class="account-details-form">
                                                <form action="{{route('profile.updateAddress')}}" method="POST">
                                                    @csrf
                                                    {{method_field('PATCH')}}
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12 mb-30">
                                                            <input placeholder="{{__('front.province')}}" name="province" type="text" value="{{old('province') ?: $user->profile->province}}">
                                                        </div>

                                                        <div class="col-lg-6 col-12 mb-30">
                                                            <input placeholder="{{__('front.city')}}" name="city" type="text" value="{{old('city') ?: $user->profile->city}}">
                                                        </div>

                                                        <div class="col-12 mb-30">
                                                            <input placeholder="{{__('front.address')}}" name="address" type="text" value="{{old('address') ?: $user->profile->address}}">
                                                        </div>

                                                        <div class="col-12 mb-30">
                                                            <input placeholder="{{__('front.postal_code')}}" name="postal_code" type="text" value="{{old('postal_code') ?: $user->profile->postal_code}}">
                                                        </div>

                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-round btn-lg">{{__('front.update_address_details')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </address>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>

                                        <div class="account-details-form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input id="first-name" placeholder="First Name" type="text">
                                                    </div>

                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input id="last-name" placeholder="Last Name" type="text">
                                                    </div>

                                                    <div class="col-12 mb-30">
                                                        <input id="display-name" placeholder="Display Name" type="text">
                                                    </div>

                                                    <div class="col-12 mb-30">
                                                        <input id="email" placeholder="Email Address" type="email">
                                                    </div>

                                                    <div class="col-12 mb-30"><h4>Password change</h4></div>

                                                    <div class="col-12 mb-30">
                                                        <input id="current-pwd" placeholder="Current Password" type="password">
                                                    </div>

                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input id="new-pwd" placeholder="New Password" type="password">
                                                    </div>

                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input id="confirm-pwd" placeholder="Confirm Password" type="password">
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="btn btn-round btn-lg">Save Changes</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                            </div>
                        </div>
                        <!-- My Account Tab Content End -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- My Account Section End -->

    <!-- Brand Section Start -->
    <div class="brand-section section pb-90 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">

                <div class="brand-slider section">
                    <div class="brand-item col"><img src="assets/images/brands/brand-1.png" alt=""></div>
                    <div class="brand-item col"><img src="assets/images/brands/brand-2.png" alt=""></div>
                    <div class="brand-item col"><img src="assets/images/brands/brand-3.png" alt=""></div>
                    <div class="brand-item col"><img src="assets/images/brands/brand-4.png" alt=""></div>
                    <div class="brand-item col"><img src="assets/images/brands/brand-5.png" alt=""></div>
                </div>

            </div>
        </div>
    </div>
    <!-- Brand Section End -->
@endsection