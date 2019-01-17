<div class="col-12 badge badge-info">
    {{__('front.please_verify_your_email_msg', ['name' => auth()->user()->name])}}<br>
    <a class="fa fa-send" href="{{route('verification.notice')}}">
        {{__('front.resend_verification_msg')}}
    </a>
</div>