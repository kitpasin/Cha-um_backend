@extends('frontend.layouts.layout-page')
@section('title', 'Menu')
@section('style')
<link rel="stylesheet" href="/css/menu.min.css">
@section('content')
<div class="carte-menu">
    <div class="column-top">
        <h1>{{$main_content->title}}</h1>
        <h2>{{$main_content->description}}</h2>
        <div class="column-right">
            <div id="dropdown">
                <button id="dropdownBtn">Download the Menu<i class="fa-solid fa-chevron-down" style="color: white"></i></button>
                <div id="dropdownOptions" class="dropdownOptions">
                    @foreach ($food_pdf as $pdf)
                        <a href="/{{$pdf->thumbnail_link}}" target="_blank" class="option">{{$pdf->title}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="column-menu">
        @foreach ($page_content as $content)
        <div class="column">
            @if($content->topic !== "" && $content->topic != null)
            <div class="box-top">
                <div class="box-text-top">
                    <p>{{$content->topic}}</p>
                </div>
                <div id="triangle-bottomleft"></div>
            </div>
            @endif
            <figure onclick="showMenu(this)">
                <img id="myImg" src="/{{$content->thumbnail_link}}" alt="{{$content->alt}}">
            </figure>
            <div class="column-text">
                <p>{{$content->title}}</p>
            </div>
            <input type="hidden" name="content-food" value="{{$content->content}}">
        </div>
        @endforeach
    </div>
</div>

@endsection
@section('script')
<script src="/js/menu.js"></script>
@endsection
