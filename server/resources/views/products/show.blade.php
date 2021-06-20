@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{__('admin.product')}} {{$product->name}}</h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card  card-user">
                <div class="card-body ">
                    <p class="card-text">
                    </p><div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>
                        <a href="#">
                            <img class="" src="{{$product->image}}" alt="...">
                            <h5 class="title">{{$product->name}}</h5>
                        </a>
                        <p class="description">
                            Ceo/Co-Founder
                        </p>
                    </div>
                    <p></p>
                    <p class="card-description">
                        Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                    </p>
                </div>
                <div class="card-footer ">
                    <div class="button-container">
                        <button href="#" class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button href="#" class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button href="#" class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
