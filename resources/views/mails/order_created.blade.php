@component('mail::message')
# {{__('front.order_created_mail_header')}}<br>
{{__('front.hey')}} {{$order->user->name}}<br>
<div>{{__('front.we_inform_that_order_was_sent')}}:</div><br>

<hr><br>
@foreach($order->products as $product)
    <div>
    {{__('front.product_name')}}: {{$product->name}}<br>
    {{__('front.product_price')}}: {{$product->price}}<br>
    {{__('front.quantity')}}: {{$product->pivot->quantity}}
    </div><br>
@endforeach
<hr>
{{__('front.total')}}: {{presentPrice($grandTotal)}}
<hr>

<div>
    {{__('front.remember_that_your_information_is')}}:<br>
    {{__('front.phone')}}: {{$order->user->profile->phone}}<br>
    {{__('front.province')}}: {{$order->user->profile->province}}<br>
    {{__('front.city')}}: {{$order->user->profile->city}}<br>
    {{__('front.address')}}: {{$order->user->profile->address}}<br>
    {{__('front.postal_code')}}: {{$order->user->profile->postal_code}}<br>
</div>

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

{{__('front.thanks_for_using_')}} {{env('APP_NAME')}}<br>

{{ config('app.name') }}
@endcomponent
