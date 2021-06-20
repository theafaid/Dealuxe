@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{__('admin.create_product')}}</h5>
                </div>
                <div class="card-body">
                    <create-product inline-template>
                        <form
                            method="post"
                            action="{{route('admin.products.store')}}"
                            enctype="multipart/form-data"
                            @submit.prevent="create"
                            @keydown="form.onKeydown($event)">
                            @csrf
                            <div class="card">
                                <div class="card-header title">
                                    Product Information
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('admin.product_name')}}</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('name') }"
                                                    name="name"
                                                    placeholder="{{__('admin.product_name')}}"
                                                    v-model="form.name">
                                                <has-error :form="form" field="name"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-md-1">
                                            <div class="form-group">
                                                <label>{{('admin.price')}}</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('price') }"
                                                    name="price"
                                                    placeholder="{{__('admin.price')}} LE"
                                                    v-model="form.price">
                                                <has-error :form="form" field="price"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('site.product_description')}}</label>
                                                <ckeditor
                                                    id="textarea"
                                                    name="description"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('description') }"
                                                    :editor="editor"
                                                    placeholder="{{__('site.description')}}"
                                                    v-model="form.description">
                                                </ckeditor>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-md-1">
                                            <label>{{('admin.main_image')}}</label>
                                            <image-uploader
                                                :maxWidth="512"
                                                :quality="0.7"
                                                :autoRotate=true
                                                :maxHeight="10"
                                                :maxSize="1"
                                                :preview="true"
                                                :className="['fileinput', { 'fileinput--loaded': hasImage }]"
                                                capture="environment"
                                                :debug="1"
                                                doNotResize="gif"
                                                :autoRotate="true"
                                                outputFormat="blob"
                                                @input="setImage"
                                            >
                                                <label for="fileInput" slot="upload-label">
                                                    <figure>
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="32"
                                                            height="32"
                                                            viewBox="0 0 32 32"
                                                        >
                                                            <path
                                                                class="path1"
                                                                d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                                                            ></path>
                                                        </svg>
                                                    </figure>
                                                    <span class="upload-caption">
                                                        @{{
                                                        hasImage ? "Replace" : "Click to upload"
                                                      }}</span>
                                                </label>
                                            </image-uploader>

                                        </div>
                                        <div class="col-md-6 pl-md-1">
                                            <label>{{('admin.additional_images')}}</label>
                                            <input type="file" class="form-control"
                                                   :class="{ 'is-invalid': form.errors.has('additional_images') }" name="additional_images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header title">
                                    Product Variation
                                </div>
                                <div class="card-body">
                                    <table class="table tablesorter table-hover" v-if="form.variations.length">
                                        <tr>
                                            <th>Variation Type</th>
                                            <th>Variation Name</th>
                                            <th>Price</th>
                                            <th>Stock Count</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr v-for="(variation, index) in form.variations" :key="index">
                                            <td v-text="variation.type"></td>
                                            <td v-text="variation.name"></td>
                                            <td v-text="variation.price + ' LE'"></td>
                                            <td v-text="variation.stock"></td>
                                            <td v-text="variation.order"></td>
                                            <td>
                                                <button class="btn btn-danger" @click.prevent="removeVariation(index)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-3 pr-md-3">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('product_variation_type') }"
                                                    name="product_variation_type"
                                                    placeholder="{{__('admin.product_variation_type')}}"
                                                    v-model="variation.type">
                                                <has-error :form="form" field="main_image"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-3 pr-md-3">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('product_variation_type') }"
                                                    name="product_variation_type"
                                                    placeholder="{{__('admin.variation_name')}}"
                                                    v-model="variation.name">
                                                <has-error :form="form" field="additional_images"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-2 px-md-2">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('product_variation_price') }"
                                                    name="product_variation_price"
                                                    placeholder="{{__('admin.price')}} LE"
                                                    v-model="variation.price">
                                                <has-error :form="form" field="product_variation_type"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-2 pl-md-2">
                                            <div class="form-group">
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('product_variation_stock_count') }"
                                                    name="product_variation_stock_count"
                                                    placeholder="{{__('stock_count')}}"
                                                    v-model="variation.quantity">
                                                <has-error :form="form" field="product_variation_type"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-1 pl-md-1">
                                            <div class="form-group">
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('product_variation_order') }"
                                                    name="product_variation_order"
                                                    placeholder="{{__('order')}}"
                                                    v-model="variation.order">
                                                <has-error :form="form" field="product_variation_price"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-1 pl-md-1">
                                            <div class="form-group">
                                                <button class="btn btn-success" @click.prevent="addVariation">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="{{__('admin.save_product')}}">
                            </div>
                        </form>
                    </create-product>
                </div>
            </div>
        </div>
    </div>
@endsection

