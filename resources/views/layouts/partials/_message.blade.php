@if($errMsg = session()->get('error'))
    <div class="alert alert-danger">{{$errMsg}}</div>
@endif