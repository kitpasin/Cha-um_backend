@extends('frontend.layouts.layout-page')
@section('title', 'Catering')
@section('style')
    <link rel="stylesheet" href="/css/catering.min.css">
@endsection
@section('content')
    <div class="catering-column">
        <div class="column-text-top">
            <h1>{{$main_content->title}}</h1>
            <h2>{{$main_content->description}}</h2>
        </div>
        <div class="column-text-center">
            {!! $main_content->content !!}
        </div>
        <div class="column-contact">
            <div class="column">
                <img src="{{ $web_info->contact->phone->link }}" alt="">
                <h2 style="font-family: 'Playfair Display SC', serif;">{{ $web_info->contact->phone->attribute }}</h2>
                <p>{{ $web_info->contact->phone->value }}</p>
            </div>
            <div class="column">
                <img src="{{ $web_info->contact->email->link }}" alt="email">
                <h2 style="font-family: 'Playfair Display SC', serif;">E-mail</h2>
                <p>{{ $web_info->contact->email->value }}</p>
            </div>
        </div>
    </div>
    <div class="catering-img">
        @foreach($page_content as $content)
            <img src="/{{$content->image_link}}" alt="{{$content->alt}}">
        @endforeach
    </div>
@endsection
@section('script')
@endsection
