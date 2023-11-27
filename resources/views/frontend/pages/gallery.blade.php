@extends('frontend.layouts.layout-page')
@section('title', 'Gallery')
@section('style')
    <link rel="stylesheet" href="/css/gallery.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="gallery">
            <div class="column-text">
                <h1>{{$main_content->title}}</h1>
                <h2>{{$main_content->description}}</h2>
            </div>
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    @foreach($page_content as $content)
                        <div class="swiper-slide" style="background: none;">
                            @if($content->title !== "")
                                <p class="text">{{$content->title}}</p>
                            @endif
                            <img style="object-fit: scale-down;" src="/{{$content->image_link}}" alt="{{$content->alt}}"/>
                        </div>
                    @endforeach
                </div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($page_content as $content)
                        <div class="swiper-slide">
                            <img src="/{{$content->image_link}}" alt="{{$content->alt}}"/>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev" style="display: none;"></div>
                <div class="swiper-button-next" style="display: none;"></div>
            </div>
            <div class="swiper-pagination"></div>
            <button class="next" onclick="document.querySelector('.swiper-button-prev').click()"><i class="fa-solid fa-angle-left"></i></button>
            <button class="prev" onclick="document.querySelector('.swiper-button-next').click()"><i class="fa-solid fa-angle-right"></i></button>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/gallery.js"></script>
@endsection
