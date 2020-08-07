<!DOCTYPE html>
<html class="no-js" @if(direction() == 'rtl') lang="ar" @else lang="en" @endif @if(direction() == 'rtl') dir="rtl" @endif>
<head>
<meta charset="utf-8">
<!-- Tell the browser to be responsive to screen width -->
<meta name="description" content="">
<meta name="author" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!--[if lt IE 9]><script src="./assets/html5.js"></script><![endif]-->
<meta name="robots" content="index,follow" />
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ url('design/adminlte') }}/assets/images/favicon.png">
<title>@lang('front.namewebsite')</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- Date picker plugins css -->
<link href="{{ url('design/adminlte') }}/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

 <link href="{{ url('design/adminlte') }}/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<!-- This page CSS -->
<link rel="stylesheet" href="{{ url('/') }}/design/adminlte/jstree/themes/default/style.css">
  <link href="{{ url('/') }}/design/adminlte/dist/css/pages/floating-label.css" rel="stylesheet">
@if(direction() == 'rtl')
<!-- Custom CSS -->
<link href="{{ url('design/adminlte/assets/') }}/dist/rtl/css/style.min.css" rel="stylesheet">
<!-- Dashboard 1 Page CSS -->
<link href="{{ url('design/adminlte/assets/') }}/dist/rtl/css/pages/dashboard1.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet">
 <link rel="stylesheet" href="{{ url('design/adminlte/assets/') }}/node_modules/dropify/dist/css/dropify.min.css">
  <style type="text/css">
    html,body ,h1,h2,h3,h4,h5,h6{
      font-family: 'Cairo', sans-serif;
    }

    .btn{
      margin: 2px;
    }
    .dt-buttons{
      margin-bottom: 10px;
    }
  </style>
@else
<!-- Custom CSS -->
<link href="{{ url('design/adminlte/assets/') }}/dist/css/style.min.css" rel="stylesheet">
<!-- Dashboard 1 Page CSS -->
<link href="{{ url('design/adminlte/assets/') }}/dist/css/pages/dashboard1.css" rel="stylesheet">
@endif


<link href="{{ url('design/adminlte/assets/') }}/node_modules/morrisjs/morris.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
 <link href="{{ url('design/adminlte/assets/') }}/node_modules/wizard/steps.css" rel="stylesheet">
    <!--alerts CSS -->
<link href="{{ url('design/adminlte/assets/') }}/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<link href="{{ url('design/adminlte/assets/') }}/node_modules/calendar/dist/fullcalendar.css" rel="stylesheet" />
<!-- jQuery 3.1.1 -->
 <script src="{{ url('design/adminlte/assets/') }}/node_modules/jquery/jquery-3.2.1.min.js"></script>
     <script src="{{ url('design/adminlte') }}/assets/node_modules/moment/moment.js"></script>

<script src="{{ url('/js/toastr.min.js') }}"></script>
@stack('css')
@yield('css')
</head>

<body class="fixed-layout skin-green-dark">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
<div class="loader">
    <div class="loader__figure"></div>
    <p class="loader__label">@lang('front.namewebsite')</p>
</div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ aurl('/') }}">
                <img src="{{ url('dist/svg/logo-mobile.svg') }}" alt="homepage" class="light-logo" height="55px" />

                 </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-list-ul"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                {{--
                                    <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li>
                --}}
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">

                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <ul>

                            <li>
                                <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  <i class="fa fa-globe"></i>
                       <div class="lang"> <span class="heartbit"></span> <span class="point"> </span> </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <div class="message-center">
                        <!-- Message -->
                        <a href="{{ aurl('lang/ar') }}">
                            <div class="btn btn-danger btn-circle"><i class="fa fa-flag"></i></div>
                            <div class="mail-contnet">
                                <h6> عربى  </h6>
                            </div>
                        </a>

                         <a href="{{ aurl('lang/en') }}">
                            <div class="btn btn-danger btn-circle"><i class="fa fa-flag"></i></div>
                            <div class="mail-contnet">
                                <h6> English</h6>
                            </div>
                        </a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->