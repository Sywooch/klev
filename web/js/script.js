$(function () {
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 5,
        paginationClickable: true,
        spaceBetween: 0,
        loop:true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    });

    $(document).on('click', 'a.no_href', function (e) {
        e.preventDefault();
        return false;
    });
    $(document).on('click', '.header1__wrap_adaptive>a', function (event) {
        if ($(this).parent().hasClass('header1__wrap_menu_fixed_active')) {
            var left = "-100%";
        } else {
            var left = "0";
        }
        $(this).parent().toggleClass('header1__wrap_menu_fixed_active');
        $(".header3__wrap ").animate({
            left: left,
        }, {
            duration: 300,
            specialEasing: {
                width: "linear",
                height: "easeOutBounce"
            },
            complete: function () {
            }
        });
        if (event.preventDefault) {
            event.preventDefault();
        } else {//firefox
            return false;
        }
    });
    $('.shop-catalog1_wrap_right_list1_wrap_item').matchHeight();
    $('.item1__inner_right_inner_block3_slider_inner .slickslide').slick({
        prevArrow: '<img class="slick-prev" src="/images/site_images/item/slider1__prev1.png">',
        nextArrow: '<img class="slick-next" src="/images/site_images/item/slider1__next1.png">',
        dots: true,
        infinite: true,
        speed: 500,
        fade: false,
        slide: 'li',
        cssEase: 'linear',
        centerMode: false,
        slidesToShow: 1,
        variableWidth: false,
        autoplay: false,
        autoplaySpeed: 4000,
        arrows:true,
        customPaging: function (slider, i) {
            return '<button class="tab">' + $('.slick-thumbs li:nth-child(' + (i + 1) + ')').html() + '</button>';
        }
    });
    var swiper2 = new Swiper('.item1__inner_right_inner_block3_custom1_reviews-slider .swiper-container', {
        pagination: false,
        paginationClickable: true,
        loop:true,
        nextButton: '.swiper-button-next2',
        prevButton: '.swiper-button-prev2',
    });
})

