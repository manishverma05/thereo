@extends('layouts.app')

@section('after-style')
<style type="text/css">
    .banner_opacity.about-opac{
        background: rgba(255,255,255,0.8);
        filter: brightness(25);
    }
</style>
@endsection
@section('content')
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-5.jpg') }}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-5.jpg') }}) center;}}</style>
        </div>
        <div class="banner_opacity about-opac"></div>
    </div>
    <div class="banner-content">
        <div class="container">
            <div class="row">
                <div class="rjpro_updates prog_update col-sm-12">
                    <h1>Updates on Stress</h1>
                    @foreach($program->updates as $update)
                    <div class="pro_up">
                        <div class="pro_box"><span>{{ $update->created_at }} |</span> {{ $update->title }}</div>
                        {!! $update->description !!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
