@extends('layouts.app')

@section('after-style')
<style type="text/css">
    .rjbtn.discover_rj.ses_btn1{
        margin-top: 70px;
        margin-bottom: 20px;
    }
    .seswrp1{
        padding-bottom: 110px;
    }
    #section1 .rj_single_block.seswrp1, 
    #section2 .rj_single_block.seswrp1{
        padding-bottom: 110px;
    }
    .watchprog_wrap .rj_single_block h3{
        margin: 209px 0 50px;
        font-weight: 300;
    }
    .watchprog_wrap .mpara{
        margin-bottom: 50px;
    }
    .watching_progm{
        width: 800px;
        margin: 0 auto;
    }
    .watching_progm .rjbtn.discover_rj{
        margin-bottom: 10px;
        margin-top: 0px;
    }
    .watching_progm .or_rj{
        margin-bottom: 10px;
    }
    .watching_progm{
        padding-bottom: 150px;
    }
    #fp-nav.program-sess-nav{top:380px;}
    #fp-nav.program-sess-nav .bluedot span{
        background: #8FB8C9;
        border: 1px solid #678591;
    }
</style>
@endsection
@php
$anchors = [];
@endphp
@section('content')
<div class="container-fluid header">
    <div id="fullpage">
        @foreach($program->sessions as $program_session)
        @php
        if (Helper::is_access_allowed(@$program_session->session->access[0]->role_id))
        $anchors[] = $program_session->session->slug;
        @endphp
        <!-- Start Section -->
        <div class="section program-session" id="section0" style="">
            @php
            if (!Helper::is_access_allowed(@$program_session->session->access[0]->role_id))
            continue;
            $video = '';
            $filename = '';
            if(isset($program_session->session->video->media->file)):
            $filename = $program_session->session->video->media->file; 
            $video = asset(config('constants.media.media_path_display').$program_session->session->video->media->file);
            $pathinfo = pathinfo($program_session->session->video->media->file);
            endif;
            @endphp 
            <div class="videoBackground" style="height:200px; z-index: -999999999999999999999999999;">
                <video preload="none" autoplay="autoplay" muted loop id="backVideo">
                    <source type="video/{{ @$pathinfo['extension'] }}" src="{{ $video }}" />
                </video>
            </div>	
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="rj_single_block seswrp1">
                            <h3 class="int_stress">{{ $program_session->session->title }}</h3>
                            <div class="play_btn">
                                <a href="#" data-toggle="modal" data-target="#{{ $program_session->session->unique_id }}">
                                    <?xml version="1.0" encoding="utf-8"?>
                                    <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 48 48" style="enable-background:new 0 0 48 48;" xml:space="preserve">
                                        <path d="M4.8,48c-0.9,0-1.8-0.2-2.5-0.7C0.9,46.4,0,44.9,0,43.2V4.8c0-1.7,0.9-3.2,2.3-4.1C3,0.2,3.9,0,4.8,0c0.7,0,1.5,0.2,2.1,0.5
                                              l38.4,19.2C47,20.5,48,22.2,48,24s-1,3.5-2.7,4.3L6.9,47.5C6.3,47.8,5.5,48,4.8,48z"/>
                                    </svg>
                                </a>
                            </div>
                            {!! $program_session->session->description !!}
                            <div class="rjbtn discover_rj ses_btn1"><a href="{{ route('user.session.material.list',[$program_session->session->slug])}}">View Session Material</a></div>
                            <div class="rjbtn browse_pro ses_btn2"><a href="{{ route('user.session.resource.list',[$program_session->session->slug])}}">Brows                                                                        e Resources</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <!-- End Section -->
        @endforeach
        <div class="section program-session" id="loginRegister" style="">
            <div class="row">
                <div class="login_wrap login_wrap_mk">
                    <p class="log_p" style="font-size:17px">Sign in or join up below to access all our programs, resources, and more.</p>
                    <div class="rjbtn discover_rj"><a href="javascript::void(0);" onclick="{{ route('login') }}">Sign In</a></div>
                    <div class="or_rj">or</div>
                    <div class="rjbtn browse_pro"><a href="{{ route('register') }}">Join Up</a></div>
                </div>
            </div>
        </div>
    </div>
    <div id="fp-nav" class="fp-right rj_nav_menu program-sess-nav">
        <ul>
            <li class="goback_rj goback_rj_mks"><a href="{{ route('user.program.detail',[$program->slug]) }}"><span></span></a></li>
            @foreach($program->sessions as $program_session)
            @if (Helper::is_access_allowed(@$program_session->session->access[0]->role_id))
            <li class="bluedot"><a href="{{ $program_session->session->slug }}" class=""><span></span></a></li>
            @endif
            @endforeach
            <li class="bluedot"><a href="loginRegister" class=""><span></span></a></li>
        </ul>
    </div>
</div> 
@foreach($program->sessions as $program_session)
@php
$video = '';
$filename = '';
if(isset($program_session->session->video->media->file)):
$filename = $program_session->session->video->media->file; 
$video = asset(config('constants.media.media_path_display').$program_session->session->video->media->file);
$pathinfo = pathinfo($program_session->session->video->media->file);
endif;
@endphp
<!-- Modal -->
@include('_partial.pop_modal', ['video' => $video , 'type' => @$pathinfo['extension'], 'modalId' => $program_session->session->unique_id ])
@endforeach
@endsection

@section('after-script')
<script type="text/javascript" src="{{ asset('js/scrolloverflow.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fullpage.js') }}"></script>
<script type="text/javascript">
var myFullpage = new fullpage('#fullpage', {
    anchors: @php echo json_encode($anchors); @endphp,
            sectionsColor: [],
    scrollOverflow: true,
    navigation: true,
    css3: true,
    scrollingSpeed: 1000,
    slidesNavigation: true,
    responsiveHeight: 330,
});
</script>
@endsection