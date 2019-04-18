@extends('layouts.app')
@section('after-style')
<style type="text/css">
    .banner-content.program-view{
        top: 12%;
    }
    .program-view .rj_program{
        padding: 0px;
        margin-bottom: 20px;
    }
    .pd0{
        padding: 0px;
    }
    .blk1{
        padding-left: 0;
        padding-right: 10px;
    }
    .blk2{
        padding-right: 0;
        padding-left: 10px;
    }
    .blk-both{
        padding-right: 10px;
        padding-left: 10px;
    }
    .prgram_vw_wrap{
        padding-bottom: 219px;
    }
</style>>
@endsection
@section('content')
<div class="container-fluid header">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-5.jpg') }}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-5.jpg') }}) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content program-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12 prgram_vw_wrap">
                    <h1 class="Our_Programs stress">{{ $program->title }}</h1>
                    <p class="stress_para">{!! $program->description !!}</p>
                    <div class="rjbtn browse_pro"><a href="javascript:void(0)">View Updates</a></div>
                    <div class="rjbtn discover_rj"><a href="javascript:void(0)">Browse Resources</a></div>
                    <div class="col-md-12 pd0">
                        @foreach($sessions as $sessionIndex => $session)
                        @php
                        $session_cover_image = asset('images/no-image.png');
                        $session_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($session->cover_media->file)):
                        $session_cover_image = asset(config('constants.session.cover_path_display').$session->cover_media->file);
                        $session_cover_image_thumb = asset(config('constants.session.cover_path_display').'thumb_'.$session->cover_media->file);
                        endif;
                        @endphp
                        @if($sessionIndex < 2)
                        <div class="col-md-4 blk-both">
                            <div class="rj_program">
                                <div class="rj_program_inner blk">
                                    <a href="javascript:void(0)">
                                        <img src="{{ $session_cover_image }}" alt="">
                                        <div class="menu_opacity white_opacity"></div>
                                        <div class="menu_name white_opacity1">{{ $sessionIndex }}. {{ $session->title }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-4 blk-both">
                            <div class="rj_program">
                                <div class="rj_program_inner blk">
                                    <a href="javascript:void(0)">
                                        <img src="{{ $session_cover_image }}" alt="">
                                        <div class="menu_opacity menu_opacity_bl"></div>
                                        <div class="menu_name">{{ $sessionIndex }}. {{ $session->title }}</div>
                                        <div class="rj_lock_icon"><i class="fa fa-lock"></i></div>
                                    </a>
                                </div>
                            </div>   
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection