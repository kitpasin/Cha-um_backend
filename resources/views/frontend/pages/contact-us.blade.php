@extends('frontend.layouts.layout-page')

@section('title', 'Contact Us')

@section('style')

    <link rel="stylesheet" href="/css/contact-us.min.css">
    <link rel="stylesheet" href="/css/country-code.css">

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

@endsection

@section('content')

    <div class="contact-us">

        <div class="col-text-top">

            <h1>{{ $main_content->title }}</h1>

            <h2>{{ $main_content->description }}</h2>

        </div>

        <div class="detail-contact">

            <div class="col-left">

                <form action="">

                    <div class="form-group">

                        <label>{{ Request::segment(1) === 'fr' ? 'Nom' : 'Your Name' }}<span
                                style="color: red">*</span></label>

                        <input class="form-control" name="name">

                    </div>

                    <div class="form-group">

                        <label>{{ Request::segment(1) === 'fr' ? 'Email' : 'Email' }}<span
                                style="color: red">*</span></label>

                        <input type="email" class="form-control" name="email">

                    </div>

                    <div class="form-group">

                        <label>{{ Request::segment(1) === 'fr' ? 'Téléphone' : 'Telephone' }}<span
                                style="color: red">*</span></label>

                        <div class="select-box">
                            <div class="selected-option">
                                <div class="flag">
                                    <span class="iconify" data-icon="flag:fr-4x3"></span>
                                </div>
                                <input class="form-control number" name="phone">
                            </div>
                            <div class="options">
                                <input type="text" class="search" placeholder="Search Country Name">
                                <ol>

                                </ol>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <label>Message <span style="color: red">*</span></label>

                        <textarea name="message" id="" cols="30" rows="10"></textarea>

                    </div>

                    <div class="btn">

                        <button type="button" id="btnSend"
                            class="btn-primary">{{ $lang_config['7mKWbFUwiRQKEhb'] }}</button>

                    </div>

                </form>

            </div>

            <div class="col-right">

                <h3>{{ $web_info->location->address->description }}</h3>
                <p>
                    <span>

                        {{ $web_info->location->address->value }}<br>

                        {{ $web_info->location->district->value }}<br>

                        {{ $web_info->location->province->value }}

                    </span>
                </p>

                <p>{{ $web_info->contact->phone->description }}: <span>{{ $web_info->contact->phone->value }}</span></p>

                <p>{{ $web_info->contact->email->description }}: <span><a
                            href="https://mail.google.com/mail/u/0/#search/{{ $web_info->contact->email->value }}"
                            target="_blank">{{ $web_info->contact->email->value }}</a></span></p>

                <p style="margin-bottom: 0 !important;">{{ $web_info->location->working_hours->description }}:</p>
                <div class="working-hours">
                    <div class=""
                        style="    display: flex;flex-direction: column;justify-content: space-between;align-items: start;">
                        <p>{{ $web_info->location->working_hours1->description }}</p>
                        <p>{{ $web_info->location->working_hours2->description }}</p>
                    </div>
                    <span> {!! $web_info->location->working_hours1->value !!}{!! $web_info->location->working_hours2->value !!}</span>
                </div>
                {{-- <div class="working-hours">
                    <p>{{$web_info->location->working_hours1->description}}</p><span> {!!$web_info->location->working_hours1->value!!}</span>
                </div>
                <div class="working-hours">
                    <p>{{$web_info->location->working_hours2->description}}</p><span> {!!$web_info->location->working_hours2->value!!}</span>
                </div> --}}
                <p style="margin-top: 1rem;">{{ $web_info->location->Acces->description }}:
                    <span>{{ $web_info->location->Acces->value }}</span>
                </p>
                <div class="column-social">

                    <a href="{{ $web_info->contact->link_facebook->link }}" target="_blank"><i
                            class="fa-brands fa-square-facebook"></i></a>

                    <a href="{{ $web_info->contact->link_instagram->link }}" target="_blank"><i
                            class="fa-brands fa-square-instagram"></i></i></a>

                </div>

            </div>

        </div>
    </div>
    <div class="map">
        {!! $web_info->location->google_map->iframe !!}
    </div>

@endsection

@section('script')

    <script src="/js/contactus.js"></script>
    <script src="/js/countrycode.js"></script>

@endsection
