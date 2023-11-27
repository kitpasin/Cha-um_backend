@extends('frontend.layouts.layout-main')
@section('title', 'Home')
@section('style')
    <link rel="stylesheet" href="/css/index.min.css">
@endsection
@section('content')
    <div class="detail-tamarind">
        <div class="column-top">
            <div class="text-top">
                <h1>{{$main_content->title}}</h1>
                <h2>{{$main_content->description}}</h2>
            </div>
            <div class="text-center">
                {!!$main_content->content!!}
            </div>
            <div class="col-btn">
                <button onclick="location.href='menu'">{{$lang_config?$lang_config['FZUCKk7nZNrvIUF'] : ""}}</button>
                <button onclick="location.href='delivery'">{{$lang_config?$lang_config['JgK5O34aOtM2JUW'] : ""}}</button>
            </div>
        </div>
        <div class="column-contact">
            <div class="column-text">
                <div class="column-top">
                    <img src="{{$web_info->location->address->link}}" alt="address">
                    <h2>{{$web_info->location->address->attribute}}</h2>
                </div>
                <p style="text-align: left">
                    {{$web_info->location->address->value}}<br>
                    {{$web_info->location->district->value}}<br>
                    {{$web_info->location->province->value}}
                </p>
            </div>
            <div class="column-text">
                <div class="column-top">
                    <img src="{{$web_info->location->working_hours->link}}" alt="working">
                    <h2>{{$web_info->location->working_hours->attribute}}</h2>
                </div>
                {{-- <p>{{$web_info->location->working_hours->value}}</p> --}}
                <p>{{$web_info->location->working_hours1->description}}</p>: <span> {!!$web_info->location->working_hours1->value!!}</span>
            </div>
            <div class="column-text">
                <div class="column-top">
                    <img src="{{$web_info->contact->phone->link}}" alt="phone">
                    <h2>{{$web_info->contact->phone->attribute}}</h2>
                </div>
                <p>{{$web_info->contact->phone->value}}</p>
            </div>
        </div>
    </div>
    <div class="our-story" style="--our_image: url('/{{$page_story[0]->thumbnail_link}}')">
        <div class="column-story">
            <h2>{{$page_story[0]->title}}</h2>
            <div class="col-text">
                <div class="column-left" style="width: 50%;">
                    {!!$page_story[0]->content!!}
                </div>
                <div class="column-right" style="width: 50%;">
                    {!!$page_story[1]->content!!}
                    <button class="btn-bottom" onclick="location.href='gallery'">{{$lang_config?$lang_config['SjRAn7iEtdLlE1Z']:""}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="column-img-menu">
        @if($page_content)
            @foreach($page_content as $key => $content)
                @if($key !== 1)
                    <div class="item">
                        <img src="/{{$content->image_link}}" alt="{{$content->alt}}">
                        <h2 class="middle">{{$content->title}}</h2>
                    </div>
                @else
                    <div class=" item1">
                        <img class="col1" src="/{{$content->image_link}}" alt="{{$content->alt}}">
                        <div class="column-text">
                            <h2>{{$content->title}}</h2>
                            <button onclick="location.href='menu'">{{$content->alt}}</button>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
@section('script')
    <script src="/js/index.js"></script>
@endsection
