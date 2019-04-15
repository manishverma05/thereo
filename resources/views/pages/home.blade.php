@extends('layouts.app')
@section('content')
<div class="container-fluid header">
    <div id="fullpage">
        <!-- Start Section -->
        <div class="section" id="section0" onload="loadVideo()">
            <div class="videoBackground" style="height:200px; z-index: -999999999999999999999999999;">
                <video preload="none" autoplay="autoplay" muted loop id="backVideo">
                    <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                    <source type="video/mp4" src="{{ asset('videos/video.mp4') }}" />
                    <!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
                    <source type="video/webm" src="{{ asset('videos/video.webm') }}" />
                    <!-- M4V for Apple -->
                    <source type="video/mp4" src="{{ asset('videos/video.m4v') }}" />
                    <!-- Ogg/Vorbis for older Firefox and Opera versions -->
                    <source type="video/ogg" src="{{ asset('videos/video.ogg') }}" />
                    <!-- Subtitles -->
                </video>
            </div>
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rj_single_block play_mk">
                            <h1>What is myThereo?</h1>
                            <div class="play_btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#modal1">
                                    <!--<img src="{{ asset('images/icon/Icons_Website/play.svg') }}" width="18px" height="18px">-->
                                    <?xml version="1.0" encoding="utf-8"?>
                                    <!-- Generator: Adobe Illustrator 23.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 48 48" style="enable-background:new 0 0 48 48;" xml:space="preserve">
                                        <path d="M4.8,48c-0.9,0-1.8-0.2-2.5-0.7C0.9,46.4,0,44.9,0,43.2V4.8c0-1.7,0.9-3.2,2.3-4.1C3,0.2,3.9,0,4.8,0c0.7,0,1.5,0.2,2.1,0.5
                                              l38.4,19.2C47,20.5,48,22.2,48,24s-1,3.5-2.7,4.3L6.9,47.5C6.3,47.8,5.5,48,4.8,48z"/>
                                    </svg>

                                </a></div>
                            <div class="content_para">
                                <p class="my_para">You are currently learning about lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section1" style="background: url({{ asset('images/banner-2.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rj_single_block">
                            <h1>This is who we are.</h1>
                            <p class="wwr">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section2" style="background: url({{ asset('images/banner-3.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rj_single_block">
                            <h1>This is how we work.</h1>
                            <p class="hww">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section3" style="background: url({{ asset('images/banner-4.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rj_single_block">
                            <h1>Explore. Discover. Grow.</h1>
                            <div class="row">
                                <div class="suggest_wrap">
                                    <div class="rjbtn browse_pro"><a href="javascript:void(0)">Browse our Programs</a></div>
                                    <div class="or_rj">or</div>
                                    <div class="rjbtn discover_rj"><a href="javascript:void(0)">Discover More</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->
    </div>
</div>
@endsection
