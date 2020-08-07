<!DOCTYPE html>
<html @if(direction() == 'rtl') lang="ar" @else lang="en" @endif @if(direction() == 'rtl') dir="rtl" @endif class="no-js">
<!-- Begin Head -->
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- ================= Favicon ================== -->
    <link rel="shortcut icon" href="{{ url('dist/img/favicon.png') }}">
    <link rel="manifest" href="{{request()->root()}}/manifest.json">
    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** Resources CSS ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- ============== Bootstrap v4.2.1 ============== -->
    <link rel="stylesheet" href="{{ url('dist/css/bootstrap-rtl.min.css') }}" />

    <!-- ============== Resource style ============== -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <!-- ============== Lightslider ============== -->
    <link rel="stylesheet" href="{{ asset('dist/css/lightslider.min.css') }}" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    @stack('css')
</head>

<body id="to_top">

    <header id="header" class="shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light container">

            <a href="{{ url('/') }}">
                <img class="logo" src="{{ url('dist/svg/logo.svg') }}" alt="logo" />
                <img class="logo-mobile" src="{{ url('dist/svg/logo-mobile.svg') }}" alt="logo" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @include('front.components.menu')
            </div>
        </nav>
    </header>

<div id="content">
