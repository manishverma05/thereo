@extends('layouts.app')
@section('after-style')
<style>
    .pd0{
        padding: 0;
    }
    .mrgn-left{
        margin-left: 0;
        margin-right: 10px;
    }
    .mrgn-right{
        margin-left: 10px;
        margin-right: 0px;
    }
    .mrgn-both{
        margin-left: 10px;
        margin-right: 10px;
    }
    .wd420{
        width: 420px;
    }
    .wd860{
        width: 860px;
    }
    .wdwdh420{
        height: 582px;
        width: 420px;
    }
    .wdwdh420.rj_program img{
        height: 578px;
    }
    .or_program .rj_program.rj_program_mk3 .rj_program_inner{
        width: 100%;
    }
    .or_program .rj_program.rj_program_mk3 img{
        width: 100%;
    }
    .or_program .rj_program.rj_program_mk3 img{
        height: 276px;
    }
    .or_program .wd420 .rj_program img{
        height: 276px;
    }
    .or_program{
        clear: both;
    }
    .or_program .rj_program{
        margin-bottom: 20px;
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
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content">
        <div class="container">
            <div class="col-md-12 pd0">
                <h1 class="Our_Programs">Our Programs</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                <div class="rj-programe_btn Our_Programs_cont">
                    <div class="dropdown rj-drop">
                        <button class="btn btn-primary dropdown-toggle all_program_button All_Programs" type="button" data-toggle="dropdown">
                            @if(empty($programCategory))
                            All Programs
                            @else
                            {{ $programCategory->title }}
                            @endif
                            <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            @if(!empty($programCategory))
                            <li><a href="{{ route('user.programs') }}">All Programs</a></li>
                            @endif
                            @foreach($programCategories as $programCategory)
                            <li><a href="{{ route('user.program.category.detail',[$programCategory->slug]) }}">{{ $programCategory->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown rj-drop">
                        <button class="btn btn-primary dropdown-toggle all_program_button All_Programs" type="button" data-toggle="dropdown">Trending
                            <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Popular Programs</a></li>
                            <li><a href="#">Recent Programs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="or_program">
                    <div class="col-md-12 pd0 mrgn-left">
                        @foreach ($programs as $program)
                        @php
                        $program_cover_image = asset(config('constants.media.default_media_path_display'));
                        $filename = '';
                        if(isset($program->cover_media->media->file)):
                        $filename = $program->cover_media->media->file; 
                        $program_cover_image = asset(config('constants.media.media_path_display').$program->cover_media->media->file);
                        endif;
                        @endphp
                        @if(Helper::is_access_allowed(@$program->access[0]->role_id))
                        <div class="col-md-4 pd0 wd420 mrgn-left">
                            <div class="rj_program rj_program_mk5  pd0">
                                <div class="rj_program_inner">
                                    <a href="{{ route('user.program.detail',[$program->slug]) }}">
                                        <img src="{{ $program_cover_image }}" alt=""  >
                                        <div class="menu_opacity"></div>
                                        <div class="menu_name">{{ $program->cover_title ? $program->cover_title : $program->title }}</div>
                                    </a>
                                </div>
                            </div>                      
                        </div>
                        @else
                        <div class="col-md-4 pd0 wd420 mrgn-left blk-both">
                            <div class="rj_program rj_program_mk5  pd0">
                                <div class="rj_program_inner">
                                    <a href="javascript:void(0)">
                                        <img src="{{ $program_cover_image }}" alt=""  >
                                        <div class="menu_opacity_bl"></div>
                                        <div class="menu_name">{{ $program->cover_title ? $program->cover_title : $program->title }}</div>
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