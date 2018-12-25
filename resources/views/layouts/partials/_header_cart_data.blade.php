{{--<cart--}}
        {{--:cart-items="{{auth()->user()->cartItems()}}"--}}
        {{--total-price="{{auth()->user()->cartTotal()}}"--}}
        {{--trans_your_cart="{{trans('front.your_cart')}}"--}}
        {{--trans_your_cart_is_empty="{{trans('front.your_cart_is_empty')}}"--}}
        {{--trans_total="{{trans('front.total')}}"--}}
        {{--cart-route="{{route('cart.index')}}"--}}
    {{-->--}}
{{--</cart>--}}

<!-- Cart Wrap Start-->
<div class="header-cart-wrap">
    <!-- Cart Toggle -->
    <button class="header-cart-toggle">
        <span class="icon">cart</span>
        <span class="number">{{auth()->user()->cartItems()->count()}}</span>
        <span class="price">{{auth()->user()->cartTotal()}}</span>
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
                                    <input type="hidden" name="product" value="{{slugFromItem($item)}}">
                                    <button class="remove" type="submit"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </div>

                            <div class="content">
                                <a href="{{route('shop.show', slugFromItem($item))}}" class="title">{{$item->name}}</a>
                                <span>{{$item->quantity}} x | {{presentPrice($item->price)}}</span>
                            </div>
                        </li>
                    @empty
                        <div class="alert alert-danger">
                            {{__('front.your_cart_is_empty')}}
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>
        <!-- Mini Cart Footer -->
        <div class="mini-cart-footer">
            <h4>{{__('front.total')}}: {{auth()->user()->cartTotal()}}</h4>
            <div class="buttons">
                <a href="{{route('cart.index')}}">{{__('front.view_cart')}}</a>
                <a href="checkout.html">Checkout</a>
            </div>
        </div>
    </div>
    <!-- Header Mini Cart End -->
</div>
<!-- Cart Wrap End-->