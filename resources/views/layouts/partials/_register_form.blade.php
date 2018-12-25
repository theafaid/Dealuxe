<form action="{{route('register')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-12 mb-20">
            <input name="name" type="text" placeholder="{{__('front.name')}}" value="{{old('name')}}">
            @if ($errors->has('name') && session()->has('register'))
                <strong class="badge badge-danger">{{ $errors->first('name') }}</strong>
            @endif
        </div>

        <div class="col-lg-6 col-12 mb-20">
            <input type="email" name="email" placeholder="{{__('front.email_address')}}" value="{{old('email')}}">
            @if ($errors->has('email') && session()->has('register'))
                <strong class="badge badge-danger">{{ $errors->first('email') }}</strong>
            @endif
        </div>

        <div class="col-lg-6 col-12 mb-20">
            <input type="password" name="password" placeholder="{{__('front.password')}}">
            @if ($errors->has('password') && session()->has('register'))
                <strong class="badge badge-danger">{{ $errors->first('password') }}</strong>
            @endif
        </div>

        <div class="col-lg-6 col-12 mb-20">
            <input type="password" name="password_confirmation" placeholder="{{__('front.repeat_password')}}">
            @if ($errors->has('password_confirmation') && session()->has('register'))
                <strong class="badge badge-danger">{{ $errors->first('password_confirmation') }}</strong>
            @endif
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-round btn-lg">{{__('front.register')}}</button>
        </div>
    </div>
</form>