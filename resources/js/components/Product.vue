<script>
    export default {
        name: "Product",

        props: [
            'product',
            'to-cart-route',
            'remove-from-cart-route',
            'to-wishlist-route',
            'remove-from-wishlist-route',
            'qnt'
        ],

        data(){
            return {
                productData: this.product,
                inCart: this.product.inCart,
                inWishlist: this.product.inWishlist,
                quantity: this.qnt ? this.qnt : 1
            }
        },

        methods: {
            storeUpdate(type){
                if(type == 'cart'){
                    // update user cart data
                    if(! this.inCart){
                        this.addToCart(this.toCartRoute, {
                            product: this.productData.slug,
                            qnt: this.quantity ? this.quantity: 1
                        })
                    } else{
                        this.removeFromCart(this.removeFromCartRoute, {product: this.productData.slug});
                    }
                    this.inCart = ! this.inCart;
                }else{
                    // update user wishlist
                    if(! this.inWishlist){
                        this.addToWishlist(this.toWishlistRoute, {product: this.productData.slug})
                    } else{
                        this.removeFromWishlist(this.removeFromWishlistRoute, {product: this.productData.slug});
                    }
                    this.inWishlist = ! this.inWishlist;
                }
            },

            addToCart(endpoint, data){
                axios.post(endpoint, data)
                    .then(response => {
                        this.success(response);
                    }).catch(error => {
                        this.error(error.response.data.msg);
                });
            },

            removeFromCart(endpoint, data){
                axios.delete(endpoint, { data: data})
                    .then(response => {
                        this.success(response, 'warning');
                    }).catch(error => {
                        this.error('Something went wrong');
                });
            },

            addToWishlist(endpoint, data){
                axios.post(endpoint, data)
                    .then(response => {
                        this.success(response);
                    }).catch(error => {
                    this.error('Something went wrong');
                });
            },

            removeFromWishlist(endpoint, data){
                axios.delete(endpoint, { data: data})
                    .then(response => {
                        this.success(response, 'warning');
                    }).catch(error => {
                    this.error('Something went wrong');
                });
            },

            updateQnt(e){
                if(! this.inCart) return;
                axios.patch('/cart/update', {
                    product: this.productData.slug,
                    qnt: this.quantity ? this.quantity: 1
                }).then(response => {
                    this.$toaster.success(response.data.msg);
                }).catch(error => {
                    this.$toaster.error(response.data.msg);
                });
            },

            success(response, type = 'success'){
                if(type == 'success'){
                    this.$toaster.success(response.data.msg);
                }else{
                    this.$toaster.warning(response.data.msg);
                }
            },

            error(msg){
                this.$toaster.error(msg);
            }
        }
    }
</script>

<style scoped>
    [v-cloak]{
        display: none;
    }
</style>