@extends('layouts.app')
@section('after-style')
<style type="text/css">
    .progrm_matirial_wrap h1{
        margin-top: 100px;
        margin-bottom: 50px;
        font-size: 50px;
        font-weight: 300;
    }
    .progrm_matirial_wrap{
        padding-bottom: 100px;
    }
    .rjbtn.discover_rj.pma{
        margin-bottom: 10px;
        background: #8FB8C9;
        border: 1px solid #678591;
    }
</style>
@endsection
@section('content')
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="images/banner-5.jpg" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url(images/banner-5.jpg) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content">
        <div class="container">
            <div class="row">
                <div class="progrm_matirial_wrap">
                    <h1>{{ $session->title }} # Material</h1>
                    {!! $session->description !!}
                    @php
                    $material_attachemnt = asset(config('constants.media.default_media_path_display'));
                    $filename = '';
                    if(isset($session->material->media->file)):
                    $filename = $session->material->media->file; 
                    $material_attachemnt = asset(config('constants.media.media_path_display').$session->material->media->file);
                    endif;
                    <div class="rjbtn discover_rj pma"><a href="{{ @$material_attachemnt }}" target="_blank">{{ $filename }}</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
