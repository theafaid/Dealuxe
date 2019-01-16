@extends('layouts.app')
@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h1>{{__('front.shop')}}</h1>
                        <ul class="page-breadcrumb">
                            <li><a href="{{route('welcome')}}">{{__('front.home')}}</a></li>
                            <li>{{__('front.shop')}}}</li>
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

                    <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2">
                        <h1>
                            @if(request('sortBy') == 'featured')
                                {{__('front.featured_products')}}
                            @else
                                {{$categoryName}}
                            @endif
                        </h1>
                        <hr>
                        <!-- Shop Toolbar Start -->
                        <div class="row">
                            <div class="col">
                                <div class="shop-toolbar">
                                    <div class="product-view-mode">
                                        <button class="grid active" data-mode="grid"><span>grid</span></button>
                                        <button class="list" data-mode="list"><span>list</span></button>
                                    </div>
                                    <div class="product-showing mr-auto">
                                        <p>
                                            <a href="{{route('shop.index', ['category' => request('category'), 'sortBy' => 'price_high_low'])}}">
                                                {{__('front.price_high_low')}}
                                            </a>
                                            |
                                            <a href="{{route('shop.index', ['category' => request('category'), 'sortBy' => 'price_low_high'])}}">
                                                {{__('front.price_low_high')}}
                                            </a>
                                        </p>
                                    </div>
                                    <div class="product-short">
                                        <p>Sort by</p>
                                        <select class="nice-select">
                                            <option value="trending">Trending items</option>
                                            <option value="sales">Best sellers</option>
                                            <option value="rating">Best rated</option>
                                            <option value="date">Newest items</option>
                                            <option value="price-asc">
                                                <a href="{{route('shop.index', ['sortBy' => 'price_low_high'])}}">
                                                    {{__('front.price_low_high')}}
                                                </a>
                                            </option>
                                            <option value="price-desc">
                                                <a href="{{route('shop.index', ['sortBy' => 'price_high_low'])}}">
                                                    {{__('front.price_high_low')}}
                                                </a>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Shop Toolbar End -->

                        @if(count($products))
                            <div class="shop-product-wrap grid row">
                                @include('layouts.partials._products_list')
                            </div>
                        @else
                            <div class="alert alert-danger">
                                {{__('front.no_products_founded')}}
                            </div>
                        @endif

                        <div class="row mt-20">

                            <div class="col">
                                {{$products->appends(request()->query())->links()}}
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">


                        <div class="sidebar">
                            <h4 class="sidebar-title">Search</h4>
                            <div class="sidebar-search">
                                <form action="#">
                                    <input type="text" placeholder="Enter key words">
                                    <input type="submit" value="search">
                                </form>
                            </div>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">{{__('front.categories')}}</h4>
                            <ul class="sidebar-list">
                                <li><a class="{{setActiveCategory('all_categories')}}" href="{{route('shop.index')}}">{{ __('front.all_categories')}}</a></li>
                                <li><a class="{{setActiveCategory('featured')}}" href="{{route('shop.index', ['sortBy' => 'featured'])}}">{{ __('front.featured')}}</a></li>
                                @foreach($categories as $category)
                                    <li><a class="{{setActiveCategory($category->slug)}}" href="{{route('shop.index', ['category' => $category->slug])}}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">Price</h4>
                            <div id="price-range"></div>
                        </div>

                        <div class="sidebar">
                            <div class="banner"><a href="#"><img src="{{asset('design')}}/images/banner/banner-3.jpg" alt=""></a></div>
                        </div>

                        <div class="sidebar">
                            <h4 class="sidebar-title">Tags</h4>
                            <div class="tag-cloud">
                                <a href="#">Oil</a>
                                <a href="#">Beard oil</a>
                                <a href="#">Beard</a>
                                <a href="#">Stylish</a>
                                <a href="#">Ecommerce</a>
                                <a href="#">Shop</a>
                                <a href="#">Shopping</a>
                                <a href="#">Store</a>
                                <a href="#">Online Store</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Product Section End -->
    </shop-page>
@endsection