<template>
    <div>
        <h4 class="checkout-title">Payment Method</h4>
        <div v-show="error" class="alert alert-danger payment-err-msg">
            {{ errorMsg }}
            <br>
        </div>

        <card class='stripe-card form-control'
              :class='{ complete }'
              :stripe=stripeKey
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
        props: ['checkout-route', 'stripe-key', 'thankyou-route'],
        
        data () {
            return {
                complete: false,
                stripeOptions: {
                },
                error: false,
                errorMsg: false
            }
        },

        components: { Card },

        methods: {
            pay () {
                createToken().then(data => {
                    axios.post(this.checkoutRoute, {stripeToken: data.token.id})
                        .then(response => window.location = this.thankyouRoute)
                        .catch(error => {
                            this.error = true;
                            this.errorMsg = error.response.data.msg;
                        });
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

    .payment-err-msg{
        width: 100%
    }
</style>