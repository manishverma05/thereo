<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ @$pagetitle }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('administrator/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('administrator/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('administrator/css/dashboard.css') }}" rel="stylesheet">
        <style>
            .ck-editor__editable_inline {
                min-height: 200px;
            }
        </style>
        <!-- Page Styles -->
        @yield('after-style')
    </head>
    <body class="rj_admin_panel">
        <div class="container">
            <!-- Start Admin Header -->
            <div class="row breadcrumb-section">
                <div class="col-md-12">
                    <div class="rjadmin_bar"><a href="{{ route('admin.dashboard') }}" class="rjadmin_active"><i class="fa fa-bars"></i></a></div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-8">
                    <!--@yield('breadcrumb-left')-->
                    <div class="rjadmin_breadcrumb_left">
                        <p>{{ $pageheader }}</p>
                        <div class="rjadmin_back"><a href="JavaScript:Void(0)" onclick="goBack()"><i class="fa fa-reply"></i></a></div>
                        @yield('left-breadcrumb')
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-4">
                    <!--@yield('breadcrumb-right')-->
                    <div class="rjadmin_breadcrumb_right">
                        <div class="rjadmin_back"><a href="{{ route('admin.logout') }}">Logout</a></div>
                        @yield('right-breadcrumb')
                    </div>
                </div>
            </div>
            <!-- End Admin Header -->
            @include('admin._partial.message')
            @yield('content')
        </div>
        <!-- Scripts -->
        <script src="{{ asset('administrator/js/jquery.min.js') }}" ></script>
        <script src="{{ asset('administrator/js/bootstrap.js') }}" >
        </script>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <!-- Page Scripts -->
        @yield('after-script')
    </body>
</html>