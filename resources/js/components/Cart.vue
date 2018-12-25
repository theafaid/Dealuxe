<template>
    <div class="header-cart-wrap">
        <!-- Cart Toggle -->
        <button class="header-cart-toggle">
            <span class="icon">cart</span>
            <span class="number" v-text="items.length"></span>
            <span class="price" v-text="total"></span>
        </button>

        <!-- Header Mini Cart Start -->
         <div class="header-mini-cart">
            <!-- Mini Cart Head -->
            <div class="mini-cart-head">
                <h3 v-text="trans_your_cart"></h3>
            </div>
            <!-- Mini Cart Body -->
            <div class="mini-cart-body">
                <div class="mini-cart-body-inner custom-scroll">
                    <ul v-if="items.length">
                        <!-- Mini Cart Product -->
                        <div>
                            <li class="mini-cart-product" v-for="(item, index) in items">
                                <div class="image">
                                    <a :href="cartRoute">
                                        <img src="/design/images/product/product-4.jpg" alt="">
                                    </a>
                                    <!--<form action="{{route('cart.remove')}}" method="POST">-->
                                        <!--@csrf-->
                                        <!--{{method_field('DELETE')}}-->
                                        <!--<input type="hidden" name="product" :value="item">-->
                                        <!--<button class="remove" type="submit"><i class="fa fa-trash-o"></i></button>-->
                                    <!--</form>-->
                                </div>

                                <!--<div class="content">-->
                                    <!--<a href="{{route('shop.show', "test")}}" class="title" v-text="item.name"></a>-->
                                    <!--{{&#45;&#45;<span>{{item.quantity}} x | &lt;!&ndash; {{presentPrice($item->price)}} &ndash;&gt;</span>&#45;&#45;}}-->
                                <!--</div>-->
                            </li>
                        </div>
                    </ul>
                    <div v-else class="alert alert-danger">
                        {{trans_your_cart_is_empty}}
                    </div>
                </div>
            </div>
            <!-- Mini Cart Footer -->
            <div class="mini-cart-footer">
                <h4>{{trans_total}}: {{total}}</h4>
                <!--<div class="buttons">-->
                    <!--<a href="{{route('cart.index')}}">{{__('front.view_cart')}}</a>-->
                    <!--<a href="checkout.html">Checkout</a>-->
                <!--</div>-->
            </div>
        </div>
        <!-- Header Mini Cart End -->
    </div>
</template>


<script>
    export default {
        name: "Cart",

        props: [
            'trans_your_cart',
            'trans_your_cart_is_empty',
            'trans_total',
            'cart-items',
            'total-price',
            'cart-route',
        ],

        mounted(){

        },

        data(){
            return {
                items: this.cartItems,
                total: this.totalPrice
            }
        }
    }
</script>

<style scoped>
    [v-cloak]{
        display: none;
    }
</style>