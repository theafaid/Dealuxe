<template>
    <div>
        <h4 class="checkout-title">Payment Method</h4>
        <card class='stripe-card form-control'
              :class='{ complete }'
              stripe='pk_test_LXrT8vaoQOXTHBVC2vvLP0KR'
              :options='stripeOptions'
              @change='complete = $event.complete'
        />
        <button
                class='pay-with-stripe place-order btn btn-lg'
                @click='pay'
                :disabled='!complete'>Pay with credit card
        </button>
    </div>
</template>

<script>
    import { Card, createToken } from 'vue-stripe-elements-plus'

    export default {
        data () {
            return {
                complete: false,
                stripeOptions: {
                }
            }
        },

        components: { Card },

        methods: {
            pay () {
                createToken().then(data => {
                    axios.post("/checkout", {stripeToken: data.token.id})
                        .then(response => {console.log(response.data)})
                        .catch(error => console.log(error.response.data));
                })
            }
        }
    }
</script>

<style>
    .stripe-card {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .stripe-card:focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .stripe-card.complete {
        border-color: green;
    }
</style>