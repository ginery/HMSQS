<!DOCTYPE html>
<!--
create by: ginx
-->
<html lang="en">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('dist/css/app.css')}}" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <!-- <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}" type="text/javascript"></script> -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
    </script>
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <!-- DataTables Buttons extension CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js" type="text/javascript"></script>

    <script src="{{asset('assets/js/jquery-qrcode.min.js')}}" type="text/javascript"></script>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="app">
    <!-- BEGIN: Mobile Menu -->
    @include('layouts.mobile-navigation')
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        @include('layouts.navigation')
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                @php
                $currentUrl = url()->current();
                $url = explode('/',$currentUrl);
                // echo count($url);
                if(count($url) > 5){
                $breadcrumbs = route($url[3],$url[5]);
                $name = $url[3];
                }else if(count($url) > 4){
                $breadcrumbs = route($url[3],$url[4]);
                $name = $url[3];
                // $breadcrumbs = route("dashboard");
                // $name = "test";
                }else{
                $breadcrumbs = route("dashboard");
                $name = "Home";
                }
                @endphp
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="{{$breadcrumbs}}" class="">{{ucfirst(str_replace("-"," ", $name))}}</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">{{ucfirst(str_replace("-"," ", Route::current()->getName()))}}</a> </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                <!-- BEGIN: Search -->
                <div class="intro-x relative mr-3 sm:mr-6">
                </div>
                <!-- END: Search -->
                <!-- BEGIN: Notifications -->
                <div class="intro-x dropdown relative mr-auto sm:mr-6">
                </div>
                <!-- END: Notifications -->
                @include('layouts.profile-dropdown')
                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            <main>
                {{ $slot }}
            </main>


        </div>
        <!-- END: Content -->
    </div>
    <!-- BEGIN: JS Assets-->

    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <script src="{{asset('dist/js/app.js')}}"></script>

    <!-- END: JS Assets-->

</body>

</html>