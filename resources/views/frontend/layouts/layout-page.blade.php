<?php
    $language = Request::segment(1);
    $website = new \App\Assets\Website;
    $website = $website->settings();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.head')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/banner.min.css">
    @yield('style')
</head>
<body>
    @include('frontend.layouts.navbar')
    @include('frontend.layouts.banner')
    <div class="content">
        @yield('content')
    </div>
    @include('frontend.layouts.footer')
    @yield('script')
</body>
</html>
