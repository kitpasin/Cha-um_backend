<footer>
    <div class="body-load">
        <svg class="spinner" width="150px" height="150px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
        </svg>
    </div>
    <div class="column-footer">
        <div class="column grid-item1">
            {{-- <img src="/images/logo.png" alt=""> --}}
            <!-- will open when production -->
            <img src="/{{ $web_info->detail->image_1->link }}" alt="{{ $web_info->detail->image_1->value }}">
            <small>{{$web_info->footer->copy_right->value}}</small>
        </div>
        <div class="column">
            <h2>{{$web_info->footer->footer_menu->description}}</h2>
            <ul>
                @foreach($website['footer_menu'] as $menu)
                    <li><a href="{{$menu->cate_url}}">{{$menu->cate_title}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="column">
            <h2>{{$web_info->footer->footer_more_info->description}}</h2>
            <ul>
                @foreach($website['footer_menuinfo'] as $menu)
                    <li><a href="{{$menu->cate_url}}">{{$menu->cate_title}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="column">
            <h2>{{$web_info->footer->footer_term_privacy->description}}</h2>
            <ul>
                {{-- <li><a href="{{$web_info->footer->terms_of_service->link}}" target="_blank">Terms of Service</a></li> --}}
                <li><a href="{{$web_info->footer->privacy_policy->link}}" target="_blank">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="column">
            <h2>{{$web_info->footer->footer_social->description}}</h2>
            <div class="column-social">
                <a href="{{$web_info->contact->link_facebook->link}}" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
                <a href="{{$web_info->contact->link_instagram->link}}" target="_blank"><i class="fa-brands fa-square-instagram"></i></i></a>
                {{-- <a href="{{$web_info->contact->link_twitter->link}}" target="_blank"><i class="fa-brands fa-square-twitter"></i></a> --}}
            </div>
        </div>
    </div>
    <div class="column-footer-bottom">
        <small>{{$web_info->footer->copy_right->value}}</small>
    </div>
</footer>
<script>
    const language = window.location.pathname.split('/')[1]
    localStorage.setItem('language', language);
</script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="/js/navbar.js"></script>
<script src="/js/popup.js"></script>
