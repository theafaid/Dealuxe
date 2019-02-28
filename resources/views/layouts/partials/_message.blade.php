@if($errMsg = session()->get('error'))
    <div class="alert alert-danger">{{$errMsg}}</div>
@endif

@if($successMsg = session("success"))
    <div class="alert alert-success">{{$successMsg}}</div>
@endif

@if(count($errors))
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    </div>
@endif