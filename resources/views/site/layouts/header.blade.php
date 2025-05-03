<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ getSetting('site_name',app()->getLocale()) }} | @yield('title') </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content=" website" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="" />
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="shortcut icon" href="{{ asset('storage/'. getSetting('favicon')) }}">

    <meta name="msapplication-TileColor" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @seo
    @include('site.layouts.style')

</head>

<body>
 <!-- welcome  :) -->


    <!-- start loading -->

    <div class="loader">


        <div class="loading-wave">
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
        </div>

    </div>
    <!-- end lodding -->


    <!-- welcome -->
    <div class="body_page  d-flex flex-column justify-content-between">
