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
                        <li><a href="index.html">HOME</a>
                            <ul class="sub-menu">
                                <li><a href="index.html">Home One</a></li>
                                <li><a href="index-2.html">Home Two</a></li>
                            </ul>
                        </li>
                        <li><a href="about.html">ABOUT</a></li>
                        <li><a href="shop-4-column.html">SHOP</a>
                            <ul class="mega-menu">
                                <li class="col"><a href="#">Shop Grid Pages</a>
                                    <ul>
                                        <li><a href="shop-4-column.html">Shop Four Column</a></li>
                                        <li><a href="shop-3-column.html">Shop Three Column</a></li>
                                        <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                        <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                    </ul>
                                </li>

                                <li class="col"><a href="#">Shop List Pages</a>
                                    <ul>
                                        <li><a href="shop-list.html">Shop List</a></li>
                                        <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                        <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                    </ul>
                                </li>

                                <li class="col"><a href="#">Product Details Pages</a>
                                    <ul>
                                        <li><a href="product-details.html">Product Details Standard</a></li>
                                        <li><a href="product-details-variable.html">Product Details Variable</a></li>
                                        <li><a href="product-details-affiliate.html">Product Details Affiliate</a></li>
                                        <li><a href="product-details-group.html">Product Details Group</a></li>
                                    </ul>
                                </li>

                                <li class="col"><a href="#">Product Details Layout 1</a>
                                    <ul>
                                        <li><a href="product-details-bottom-thumbnail.html">Bottom Thumbnail</a></li>
                                        <li><a href="product-details-left-thumbnail.html">Left Thumbnail</a></li>
                                        <li><a href="product-details-right-thumbnail.html">Right Thumbnail</a></li>
                                    </ul>
                                </li>

                                <li class="col"><a href="#">Product Details Layout 2</a>
                                    <ul>
                                        <li><a href="product-details-left-gallery.html">Left Gallery</a></li>
                                        <li><a href="product-details-right-gallery.html">Right Gallery</a></li>
                                        <li><a href="product-details-left-sticky.html">Left Sticky</a></li>
                                        <li><a href="product-details-right-sticky.html">Right Sticky</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
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
                        <button class="header-cart-toggle"><span class="icon">cart</span><span class="number">2</span><span class="price">$289</span></button>

                        <!-- Header Mini Cart Start -->
                        <div class="header-mini-cart">
                            <!-- Mini Cart Head -->
                            <div class="mini-cart-head">
                                <h3>Your cart</h3>
                            </div>
                            <!-- Mini Cart Body -->
                            <div class="mini-cart-body">
                                <div class="mini-cart-body-inner custom-scroll">
                                    <ul>
                                        <!-- Mini Cart Product -->
                                        <li class="mini-cart-product">
                                            <div class="image">
                                                <a href="#"><img src="{{asset('design')}}/images/product/product-1.jpg" alt=""></a>
                                                <button class="remove"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            <div class="content">
                                                <a href="product-details-variable.html" class="title">Teritory Quentily</a>
                                                <span>2 x $35.00</span>
                                            </div>
                                        </li>
                                        <!-- Mini Cart Product -->
                                        <li class="mini-cart-product">
                                            <div class="image">
                                                <a href="#"><img src="{{asset('design')}}/images/product/product-2.jpg" alt=""></a>
                                                <button class="remove"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            <div class="content">
                                                <a href="product-details-variable.html" class="title">Adurite Silocone</a>
                                                <span>1 x $59.00</span>
                                            </div>
                                        </li>
                                        <!-- Mini Cart Product -->
                                        <li class="mini-cart-product">
                                            <div class="image">
                                                <a href="#"><img src="{{asset('design')}}/images/product/product-3.jpg" alt=""></a>
                                                <button class="remove"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            <div class="content">
                                                <a href="product-details-variable.html" class="title">Baizidale Momone</a>
                                                <span>1 x $78.00</span>
                                            </div>
                                        </li>
                                        <!-- Mini Cart Product -->
                                        <li class="mini-cart-product">
                                            <div class="image">
                                                <a href="#"><img src="{{asset('design')}}/images/product/product-4.jpg" alt=""></a>
                                                <button class="remove"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            <div class="content">
                                                <a href="product-details-variable.html" class="title">Makorone Cicile</a>
                                                <span>2 x $65.00</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Mini Cart Footer -->
                            <div class="mini-cart-footer">
                                <h4>Subtotal: $272.00</h4>
                                <div class="buttons">
                                    <a href="cart.html">View cart</a>
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