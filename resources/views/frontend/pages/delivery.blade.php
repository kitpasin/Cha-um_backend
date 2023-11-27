@extends('frontend.layouts.layout-page')
@section('title', 'Delivery')
@section('style')
    <link rel="stylesheet" href="/css/delivery.min.css">
@endsection
@section('content')
    <div class="delivery-column">
        <div class="col-text-top">
            <h1>{{$main_content->title}}</h1>
            <h2>{{$main_content->description}}</h2>
        </div>
        <div class="col-text-center">
            {!!$main_content->content!!}
        </div>
        <div class="col-bottom">
            <div class="col">
                <img src="/{{$page_content[0]->thumbnail_link}}" alt="{{$page_content[0]->thumbnail_alt}}">
                <button  onclick="window.open('{{$page_content[0]->redirect}}', '_blank')">{{$page_content[0]->thumbnail_title}}</button>
            </div>
            <p>or</p>
            <div class="col">
                <img src="/{{$page_content[1]->thumbnail_link}}" alt="{{$page_content[1]->thumbnail_alt}}">
                <button  onclick="window.open('{{$page_content[1]->redirect}}', '_blank')">{{$page_content[1]->thumbnail_title}}</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
