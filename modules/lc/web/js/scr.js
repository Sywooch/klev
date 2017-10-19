$(function () {
    $(document).on('click', '.lc-index-right__informers_right_calendar_right_blizh_list1_item_caret a', function () {
        var th = $(this);
        th.closest('.lc-index-right__informers_right_calendar_right_blizh_list1_item').toggleClass('active');
        th.closest('.lc-index-right__informers_right_calendar_right_blizh_list1_item').find('ul').slideToggle('fast');
        return false;
    });
    $(document).on('click', '.lc-index-right__informers_left_add_block1_list1_item_info2_list1_item_title_caret .img,.lc-index-right__informers_left_add_block1_list1_item_info2_list1_item_title_name a', function () {
        var th = $(this);
        th.closest('.lc-index-right__informers_left_add_block1_list1_item_info2_list1_item').toggleClass('active');
        th.closest('.lc-index-right__informers_left_add_block1_list1_item_info2_list1_item').find('ul').slideToggle('fast');
        return false;
    });
    $(document).on('click', '.lc-index-right__informers_right_add_block1_list1_item_title a', function () {
        var th = $(this);
        th.closest('.lc-index-right__informers_right_add_block1_list1_item').toggleClass('active');
        th.closest('.lc-index-right__informers_right_add_block1_list1_item').find('.lc-index-right__informers_right_add_block1_list1_item_content').slideToggle('fast');
        return false;
    });
    $('.lc-index-right__informers_right_add_block1_list1_item.active').find('.lc-index-right__informers_right_add_block1_list1_item_content').slideToggle('fast');

    $(document).on('click', '.default-add_form_homes_title .img a,.default-add_form_homes_title .text a', function () {
        var th = $(this);
        th.closest('.default-add_form_homes').toggleClass('active');
        return false;
    });
    $(document).on('click', '.default-add_form_homes_content_files_current_content_list1_item_close a', function () {
        var th = $(this);
        th.parent().parent().fadeOut();
        if (confirm('Вы уверены?')){
            $.ajax({
                type: "POST",
                url: "ajax/del-photo1",
                data: ({'image_id':th.data('id')}),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {

                    }
                }
            });
        }
        return false;
    });
    $(document).on('click', '.lc-index-right__informers_right_add_block1_list1_item_content_form_current_photos_content_item_close a', function () {
        var th = $(this);
        th.parent().parent().fadeOut();
        if (confirm('Вы уверены?')){
            $.ajax({
                type: "POST",
                url: "ajax/del-photo2",
                data: ({'image_id':th.data('id')}),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {

                    }
                }
            });
        }
        return false;
    });

    $(document).on('click', '.default-add_form_homes_content_room_count .plus', function () {
        var th = $(this);
        input_val = $(th).parent().find('input').val();
        if (parseInt(input_val) < 100) {
            new_val = parseInt(input_val) + 1;
            if (new_val) {
                $(th).parent().find('input').val(new_val);
            }
        }
        return false;
    });
    $(document).on('click', '.default-add_form_homes_content_room_count .minus', function () {
        var th = $(this);
        input_val = $(th).parent().find('input').val();
        if (parseInt(input_val) > 1) {
            new_val = parseInt(input_val) - 1;
            if (new_val) {
                $(th).parent().find('input').val(new_val);
            }
        }
        return false;
    });
    $('.lc-index-right__informers_right_add_block1_list1_item_content_item.new #isphomes-room_counts').val('1');
    $('.lc-index-right__informers_right_add_block1_list1_item_content_item.new #isphomes-people_counts').val('5');
    $(document).on('click', '.lc-index-right__informers_left_add_block1_list1_item_info1_content_actions1_delete .text a', function () {
        var th = $(this);
        if (confirm('Вы уверены?')){
            th.closest('.lc-index-right__informers_left_add_block1_list1_item').fadeOut('slow');
            $.ajax({
                type: "POST",
                url: "ajax/del-object1",
                data: ({'object_id':th.data('id')}),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {
                    }
                }
            });
        }
        return false;
    });

    $('.lc_mh5').matchHeight();

    $(document).on('click', '.lc-right__block2_profile_right_info1_form_photo_actions a', function () {
        var th = $(this);
        if (confirm('Вы уверены?')){
            $.ajax({
                type: "POST",
                url: "/lc/ajax/photo-del1",
                data: ({}),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {
                    }
                }
            });
        }

        return false;
    });
    $(document).on('click', '.lc-index-right__informers_right_title_btn.edit button', function (e) {
        e.preventDefault();
        $('#map').html('');
        $('.lc-index-right__informers_right_add_block1_list1_item_content.pjax1 form button:submit').trigger('click');
        $('.lc-index-right__informers_right_add_block1_list1_item_content.pjax2 form button:submit').trigger('click');
        return false;
    });
    $(document).on('click', '.lc-index-right__informers_right_title_btn.add button', function (e) {
        e.preventDefault();
        $('.lc-index-right__informers_right_add_block1_list1_item_content form button:submit').trigger('click');
        return false;
    });
    $(document).on('click', '.default-add_form_homes_title span.img2 a', function () {
        var th = $(this);
        th.closest('.lc-index-right__informers_right_add_block1_list1_item_content_item').fadeOut();
        if (confirm('Вы уверены?')){
            $.ajax({
                type: "POST",
                url: "ajax/del-home1",
                data: ({'home_id':th.data('id')}),
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {

                    }
                   }
            });
        }
        return false;
    });

    $(document).on('click', '.lc-index-right__informers_right_add_block1_list1_item_content_item_title a', function () {
        $(this).parent().parent().find('.default-add_form_homes').slideToggle('fast');
        return false;
    });
    $(document).on('click', '.lc-index-right__informers_right_calendar_right_actual_list1_item_actions a.view,.lc-index-right__informers_right_calendar_right_blizh_list1_item a.view,.reserve-eye1', function () {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/lc/ajax/view-bron1",
            data: ({'bron_id':th.data('id')}),
            dataType: 'json',
            success: function (response) {
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    var int1 = setInterval(function () {
                        $('.custom-modal8__body_wrap_loader').hide();
                        $('.custom-modal8__body_wrap_content').html(response.html);
                        clearInterval(int1);
                    },2000)

                }
            }
        });
    });
    $(document).on('click', '.reserve-edit1', function () {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/lc/ajax/edit-bron1",
            data: ({'bron_id':th.data('id')}),
            dataType: 'json',
            success: function (response) {
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    var int1 = setInterval(function () {
                        $('.custom-modal8__body_wrap_loader').hide();
                        $('.custom-modal8__body_wrap_content').html(response.html);
                        clearInterval(int1);
                    },2000)

                }
            }
        });
    });
    $('#myModal8').on('hidden.bs.modal', function (e) {
        $('.custom-modal8__body_wrap_content').html('');
        $('.custom-modal8__body_wrap_loader').show();
    });
    $(document).on('click', '.lc-index-right__informers_left_block1_past_list1>ul>li>.arrow a', function () {
        var th = $(this);
        th.closest('li').toggleClass('active');
        return false;
    });
    $(document).on('submit', '#edit-bron1', function (e) {
        var th = $(this);
        var data = th.serialize();
        var btn = th.find('button');
        btn.button('loading');
        $.ajax({
            type: "POST",
            url: "/lc/ajax/reserve-form-edit1",
            data: (data),
            dataType: 'json',
            success: function (response) {
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    btn.button('reset');
                    $('.custom-alert4').fadeIn('slow');
                    var int = setInterval(function () {
                        location.reload();
                        clearInterval(int);
                    },1000)
                }
            }
        });
        console.log('asd');
        return false;
    });



})