@extends('frontend.layouts.layout-page')
@section('title', 'About Us')
@section('style')
    <link rel="stylesheet" href="/css/aboutus.min.css">
@endsection
@section('content')
    <div class="about">
        <div class="col-text-top">
            <h1>{{$main_content->title}}</h1>
            <h2>{{$main_content->description}}</h2>
        </div>
        <div class="col-text-center">
            {!!$main_content->content!!}
        </div>
        <div class="col-about">
            @foreach($page_content as $content)
                <div class="col">
                    <div class="left">
                        <img src="/{{$content->thumbnail_link}}" alt="{{$content->thumbnail_alt}}">
                    </div>
                    <div class="right">
                        <h2 style="font-family: 'Playfair Display SC', serif;">{{$content->title}}</h2>
                        {!!$content->content!!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
@endsection
