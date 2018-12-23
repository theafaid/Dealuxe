<!-- Header Section Start -->
<div class="header-section section bg-white">
    <div class="container">
        <div class="row">

            <!-- Header Logo -->
            <div class="col">
                <div class="header-logo">
                    <a href="index.html">
                        <img src="{{asset('design')}}/images/logo.png" alt="">
                    </a>
                </div>
            </div>

            <!-- Main Menu -->
            <div class="col d-none d-lg-block">
                <nav class="main-menu">
                    <ul>
                        <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                        <li><a href="{{route('shop.index')}}">{{__('front.shop')}}</a></li>

                        <li><a href="blog-grid.html">BLOG</a>
                            <ul class="sub-menu">
                                <li><a href="blog-grid.html">Blog Grid</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-grid-2-column.html">Grid 2 Column</a></li>
                                        <li><a href="blog-grid.html">Grid 3 Column</a></li>
                                        <li><a href="blog-grid-left-sidebar.html">Grid Left Sidebar</a></li>
                                        <li><a href="blog-grid-right-sidebar.html">Grid Right Sidebar</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog List</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog.html">BLog List</a></li>
                                        <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a></li>
                                        <li><a href="blog-list-right-sidebar.html">List Right Sidebar</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog-details.html">Blog Details</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>
                                        <li><a href="blog-details.html">Right Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">PAGES</a>
                            <ul class="sub-menu">
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="compare.html">Compare</a></li>
                                <li><a href="login-register.html">Login & Register</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">CONTACT</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Header Action -->
            <div class="col">
                <div class="header-action">

                    <!-- Wishlist -->
                    <a href="{{route('wishlist.index')}}" class="header-wishlist"><span class="icon">wishlist</span></a>
                    @auth
                        @include('layouts.partials._header_cart_data')
                    @endauth
                </div>
            </div>

            <div class="col-12 d-block d-lg-none">
                <div class="mobile-menu"></div>
            </div>

        </div>
    </div>
</div>
<!-- Header Section End -->