<form action="{{route('login')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12 mb-20">
            <input type="email" name="email" placeholder="{{__('front.email_address')}}" value="{{old('email')}}">
            @if ($errors->has('email') && ! session()->has('register'))
                <strong class="badge badge-danger">{{ $errors->first('email') }}</strong>
            @endif
        </div>


        <div class="col-12 mb-20">
            <input name="password" type="password" placeholder="{{__('front.password')}}">
            @if ($errors->has('password') && ! session()->has('register'))
                <strong class="badge badge-danger">{{ $errors->first('password') }}</strong>
            @endif
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-round btn-lg">{{__('front.login')}}</button>
        </div>
    </div>
</form>