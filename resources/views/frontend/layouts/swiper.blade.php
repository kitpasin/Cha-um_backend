<div class="swiper">
    <div class="swiper-wrapper">
        @foreach($ad_slide as $ad)
            <div class="swiper-slide">
                <img src="/{{$ad->ad_image}}" alt="{{$ad->ad_description}}">
            </div>
        @endforeach
    </div>
    <div class="swiper-button-prev" style="display: none;"></div>
    <div class="swiper-button-next" style="display: none;"></div>
    <button class="next" onclick="document.querySelector('.swiper-button-prev').click()"><i class="fa-solid fa-angle-left"></i></button>
    <button class="prev" onclick="document.querySelector('.swiper-button-next').click()"><i class="fa-solid fa-angle-right"></i></button>
    <div class="swiper-pagination"></div>
</div>
