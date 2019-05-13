@extends('layouts.app')
@section('after-style')
<style>
    .prog_resource svg{
        width: 14px;
        height: 12px;
        fill: #fff; 
        margin-left: 5px;
    }
    .prog_resource h1{
        margin-top: 70px;
        margin-bottom: 50px;
        font-weight: 300;
    }
    .prog_resource p{
        font-weight: 300;
        font-size: 30px;
        margin-bottom: 0px;
    }
    .prog_resource .rj-programe_btn{
        margin-top: 50px;
        margin-bottom: 60px;
    }
    .prog_resource .dropdown.rj-drop .btn.btn-primary{
        font-size: 17px;
    }
    .program_resource_wrap{
        overflow: hidden;
        clear: both;
    }
    .program_resource_wrap .rj_program{
        margin-bottom: 20px;
    }
    .pd0{padding: 0px;}
    .pd-left{padding-left: 0px;padding-right: 10px;}
    .pd-right{padding-right: 0px;padding-left: 10px;}
    .pd-both{padding-left: 10px;padding-right: 10px;}
    .prog_resource{
        padding-bottom: 150px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-5.jpg')}}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-5.jpg')}}) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 prog_resource">
                    <h1>Resources on {{ $session->title }}</h1>
                    {!! $session->description !!}
                    <div class="rj-programe_btn">
                        <div class="dropdown rj-drop">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">All Resources
                                <?xml version="1.0" encoding="utf-8"?>
                                <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve">

                                    <path class="st0" d="M1.7,2.6L6,6.9l4.3-4.3L12,3.4l-6,6l-6-6L1.7,2.6z"/>
                                </svg></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('user.session.resource.list',[$session->slug,'local'])}}">Local Resources</a></li>
                                <li><a href="{{ route('user.session.resource.list',[$session->slug,'media'])}}">Media Resources</a></li>
                                <li><a href="{{ route('user.session.resource.list',[$session->slug,'external'])}}">External Resources</a></li>
                            </ul>
                        </div>
                        <div class="dropdown rj-drop">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Recently Added
                                <?xml version="1.0" encoding="utf-8"?>
                                <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve">

                                    <path class="st0" d="M1.7,2.6L6,6.9l4.3-4.3L12,3.4l-6,6l-6-6L1.7,2.6z"/>
                                </svg></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Esse cillum</a></li>
                                <li><a href="#">Lorem ipsum</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="program_resource_wrap">
                        @foreach ($session->resources as $session_resource)
                        @php
                        $session_resource_cover_image = asset(config('constants.media.default_media_path_display'));
                        $mediaType = ($session_resource->resource->type == 'local'?'product' :($session_resource->resource->type == 'media' || $session_resource->resource->type == 'external'?'cover_media':'cover_media'));
                        if($mediaType)
                        if(isset($session_resource->resource->$mediaType->media->file)):
                        $session_resource_cover_image = asset(config('constants.media.media_path_display').$session_resource->resource->$mediaType->media->file);
                        endif;
                        @endphp
                        <div class="col-md-4 pd0">

                            <div class="rj_program pd-left">
                                <div class="rj_program_inner">
                                    <a href="javascript:void(0)">
                                        <img src="{{ $session_resource_cover_image }}" alt="">
                                            <div class="menu_opacity"></div>
                                            <div class="menu_name">{{ $session_resource->resource->title }}</div>
                                    </a>
                                </div>
                            </div>                       


                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
