@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.products')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter table-hover" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('admin.product_name')}}
                                    </th>
                                    <th>
                                        {{__('admin.main_image')}}
                                    </th>
                                    <th>
                                        {{__('admin.price')}}
                                    </th>
                                    <th>
                                        {{__('admin.stock_count')}}
                                    </th>
                                    <th>
                                        {{__('admin.in_stock')}}
                                    </th>
                                    <th>
                                        {{__('admin.settings')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode(json_encode((object) $products), false) as $product)
                                    <tr>
                                        <td>
                                            {{$product->name}}
                                        </td>
                                        <td>
                                            {{$product->image}}
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                        <td>
                                            {{$product->stock_count}}
                                        </td>
                                        <td class="{{availabilityClass($product->in_stock)}}">
                                            {{$product->in_stock ? __('admin.available') : __('admin.not_available')}}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                                                    <i class="tim-icons icon-settings-gear-63"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="{{route('admin.products.show', $product->slug)}}">
                                                        {{__('admin.view')}} <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="dropdown-item" href="#pablo">Another action</a>
                                                    <a class="dropdown-item" href="#pablo">Something else</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>

                        {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
