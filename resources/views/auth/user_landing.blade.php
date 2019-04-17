@extends('layouts.app')
@php 
switch(auth()->user()->role_id){
case 1:
    $landingRedirect = route('admin.dashboard');
break;
case 2:
    $landingRedirect = route('user.home');
break;
default:
    $landingRedirect = url('/');
break;
}
@endphp
@section('content')
<meta http-equiv="refresh" content="2; URL={{ $landingRedirect }}">
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-4.jpg') }}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-4.jpg') }}) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content rjsign_in">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1" style="margin-top: 9%;">
                    <div class="profile-pic-rj">
                        <img src="{{ asset('images/profile.jpg') }}" class="rjprofile">
                    </div>
                    <h2>Welcome back, {{ auth()->user()->username }}.</h2>
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection