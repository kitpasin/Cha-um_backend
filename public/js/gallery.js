var swiper = new Swiper(".mySwiper", {
    loop: true,
    // spaceBetween: 10,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
      },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  });
var swiper2 = new Swiper(".mySwiper2", {
loop: true,
spaceBetween: 10,

pagination: {
    el: ".swiper-pagination",
    type: "fraction",
    },
navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
},
thumbs: {
    swiper: swiper,
},
});

var appendNumber = 4;
var prependNumber = 1;

var prepend_2_slides = document.querySelector(".prepend-2-slides")
if(prepend_2_slides){
    prepend_2_slides.addEventListener("click", function (e) {
        e.preventDefault();
        swiper.prependSlide([
            '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
            '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
        ]);
    });
}

var prepend_slides = document.querySelector(".prepend-slide")
if(prepend_slides){
    prepend_slides.addEventListener("click", function (e) {
        e.preventDefault();
        swiper.prependSlide(
            '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
        );
    });
}

var append_slide = document.querySelector(".append-slide")
if(append_slide){
    append_slide.addEventListener("click", function (e) {
        e.preventDefault();
        swiper.appendSlide(
            '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
        );
    });
}

var append_2_slides = document.querySelector(".append-2-slides")
if(append_2_slides){
    append_2_slides.addEventListener("click", function (e) {
        e.preventDefault();
        swiper.appendSlide([
            '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
            '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
        ]);
    });
}
