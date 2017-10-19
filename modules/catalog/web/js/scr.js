$(function () {
    $.fn.bindImageLoad = function (callback) {
        function isImageLoaded(img) {
            // Во время события load IE и другие браузеры правильно
            // определяют состояние картинки через атрибут complete.
            // Исключение составляют Gecko-based браузеры.
            if (!img.complete) {
                return false;
            }
            // Тем не менее, у них есть два очень полезных свойства: naturalWidth и naturalHeight.
            // Они дают истинный размер изображения. Если какртинка еще не загрузилась,
            // то они должны быть равны нулю.
            if (typeof img.naturalWidth !== "undefined" && img.naturalWidth === 0) {
                return false;
            }
            // Картинка загружена.
            return true;
        }

        return this.each(function () {
            var ele = $(this);
            if (ele.is("img") && $.isFunction(callback)) {
                ele.one("load", callback);
                if (isImageLoaded(this)) {
                    ele.trigger("load");
                }
            }
        });
    };
    $(document).on('click', '.catalog1__inner_right_inner_change_filter_list1_block1_content a.sort', function (e) {
        var destination = $('.catalog1__inner_right_filter1').offset().top;
        console.log(destination);
        $('body,html').animate({
            scrollTop: destination - 30
        }, 1000);
        e.preventDefault();
        return false;
    });
    $(document).on('click', '.catalog1__inner_right_inner_change_filter_list1_block1_content a.krit', function (e) {
        var destination = $('.catalog1__inner_left_block1.search').offset().top;
        console.log(destination);
        $('body,html').animate({
            scrollTop: destination
        }, 1000);
        e.preventDefault();
        return false;
    });
    $(document).on('click', '.catalog1__inner_right_inner_change_filter_list1_block2 a', function (e) {
        var destination = $('.catalog1__inner_left_block1').offset().top;
        console.log(destination);
        $('body,html').animate({
            scrollTop: destination - 30
        }, 1000);
        e.preventDefault();
        return false;
    });
    $(document).on('click', '.item1__inner_right_inner_about1_list1_item_right_ulov_btn a', function () {
        $('.item1__inner_right_inner_about1_list1_item_right_ulov_list1').toggleClass('more');
        return false;
    });

    $(document).on('click', '.view-object1__wrap_new_review_form_right_list_item a', function () {
        $('.view-object1__wrap_new_review_form_right_list_item').removeClass('selected');
        th = $(this);
        th.parent().addClass('selected');
        var oc = $(this).data('eval');
        $('#reviews-ocenka').val(oc);
        return false;
    });

    $(document).on('mouseenter', '.view-object1__wrap_new_review_form_right_list_item a', function () {
        $('.view-object1__wrap_new_review_form_right_list_item').removeClass('active');
        item = $(this).parent();
        item_a = $(this);
        $('.view-object1__wrap_new_review_form_right_list_item').each(function(i,elem) {
            if ($(this).find('a').data('eval')<=item_a.data('eval')) {
                $(this).addClass('active');
            }
        });
        return false;
    });
    $(document).on('mouseleave', '.view-object1__wrap_new_review_form_right_rate', function () {
        $('.view-object1__wrap_new_review_form_right_list_item').removeClass('active');
        if($('div').is('.view-object1__wrap_new_review_form_right_list_item.selected')){
            selected_item_a = $('.view-object1__wrap_new_review_form_right_list_item.selected').find('a');
            $('.view-object1__wrap_new_review_form_right_list_item').each(function(i,elem) {
                if ($(this).find('a').data('eval')<=selected_item_a.data('eval')) {
                    $(this).addClass('active');
                }
            });
        }
        return false;
    })
    $(document).on('click', '.item1__inner_right_inner_reviews_list1_add a', function () {
        $('.default-new_review').slideToggle('slow');
        return false;
    });

    $(document).on('submit', '.default-new_review form', function () {
        var btn = $(this).find('button');
        btn.button('loading');
    });
    $(document).on('click', '.item1__inner_right_inner_reviews_list1_right_inner_block1_likes .like a', function () {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/catalog/ajax/review-like",
            data: ({'review_id':th.data('id')}),
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    th.closest('.item1__inner_right_inner_reviews_list1_item').find('.item1__inner_right_inner_reviews_list1_left_custom1 span.text2 span').text(parseInt(th.closest('.item1__inner_right_inner_reviews_list1_item').find('.item1__inner_right_inner_reviews_list1_left_custom1 span.text2 span').text()) + 1);
                    $('.item1__inner_right_inner_reviews_list1_right_inner_block1_likes a').removeClass('active');
                    th.addClass('active');
                }
            }
        });
        return false;
    });
    $(document).on('click', '.item1__inner_right_inner_reviews_list1_right_inner_block1_likes .dislike a', function () {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/catalog/ajax/review-dislike",
            data: ({'review_id':th.data('id')}),
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    th.closest('.item1__inner_right_inner_reviews_list1_item').find('.item1__inner_right_inner_reviews_list1_left_custom1 span.text2 span').text(parseInt(th.closest('.item1__inner_right_inner_reviews_list1_item').find('.item1__inner_right_inner_reviews_list1_left_custom1 span.text2 span').text()) - 1);
                    $('.item1__inner_right_inner_reviews_list1_right_inner_block1_likes a').removeClass('active');
                    th.addClass('active');
                }
            }
        });
        return false;
    });
    $(document).on('click', '.item1__inner_right_inner_block2_like a', function () {
        var th = $(this);
        var event;
        th.toggleClass('active');
        if (th.hasClass('active')){
            event = 'like';
        }else{
            event = 'dislike';
        }
            $.ajax({
                type: "POST",
                url: "/catalog/ajax/object-like",
                data: ({'object_id':th.data('id'),'event':event}),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {
                    }
                }
            });
        return false;

    });
    $(document).on('click', '.item1__inner_right_inner_best_choice_list1_block1_custom1_content_text2 a', function (e) {
        var destination = $('.item1__inner_right_inner_reviews').offset().top;
        console.log(destination);
        $('body,html').animate({
            scrollTop: destination
        }, 1000);
        e.preventDefault();
        return false;
    });

    $(document).on('click', '.catalog1__inner_left_filter1_form_list1_items_all a', function () {
        var th = $(this);
        th.parent().parent().find('.catalog1__inner_left_filter1_form_list1_items').toggleClass('all');
        return false;
    });
    $(document).on('change', '.catalog1__inner_left_filter1_form_list1_items_item', function () {
        var th = $(this);
        th.closest('form').submit();
    });
    $(document).on('click', '.item1__inner_right_inner_description1_inner_right_inner_like_bron_now a', function (e) {
        var destination = $('.item1__inner_right_inner_razm').offset().top;
        console.log(destination);
        $('body,html').animate({
            scrollTop: destination -70
        }, 1000);
        e.preventDefault();
        return false;
    });
    $(document).on('click', '.item1__inner_right_inner_razm_inner_body_left_list1 a.home', function () {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/catalog/ajax/home-view",
            data: ({'home_id':th.data('id')}),
            dataType: 'json',
            success: function (response) {
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    var int1 = setInterval(function () {
                        $('.custom-modal7__body_wrap_content').html(response.html);
                        $('.custom-modal7__body_wrap_loader').hide();
                        $('.custom-modal7__body_wrap_content').show();
                        $('.home-slider').slick({
                            prevArrow: '<img class="slick-prev" src="/images/site_images/item/slider1__prev1.png">',
                            nextArrow: '<img class="slick-next" src="/images/site_images/item/slider1__next1.png">',
                        });
                        clearInterval(int1);

                    },2000)

                }
            }
        });
    });
    $('#myModal7').on('hidden.bs.modal', function (e) {
        $('.custom-modal7__body_wrap_content').html('');
        $('.custom-modal7__body_wrap_content').hide();
        $('.custom-modal7__body_wrap_loader').show();
    });
    $(document).on('click', '.catalog1__inner_right_filter1_inner_block1_list1 .price', function (e) {
        $('.catalog1__inner_left_block1_form_hidens input').val('price_asc');
        $('.catalog1__inner_left form').submit();
        e.preventDefault();
        return false;
    });
    $(document).on('click', '.catalog1__inner_right_filter1_inner_block1_list1 .default', function (e) {
        $('.catalog1__inner_left_block1_form_hidens input').val('default');
        $('.catalog1__inner_left form').submit();
        e.preventDefault();
        return false;
    });
    $(document).on('change', '.item1__inner_right_inner_razm_inner_body_left_list1 ul.default select', function () {
        var th = $(this);
        $('.custom-modal6__body_wrap_form_hiddens input[name="home_name"]').val('');
        $('.custom-modal6__body_wrap_form_hiddens input[name="home_count"]').val('');
        $('.custom-modal6__body_wrap_form_hiddens input[name="people_count"]').val(th.val());
        $('.custom-modal6__body_wrap_form_item.razm .custom-modal6__body_wrap_form_item_value').text('Без размещения');
        $('.custom-modal6__body_wrap_form_item.people_count .custom-modal6__body_wrap_form_item_value').text(th.val());
        $('.item1__inner_right_inner_razm_inner_body_left_list1 ul.homes select').val('Выбрать...');
    });

    $(document).on('change', '.item1__inner_right_inner_razm_inner_body_left_list1 ul.homes select', function () {
        var th = $(this);
        $('.custom-modal6__body_wrap_form_hiddens input[name="home_name"]').val(th.closest('ul').find('a.name').text());
        $('.custom-modal6__body_wrap_form_hiddens input[name="home_count"]').val(th.val());
        $('.custom-modal6__body_wrap_form_hiddens input[name="people_count"]').val('');
        $('.custom-modal6__body_wrap_form_item.razm .custom-modal6__body_wrap_form_item_value').text('Дом');
        $('.custom-modal6__body_wrap_form_item.people_count').hide();
        $('.item1__inner_right_inner_razm_inner_body_left_list1 ul.default select').val('Выбрать...');
    });
    $(document).on('click', '.item1__inner_right_inner_razm_inner_body_right_inner_btn,.item1__inner_left_bron1 a', function (e) {

        if (!$('.custom-modal6__body_wrap_form_hiddens input[name="people_count"]').val() && !$('.custom-modal6__body_wrap_form_hiddens input[name="home_name"]').val() ){
            alert('Пожалуйста, выберите тип размещения');
            var destination = $('.item1__inner_right_inner_razm').offset().top;
            $('body,html').animate({
                scrollTop: destination -70
            }, 1000);
        }else{
            $('#myModal6').modal('show');
        }

        e.preventDefault();
        return false;
    });
    $(document).on('submit', '.custom-modal6__body_wrap_form form', function () {
        var th = $(this);
        var data = th.serialize();
        $('.modal6_error').text('');
        $('.modal6_success').text('');
        var btn = th.find('button');
        btn.button('loading');
        $.ajax({
            type: "POST",
            url: "/catalog/ajax/bron",
            data: (data),
            dataType: 'json',
            success: function (response) {
                console.log(response);
                var int1 = setInterval(function () {
                    btn.button('reset')
                    if (response.status == 'error') {
                        $('.modal6_error').text(response.html);
                    } else if (response.status == 'success') {
                        $('.custom-modal6__body_wrap_form input[type="text"]').val('');
                        $('.modal6_success').text(response.html);
                    }
                    clearInterval(int1);
                },2000);
            }
        });
        return false;
    });
    $(document).on('click', '.item1__inner_right_inner_block2_bron', function (e) {
        var destination = $('.item1__inner_right_inner_razm').offset().top;
        console.log(destination);
        $('body,html').animate({
            scrollTop: destination -70
        }, 1000);
        e.preventDefault();
        return false;
    });


})