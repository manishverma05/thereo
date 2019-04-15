<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
        <title>{{ @$pagetitle }}</title>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/simplelightbox.min.css') }}" rel="stylesheet">
        <style>
            .navbar-nav > li > a {
                width: 100px !important;
                height: 100px !important;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            .li_cust {
                padding: 0px !important;
            }
            .li_cust svg{
                width: 18px;
                height: 18px;
                fill: #8FCCB6;
            }
        </style>
        <!-- Page Styles -->
        @yield('after-style')
    </head>
    <body>
        <!-- Start Navigation -->
        <nav class="navbar navbar_pad" id="navbar">
            <ul class="navbar-nav navbar-left ">
                <li class="nav-item li_cust">
                    <a href="javascript::void(0);" class="back_rj" onclick="goBack()">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve">
                        <path class="st0" d="M7.8,2.8H4.2V0.7L0,3.5l4.2,2.8V4.2h3.5c1.6,0,2.8,1.3,2.8,2.8S9.3,9.9,7.8,9.9H4.2v1.4h3.5
                              c2.3,0,4.2-1.9,4.2-4.2S10.1,2.8,7.8,2.8z"/>
                        </svg>
                    </a>
                </li>
                <li class="nav-item li_cust">
                    <a href="{{ route('landing') }}">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 48 48" style="enable-background:new 0 0 48 48;" xml:space="preserve">
                        <path d="M0,36h48v12H0V36z M0,18h48v12H0V18z M0,0h48v12H0V0z"/>
                        </svg>
                    </a>
                </li>
            </ul>
            <div class="navbar-logo header_logo "><a href="javascript::void(0);"><img src="{{ asset('images/logo.png') }}" alt=""></a></div>
            <ul class="navbar-nav navbar-right">
                <li class="nav-item li_cust">
                    <a href="javascript::void(0);">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve">
                        <path class="st0" d="M3.3,7.7h6C9.7,7.7,10,8,10,8.3C10,8.7,9.7,9,9.3,9H2.7C2.3,9,2,8.7,2,8.3V1.7H0.7C0.3,1.7,0,1.4,0,1
                              s0.3-0.7,0.7-0.7h2C3,0.3,3.3,0.6,3.3,1v1.3H12L9.3,7h-6V7.7z M3,9.7c0.6,0,1,0.4,1,1s-0.4,1-1,1s-1-0.4-1-1S2.4,9.7,3,9.7z M9,9.7
                              c0.6,0,1,0.4,1,1s-0.4,1-1,1s-1-0.4-1-1S8.4,9.7,9,9.7z"/>
                        </svg>
                    </a>
                </li>
                @php
                $accountRoute = url('/login');
                if(isset(auth()->user()->role_id)){
                    switch (auth()->user()->role_id) {
                        case 1:
                            $accountRoute = route('admin.dashboard');
                            break;
                        case 2:
                            $accountRoute = route('user');
                            break;
                    }
                }
                @endphp
                <li class="nav-item li_cust li_cust_right">
                    <a href="{{ $accountRoute }}">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 48 48" style="enable-background:new 0 0 48 48;" xml:space="preserve">
                        <path d="M44.6,44.6c0,1.9-1.5,3.4-3.4,3.4H6.9c-1.9,0-3.4-1.5-3.4-3.4c0-6.9,6.6-13.3,13.4-15.8c-3.9-2.4-6.5-6.7-6.5-11.6v-3.4
                              C10.3,6.1,16.4,0,24,0s13.7,6.1,13.7,13.7v3.4c0,4.9-2.6,9.2-6.5,11.6C37.9,31.3,44.6,37.7,44.6,44.6z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Navigation -->
        @yield('content')
        <!-- Scripts -->
        <!-- jquery.min.js -->
        <script src="{{ asset('js/jquery.min.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>  
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        
        <!-- Page Scripts -->
        @yield('after-script')
    </body>
</html>