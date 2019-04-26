@extends('layouts.app')

@section('after-style')
<style type="text/css">
    .register-detail h2{
        font-size: 50px;
    }
    .orcont_rj.access-code{
        margin-bottom: 10px;
        font-size: 13px;
        font-family: Open Sans, Regular;
    }
    .orcont_rj.agree-ts{
        font-size: 13px;
        font-family: Open Sans, Regular;
    }
    .register-detail .contfrm_wrap .form-control{
        font-size: 17px;
        font-family: Open Sans, Regular;
        font-weight: 400;
    }
    .register-detail .sndmsg a{
        font-size: 17px;
        font-family: Open Sans, Regular;
    }
</style>
@endsection

@section('content')
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-4.jpg') }}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-4.jpg') }}) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content rjsign_in">
        <div class="container contact-container">
            <div class="row">
                <div class="contact_wrap register-detail">
                    <h2>Enter your Details</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        <div class="row contfrm_wrap">
                            <div class="form-group">
                                <input value="{{ old('firstname') }}" type="text" class="form-control" placeholder="First Name" name="firstname">
                                @if ($errors->has('firstname'))
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input value="{{ old('lastname') }}" type="text" class="form-control" placeholder="Last Name" name="lastname">
                                @if ($errors->has('lastname'))
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input value="{{ old('email') }}" type="text" class="form-control" placeholder="Email" name="email">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Create Password" name="password">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Retype Password" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="dropdown contctslct">
                                    <select class="form-control" name="role">
                                        <option value="">Select Role</option>
                                        <option value="2">Customer</option>
                                        <option value="3">Author</option>
                                    </select>
                                    @if ($errors->has('role'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!--                            <div class="form-group">
                                                            <div class="dropdown contctslct">
                                                                <button class=" form-control dropdown-toggle" type="button" data-toggle="dropdown">Date Of Birth
                                                                    <span class="arw"><img src="{{ asset('images/arrow-alt.svg') }}" /></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Lorem ipsum</a></li>
                                                                    <li><a href="#">Lorem ipsum</a></li>
                                                                    <li><a href="#">Lorem ipsum</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="dropdown contctslct">
                                                                <button class=" form-control dropdown-toggle" type="button" data-toggle="dropdown">Date Of Gender
                                                                    <span class="arw"><img src="{{ asset('images/arrow-alt.svg') }}" /></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Lorem ipsum</a></li>
                                                                    <li><a href="#">Lorem ipsum</a></li>
                                                                    <li><a href="#">Lorem ipsum</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>-->
                            <!--                            <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Company Access Code">
                                                        </div>-->
                            <div class="orcont_rj access-code">If you are part of a company, you may enter your access code below. <a href="#">Click here to learn more. </a>.</div>
                            <div class="form-group sndmsg" style="background: #3D5057; border: 1px solid #678591;">
                                <a href="javascript:void(0)" onclick="document.getElementById('registerForm').submit();">Register with us</a>
                            </div>
                            <div class="orcont_rj agree-ts">By creating an account, you agree to our Terms of Service and  <a href="#">Privacy Policy</a>.</div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection
