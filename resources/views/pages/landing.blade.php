@extends('layouts.app')

@section('after-style')
<style>
    .pd0{padding: 0;}
    .mrgn-left{
        margin-left:20px;
    }
    .mrgn-right{
        margin-right: 20px;
    }
    .nvmenu-wrap{
        overflow: hidden;
    }
    .nvmenu-wrap .rj_masonry-1{
        margin-bottom: 0px;
    }
    .wd420{
        width: 420px;
        border: 2px solid #A8E6CF;
        margin-bottom: 20px;
    }
    .wrap860{
        width: 860px;
    }
    .wd860{
        width: 860px;
        border: 2px solid #A8E6CF;
        margin-bottom: 20px;
    }
    .menu_wrap .rj_masonry-1.side_masonry{
        height: 582px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid header  menu-headers_list">
    <div id="homepage">
        <div class="background">
            <div class="rj_banner_img"><img src="{{ asset('images/banner-5.jpg') }}" alt=""></div>
            <style>@media (max-width: 767px) {.background {background: url({{ asset('images/banner-5.jpg') }}) center;}}</style>
        </div>
        <div class="banner_opacity"></div>
    </div>
    <div class="banner-content">
        <div class="container">

            <div class="col-md-12 menu_wrap pd0">
                <h1 class="menu_all">Where would you like to go?</h1>
                <div class="nvmenu-wrap">
                    <div class="col-md-12 pd0">
                        <div class="col-sm-12 pd0">
                            <div class="col-md-8 pd0 wrap860">
                                <div class="col-sm-12 pd0">
                                    <div class="col-md-6 pd0 wd420 mrgn-right">
                                        <div class="rj_masonry-1 home_rjmasonry ">
                                            <a href="{{ route('user.home') }}">
                                                <img src="{{ asset('images/menu-1.jpg') }}" alt="">
                                                <div class="menu_opacity"></div>
                                                <div class="menu_name">Home</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pd0  wd420 ">
                                        <div class="rj_masonry-1 home_rjmasonry">
                                            <a href="{{ route('user.about') }}">
                                                <img src="{{ asset('images/menu-2.jpg') }}" alt="">
                                                <div class="menu_opacity"></div>
                                                <div class="menu_name">About</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 wd860 pd0 mrgn-right">
                                        <div class="rj_masonry-1 rj_masonry-1_products ">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('images/menu-3.jpg') }}" alt="">
                                                <div class="menu_opacity"></div>
                                                <div class="menu_name">Products</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pd0 wd420 mrgn-left">
                                <div class="rj_masonry-1 side_masonry ">
                                    <a href="{{ route('user.programs') }}">
                                        <img src="{{ asset('images/menu-4.jpg') }}" alt="">
                                        <div class="menu_opacity"></div>
                                        <div class="menu_name">Programs</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 pd0">
                            <div class="col-md-4 pd0 wd420 mrgn-right">
                                <div class="rj_masonry-1 side_masonry">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('images/menu-8.jpg') }}" alt="">
                                        <div class="menu_opacity"></div>
                                        <div class="menu_name">Credits</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8 pd0 wrap860">
                                <div class="col-sm-12 pd0">
                                    <div class="col-md-12 wd860 pd0">
                                        <div class="rj_masonry-1 rj_masonry-1_products ">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('images/menu-7.jpg') }}" alt="">
                                                <div class="menu_opacity"></div>
                                                <div class="menu_name">Counselling</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 wd420 pd0">
                                        <div class="rj_masonry-1 home_rjmasonry ">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('images/menu-5.jpg') }}" alt="">
                                                <div class="menu_opacity"></div>
                                                <div class="menu_name">Articles</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6  wd420 pd0 mrgn-left">
                                        <div class="rj_masonry-1 home_rjmasonry">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('images/menu-6.jpg') }}" alt="">
                                                <div class="menu_opacity"></div>
                                                <div class="menu_name">contact</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('after-script')
<script src="{{ asset('js/custom.js') }}"></script>
@endsection