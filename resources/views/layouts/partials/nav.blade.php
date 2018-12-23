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
                    <a href="wishlist.html" class="header-wishlist"><span class="icon">wishlist</span></a>

                    <!-- Cart Wrap Start-->
                    <div class="header-cart-wrap">
                        <!-- Cart Toggle -->
                        <button class="header-cart-toggle">
                            <span class="icon">cart</span>
                            <span class="number">{{auth()->user()->cartItems()->count()}}</span>
                            <span class="price">{{auth()->user()->totalCartItems()}}</span>
                        </button>

                        <!-- Header Mini Cart Start -->
                        <div class="header-mini-cart">
                            <!-- Mini Cart Head -->
                            <div class="mini-cart-head">
                                <h3>{{__('front.your_cart')}}</h3>
                            </div>
                            <!-- Mini Cart Body -->
                            <div class="mini-cart-body">
                                <div class="mini-cart-body-inner custom-scroll">
                                    <ul>
                                       @forelse(auth()->user()->cartItems() as $item)
                                              <!-- Mini Cart Product -->
                                               <li class="mini-cart-product">
                                                   <div class="image">
                                                       <a href="{{route('cart.index')}}">
                                                           <img src="{{asset('design')}}/images/product/product-4.jpg" alt="">
                                                       </a>
                                                       <form action="{{route('cart.remove')}}" method="POST">
                                                           @csrf
                                                           {{method_field('DELETE')}}
                                                           <input type="hidden" name="product" value="{{$item['attributes']['product']['slug']}}">
                                                           <button class="remove" type="submit"><i class="fa fa-trash-o"></i></button>
                                                       </form>
                                                   </div>

                                                   <div class="content">
                                                       <a href="{{route('shop.show', $item['attributes']['product']['slug'])}}" class="title">{{$item->name}}</a>
                                                       <span>{{$item->quantity}} x | ${{$item->price}}</span>
                                                   </div>
                                               </li>
                                       @empty
                                               <div class="alert alert-danger">
                                                   {{__('front.you_cart_is_empty')}}
                                               </div>
                                       @endforelse
                                    </ul>
                                </div>
                            </div>
                            <!-- Mini Cart Footer -->
                            <div class="mini-cart-footer">
                                <h4>{{__('front.total')}}: {{auth()->user()->totalCartItems()}}</h4>
                                <div class="buttons">
                                    <a href="{{route('cart.index')}}">{{__('front.view_cart')}}</a>
                                    <a href="checkout.html">Checkout</a>
                                </div>
                            </div>
                        </div><!-- Header Mini Cart End -->

                    </div><!-- Cart Wrap End-->

                </div>
            </div>

            <div class="col-12 d-block d-lg-none">
                <div class="mobile-menu"></div>
            </div>

        </div>
    </div>
</div>
<!-- Header Section End -->