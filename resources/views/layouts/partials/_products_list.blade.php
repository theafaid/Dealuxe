@foreach($products as $product)
    <!-- Product Item Start -->
    <div class="col-xl-4 col-sm-6 col-12 mb-30">
        <div class="product-item">
            <!-- Image -->
            <div class="product-image">
                <!-- Image -->
                <a href="product-details-variable.html" class="image"><img src="{{asset('design')}}/images/product/product-1.jpg" alt=""></a>
                <!-- Product Action -->
                <div class="product-action">
                    <a href="#" class="cart"><span></span></a>
                    <a href="#" class="wishlist"><span></span></a>
                    <a href="#" class="quickview"><span></span></a>
                </div>
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
                        <span class="price">{{$product->presentPrice()}} <span class="old">$65</span></span>
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
                        <a href="#" class="cart"><span></span></a>
                        <a href="#" class="wishlist"><span></span></a>
                        <a href="#" class="quickview"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Item End -->
@endforeach