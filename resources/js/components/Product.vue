<script>
    export default {
        name: "Product",

        props: ['to-cart-route', 'remove-from-cart-route', 'product'],

        data(){
            return {
                productData: this.product,
                inCart: this.product.inCart
            }
        },

        methods: {
            toCart(){
                if(! this.inCart){
                    this.addToCart(this.toCartRoute, {product: this.productData.slug})
                } else{
                    this.removeFromCart(this.removeFromCartRoute, {product: this.productData.slug});
                }
                this.inCart = ! this.inCart;
            },

            addToCart(endpoint, data){
                axios.post(endpoint, data)
                    .then(response => {
                        this.success(response);
                    }).catch(error => {
                        this.error('Something went wrong');
                });
            },

            removeFromCart(endpoint, data){
                axios.delete(endpoint, { data: data})
                    .then(response => {
                        this.success();
                    }).catch(error => {
                        this.error('Something went wrong');
                });
            },

            success(response){
                this.$toaster.success(response.data.msg);
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