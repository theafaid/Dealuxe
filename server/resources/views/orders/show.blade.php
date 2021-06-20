@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{$order->code}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <p class="title">{{__('admin.products_info')}}</p>
                            </div>
                            <div class="card-body ">
                                <div class="table-full-width table-responsive ps ps--active-y ps--scrolling-y">
                                    <table class="table">
                                        <tbody>
                                        @foreach($order->products as $variation)
                                            <tr>
                                                <td>
                                                    <p>
                                                        <a class="title" target="_blank" href="{{config('site.front_app_url') }}">
                                                            {{$variation->product->name}}
                                                        </a>
                                                    </p>
                                                    <p class="text-muted">{{$variation->type. ' : ' .$variation->name}}</p>
                                                </td>
                                                <td>
                                                    <p class="title">{{$variation->total}}</p>
                                                    <p class="text-muted">x{{$variation->quantity}}</p>
                                                </td>
                                                <td>
                                                    <p class="title">{{__('admin.stock_count')}}: {{$variation->stock_count}}</p>
                                                    <p class="text-muted">
                                                        <span class="{{availabilityClass($variation->in_stock)}}">{{__('admin.available')}}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="ps__rail-x" style="left: 0px; bottom: -20px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 20px; height: 410px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 20px; height: 390px;"></div></div></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <p class="title">{{__('admin.address_info')}}</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>{{__('admin.address_name')}}</th>
                                                <td>{{$order->address->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('admin.address_1')}}</th>
                                                <td>{{$order->address->address_1}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('admin.postal_code')}}</th>
                                                <td>{{$order->address->postal_code}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('admin.city')}}</th>
                                                <td>{{$order->address->city->name}} - {{$order->address->city->district}} -
                                                    <span class="{{availabilityClass($order->address->city->supported)}}">{{__('admin.available')}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{__('admin.country')}}</th>
                                                <td>{{$order->address->city->country->code}} - {{$order->address->city->country->name}}
                                                    <span class="{{availabilityClass($order->address->city->country->supported)}}">{{__('admin.available')}}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="ps__rail-x" style="left: 0px; bottom: -20px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 20px; height: 410px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 20px; height: 390px;"></div></div></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <p class="title">{{__('admin.shipping_methods_info')}}</p>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>{{__('admin.shipping_method_name')}}</th>
                                        <td>{{$order->shippingMethod->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('admin.price')}}</th>
                                        <td>{{$order->shippingMethod->price}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <p class="title">{{__('admin.main_order_info')}}</p>
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$order->status}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.created_at')}}</th>
                                <td>{{$order->created_at}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.subtotal')}}</th>
                                <td>{{$order->subtotal}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.total')}}</th>
                                <td>{{$order->total}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
