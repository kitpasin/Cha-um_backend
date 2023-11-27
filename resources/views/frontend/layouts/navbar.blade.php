
<header>
    <div class="topnav">
        <div class="nav-left">
            <ul>
                @foreach ($website['mainmenu'] as $key => $menu)
                    @if($key < intval(ceil($website['mainmenu']->count()/2)))
                        <li><a href="/<?=$language?>/{{$menu->cate_url}}">{{$menu->cate_title}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="nav-center" style="text-align: center;">
            <img style="width: 100%;" src="/{{ $web_info->detail->image_1->link }}" alt="{{ $web_info->detail->image_1->value }}">
        </div>
        <div class="nav-right">
            <ul>
                @foreach ($website['mainmenu'] as $key => $menu)
                    @if($key >= intval(ceil($website['mainmenu']->count()/2)))
                        @if($key === $website['mainmenu']->count()-1)
                            <div class="Translate">
                                @foreach ($website['language'] as $lang)
                                    <button onclick="changeLanguage('{{$lang->abbv_name}}')" class="{{ (request()->segment(1) === $lang->abbv_name) ? 'active' : '' }}">
                                        <img src="/{{$lang->flag}}" alt="change language button image">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                        @if($menu->cate_url === 'book')
                            <li><a href="/<?=$language?>/{{$menu->cate_url}}" class="btn">
                                <button class="btn-book">{{$menu->cate_title}}</button>
                            </a></li>
                        @else
                            <li><a href="/<?=$language?>/{{$menu->cate_url}}">{{$menu->cate_title}}</a></li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="navbar-sm">
        <div class="column-left" style="display: flex; align-items: center;">
            <img src="/{{ $web_info->detail->image_1->link }}" style="width: 80px;" alt="{{ $web_info->detail->image_1->value }}">
        </div>
        <div class="column-right" style="display: flex; align-items: center;">
            <div id="toggle-icon">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div class="navbar" id="navbar">
                <ul class="navbar-menu">
                    @foreach ($website['mainmenu'] as $key => $menu)
                        @if($key === $website['mainmenu']->count()-1)
                            <div class="Translate">
                                @foreach ($website['language'] as $lang)
                                    <button onclick="changeLanguage('{{$lang->abbv_name}}')" class="{{ (request()->segment(1) === $lang->abbv_name) ? 'active' : '' }}"><img src="/{{$lang->flag}}" alt=""></button>
                                @endforeach
                            </div>
                        @endif
                        @if($menu->cate_url === 'book')
                            <li><a href="/<?=$language?>/{{$menu->cate_url}}">
                                <button class="book">{{$menu->cate_title}}</button>
                            </a></li>
                        @else
                            <li><a href="/<?=$language?>/{{$menu->cate_url}}">{{$menu->cate_title}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
