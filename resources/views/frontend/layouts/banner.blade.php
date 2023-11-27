@if($banner)
    <div class="banner">
        <div class="banner-column" style="--our_image: url('/{{$banner->ad_image}}')">
            <div class="col-text">
                <h2 style="font-family: 'Playfair Display SC', serif;">{{$banner->ad_title}}</h2>
                <p>{{$banner->ad_description}}</p>
            </div>
        </div>
    </div>
@endif
