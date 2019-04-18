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
                        <button class="btn btn-primary dropdown-toggle all_program_button All_Programs" type="button" data-toggle="dropdown">All Programs
                            <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            @foreach($programCategories as $programCategory)
                            <li><a href="javascript:void(0)">{{ $programCategory->title }}</a></li>
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
                    <div class="col-md-12 pd0 wd860 mrgn-left">
                        @foreach ($programs as $program)
                        @php
                        $program_cover_image = asset('images/no-image.png');
                        $program_cover_image_thumb = asset('images/no-image.png');
                        if(isset($program->cover_media->file)):
                        $program_cover_image = asset(config('constants.program.cover_path_display').$program->cover_media->file);
                        $program_cover_image_thumb = asset(config('constants.program.cover_path_display').'thumb_'.$program->cover_media->file);
                        endif;
                        @endphp
                        <div class="col-md-4 pd0 wd420 mrgn-left">
                            <div class="rj_program rj_program_mk5  pd0">
                                <div class="rj_program_inner">
                                    <a href="{{ route('user.program',[$program->slug]) }}">
                                        <img src="{{ $program_cover_image }}" alt=""  >
                                        <div class="menu_opacity"></div>
                                        <div class="menu_name">{{ $program->title }}</div>
                                    </a>
                                </div>
                            </div>                      
                        </div>
                        @endforeach
                    </div>
                    <!--                    <div class="col-md-4 pd0 wdwdh420 mrgn-right">
                                            <div class="rj_program rj_program_mk5  wdwdh420 pd0">
                                                <div class="rj_program_inner">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('images/program-4.jpg') }}" alt="" >
                                                        <div class="menu_opacity"></div>
                                                        <div class="menu_name">Self-Care</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-8 pd0 wd860 mrgn-left">
                                            <div class="col-sm-12 pd0">
                                                <div class="rj_program rj_program_mk1  pd0">
                                                    <div class="rj_program_inner">
                                                        <a href="javascript:void(0)">
                                                            <img src="{{ asset('images/program-1.jpg') }}" alt="">
                                                            <div class="menu_opacity"></div>
                                                            <div class="menu_name">Stress</div>
                                                        </a>
                                                    </div>
                                                </div>                      
                                            </div>
                                            <div class="col-md-6 pd0 wd420 mrgn-left">
                                                <div class="rj_program rj_program_mk5  pd0">
                                                    <div class="rj_program_inner">
                                                        <a href="javascript:void(0)">
                                                            <img src="{{ asset('images/program-1.jpg') }}" alt=""  >
                                                            <div class="menu_opacity"></div>
                                                            <div class="menu_name">Depression</div>
                                                        </a>
                                                    </div>
                                                </div>                      
                                            </div>
                                            <div class="col-md-6 pd0 wd420 mrgn-right">
                                                <div class="rj_program rj_program_mk3  pd0">
                                                    <div class="rj_program_inner">
                                                        <a href="javascript:void(0)">
                                                            <img src="{{ asset('images/program-1.jpg') }}" alt="">
                                                            <div class="menu_opacity"></div>
                                                            <div class="menu_name">Parenting</div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pd0 wdwdh420 mrgn-right">
                                            <div class="rj_program rj_program_mk5  wdwdh420 pd0">
                                                <div class="rj_program_inner">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('images/program-4.jpg') }}" alt="" >
                                                        <div class="menu_opacity"></div>
                                                        <div class="menu_name">Self-Care</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>-->
                </div>
            </div>
        </div>
    </div>	
</div>	
@endsection