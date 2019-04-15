@extends('layouts.app')

@section('after-style')
<style type="text/css">
    .login_wrap .or_rj{
        margin-bottom: 10px;
    }
    .login_wrap .rjbtn.discover_rj{
        margin-bottom: 10px;
    }
    .logn-pass-form{
        width: 800px;
        margin:0 auto;
    }
    p.log_pass{
        text-align: center;
    }
    .login-password-wrap{
        padding-top: 270px;
        padding-bottom: 275px;
    }
    .logn-pass-form .rjbtn.discover_rj{
        margin-bottom: 5px;
    }
    .logn-pass-form input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        color: #B5B4B4;
    }
    .logn-pass-form input::-moz-placeholder { /* Firefox 19+ */
        color: #B5B4B4;
    }
    .logn-pass-form input:-ms-input-placeholder { /* IE 10+ */
        color: #B5B4B4;
    }
    .logn-pass-form input:-moz-placeholder { /* Firefox 18- */
        color: #B5B4B4;
    }
    .login-name_wrap{
        padding-top: 150px;
        padding-bottom: 150px;
    }
    .login-name_wrap p.lgn_p{
        color: #555555;
        font-size: 17px;
        line-height: normal;
        margin-bottom: 39px;
    }
    .lgn_nme_form{
        width: 800px;
        max-width: 800px;
        margin: 0 auto;
    }
    .lgn_nme_form input{
        height: 70px;
        border: 1px solid #9DA3A6;
        font-size: 20px;
        font-weight: 400;
        color: #555555;
        font-family: 'Open Sans', sans-serif;
    }
    .lgn_nme_form input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        color: #B5B4B4;
    }
    .lgn_nme_form input::-moz-placeholder { /* Firefox 19+ */
        color: #B5B4B4;
    }
    .lgn_nme_form input:-ms-input-placeholder { /* IE 10+ */
        color: #B5B4B4;
    }
    .lgn_nme_form input:-moz-placeholder { /* Firefox 18- */
        color: #B5B4B4;
    }
    .login-name_wrap .rjbtn.discover_rj{
        margin-bottom: 10px;
    }
    .login-name_wrap .rjbtn.discover_rj a{
        color: #678591;
    }
</style>
@endsection('after-style')

@section('content')
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-4.jpg') }}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-4.jpg') }}) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
        @csrf
        <div id="login-step-1" class="login-steps">
            @include('auth.login_option');
        </div>
        <div id="login-step-2" class="login-steps" style="visibility: hidden;">
            @include('auth.login_email');
        </div>
        <div id="login-step-3" class="login-steps" style="visibility: hidden;">
            @include('auth.login_password');
        </div>
    </form>

</div>	
@endsection
@section('after-script')
<script>
    function loginstep(step) {
        $('.login-steps').css('visibility', 'hidden');
        $('#login-step-' + step).css('visibility', 'visible');
    }
</script>
@endsection('after-script')
