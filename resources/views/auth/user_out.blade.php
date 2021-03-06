@extends('layouts.app')
@php 
$landingRedirect = url('/');
if(isset($user->role_id)){
    switch($user->role_id){
        case 1:
            $landingRedirect = url('/');
            break;
        case 2:
            $landingRedirect = url('/');
            break;
    }
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
                    <h2>See you soon, {{ $user->username }}.</h2>
                </div>
            </div>
        </div>
    </div>
</div>	
@php 
Auth::logout();
@endphp
@endsection