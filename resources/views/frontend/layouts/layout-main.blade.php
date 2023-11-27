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
    @yield('style')
</head>
<body>
    @include('frontend.layouts.navbar')
    @include('frontend.layouts.swiper')
    <div class="content">
        @yield('content')
    </div>
    @include('frontend.layouts.footer')
    @yield('script')
</body>
</html>
