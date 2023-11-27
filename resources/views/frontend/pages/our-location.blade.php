@extends('frontend.layouts.layout-page')
@section('title', 'Our Location')
@section('style')
    <link rel="stylesheet" href="/css/our-location.min.css">
@section('content')
    <div class="our-location">
        <div class="col-text-top">
            <h1>{{$main_content->title}}</h1>
            <h2>{{$main_content->description}}</h2>
        </div>
        <div class="col-text-center">
            <div class="col">
                <h2 style="font-family: 'Playfair Display SC', serif;">{{$web_info->location->address->description}}</h2>
                <p>
                    {{$web_info->location->address->value}}<br>
                    {{$web_info->location->district->value}}<br>
                    {{$web_info->location->province->value}}
                </p>
            </div>
            <div class="col">
                <h2 style="font-family: 'Playfair Display SC', serif;">{{ $web_info->location->working_hours->description }}</h2>
                <p>{{ $web_info->location->working_hours->value }}</p>
                
            </div>
            <div class="col">
                <h2 style="font-family: 'Playfair Display SC', serif;">Contact</h2>
                <p>Phone: {{ $web_info->contact->phone->value }}</p>
                <p>E-mail: {{ $web_info->contact->email->value }}</p>
            </div>
        </div>
        <div class="col-text-bottom">
            {!! $main_content->content !!}
        </div>
    </div>
    <div class="map">
        {!! $web_info->location->google_map->iframe !!}
    </div>
@endsection
@section('script')
@endsection
