@extends('layouts.app')

@section('after-style')
<style>
    .panel-default>.panel-heading {
        color: #333;
        background-color: #fff;
        border-color: #e4e5e7;
        padding: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .panel-default>.panel-heading a {
        display: block;
        color:#555555;
        background: #ffffffc7;
        padding: 15px;
        font-size:25px;
        font-weight: 300;

    }

    .panel-default>.panel-heading a:after {
        content: "";
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        font-size: 16px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        float: right;
        transition: transform .25s linear;
        -webkit-transition: -webkit-transform .25s linear;
        color: #8FB8C9;
    }
    .question_rj .panel-title {  
        font-size: 18px;

    }
    .panel-default>.panel-heading a[aria-expanded="true"] {
        background-color: transparent;
        color: #fff;
    }

    .panel-default>.panel-heading a[aria-expanded="true"]:after {
        content: "\2212";
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        color: #fff;
    }

    .panel-default>.panel-heading a[aria-expanded="false"]:after {
        content: "\002b";
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .fp-scroller{
        /* transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1)!important;
 transition-duration: 0ms!important;
 transform: translate(0px, 0px) translateZ(0px)!important;*/

    }

    .about-sec4 .nvbtn_wrap{
        width: 800px;
        margin: 0 auto;
        padding-bottom: 200px;
    }
    .about-sec4 p{
        margin-bottom: 50px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid header">
    <div id="fullpage">
        <!-- Start Section -->
        <div class="section" id="section0" style="background: url({{ asset('images/banner-5.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 about-sec0">
                        <div class="rj_single_block">
                            <h1>About myThereo</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section1" style="background: url({{ asset('images/banner-1.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 about-sec1">
                        <div class="rj_single_block">
                            <h1>Are we for you?</h1>
                            <div class="rj_condition">
                                <div class="rj_cond_line"><i class="fa fa-check"></i></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rj_condition">
                                <div class="rj_cond_line"><i class="fa fa-check"></i></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="rj_condition">
                                <div class="rj_cond_line"><i class="fa fa-check"></i></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt..</p>
                            </div>
                            <div class="rj_condition">
                                <div class="rj_cond_line"><i class="fa fa-check"></i></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section2" style="background: url({{ asset('images/banner-2.jpg') }} ) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 about-sec2">
                        <div class="rj_single_block">
                            <h1>What people say</h1>
                            <div class="rj_testimonial">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum."</p>

                                <div class="rjtext_foot"><a href="#">Lorem Ipsum, Dolor Sit</a></div>

                            </div>

                            <div class="rj_testimonial">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum."</p>

                                <div class="rjtext_foot"><a href="#">Lorem Ipsum, Dolor Sit</a></div>

                            </div>

                            <div class="rj_testimonial">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum."</p>

                                <div class="rjtext_foot"><a href="#">Lorem Ipsum, Dolor Sit</a></div>

                            </div>

                            <div class="rj_testimonial">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum."</p>

                                <div class="rjtext_foot"><a href="#">Lorem Ipsum, Dolor Sit</a></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section3" style="background: url({{ asset('images/banner-3.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 about-sec3">
                        <div class="rj_single_block">
                            <h1>Things people ask</h1>
                            <div class="question_rj">

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Lorem ipsum dolor sit amet?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Consectetur adipiscing?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Elit sed do eiusmod?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingfour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                                    Tempor incididunt ut labore et dolore magna?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                                            <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird

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
        <!-- End Section -->

        <!-- Start Section -->
        <div class="section" id="section4" style="background: url({{ asset('images/banner-4.jpg') }}) center no-repeat;background-size: cover;">
            <div class="single_opacity"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 about-sec4">
                        <div class="rj_single_block">
                            <h1>Get involved today</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>

                            <div class="nvbtn_wrap">
                                <div class="rjbtn browse_pro"><a href="javascript:void(0)">Browse our Programs</a></div>
                                <div class="rjbtn browse_pro"><a href="#">Explore our Community</a></div>
                                <div class="rjbtn browse_pro"><a href="#">Tell people about us</a></div>
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
<script type="text/javascript" src="{{ asset('js/scrolloverflow.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fullpage.js') }}"></script>
<script type="text/javascript">
    var myFullpage = new fullpage('#fullpage', {
        anchors: ['AboutMyThereo', 'Conditions', 'Testimonials', 'Questions', 'Leading'],
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