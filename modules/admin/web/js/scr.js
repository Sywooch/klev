$(function () {
    $(document).on('click','.obrat-fields-form__values a.add',function(){
        th = $(this);
        $.ajax({
            type: "POST",
            url: "/ajax/obrat-add-field",
            data: ({}),
            dataType: 'json',
            success: function (response) {
                if (response['status']=='success'){
                    $('.obrat-fields-form__values_content').append(response['html']);
                    }
            }
        });
        return false;
    });
    $(document).on('click', '.obrat-fields-form__values_content_field a', function () {
        if (confirm('Вы уверены?')){
            var th = $(this);
            $.ajax({
                type: "POST",
                url: "/ajax/obrat-delete-value",
                data: ({'value_id':th.data('id')}),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {
                        th.closest('.row').fadeOut('fast');
                        setTimeout(function() {th.closest('.row').remove()}, 1000);
                    }
                }
            });
        }
        return false;
    });
    $(document).on('change', '.field-obratfields-type select', function () {
        var th = $(this);
        if (th.val()=='select' || th.val()=='checkbox' || th.val()=='radio'){
            $('.obrat-fields-form__values').addClass('show');
        }else{
            $('.obrat-fields-form__values').removeClass('show');
        }
    });
    $(document).on('click','.objects-form__values a.add',function(){
        th = $(this);
        $.ajax({
            type: "POST",
            url: "/ajax/objects-add-field",
            data: ({}),
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response['status']=='success'){
                    $('.objects-form__values_content').append(response['html']);
                }
            }
        });
        return false;
    });
    $(document).on('click','.add_char_data',function(){
        html = '<div class="form-group"> <p> <label> <input type="text" class="form-control" name="characteristics_data[]" placeholder="Опция"></label><label><input type="text" class="form-control" name="characteristics_data_sort[]" placeholder="Сортировка"></label> </p> </div>';
        $('.characteristics-form .inputs').append(html);
        return false;
    });
    $(document).on('change','.characteristics-form .type',function(){
        if ($(this).val()!=0){
            $('.navtab1 .options').show();
        }else{
            $('.navtab1 .options').hide();
        }
    });
    $(document).on('click','#attributesList option',function(e){
        e.preventDefault();
        th = $(this);
        th.remove();
        $('#attributes').append(th);
        return false;
    });

    $(document).on('click','#attributes option',function(e){
        e.preventDefault();
        th = $(this);
        th.remove();
        $('#attributesList').append(th);
        return false;
    });
    $(document).on('click','.cats_down',function(){
        th = $(this);
        th.addClass('cats_up').removeClass('cats_down');
        th.parent().find('>ul').removeClass('closed');
        th.find('>span.glyphicon').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
        return false;
    });
    $(document).on('click','.cats_up',function(){
        th = $(this);
        th.addClass('cats_down').removeClass('cats_up');
        th.parent().find('>ul').addClass('closed');
        th.find('>span.glyphicon').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
        return false;
    });

    $('.cats>ul').removeClass('closed');
    $('.product-types-update button[type="submit"]').click(function(){
        $('.product-types-update #attributes').children('option').prop('selected', true);
    });
    $(document).on('submit','.product_sort_form',function(){
        th = $(this);
        data = th.serialize();
        $.ajax({
            type: "POST",
            url: "/ajax/productsort",
            data: (data),
            success: function (response) {
                if (response=='success'){
                    th.find('p').text('Сохранено!').addClass('green');
                }
            }
        });
        return false;
    });
    $(document).on('click','#attributesList option',function(e){
        e.preventDefault();
        th = $(this);
        th.remove();
        $('#attributes').append(th);
        return false;
    });

    $(document).on('click','#attributes option',function(e){
        e.preventDefault();
        th = $(this);
        th.remove();
        $('#attributesList').append(th);
        return false;
    });
    $('.site-cats_update_form button[type="submit"]').click(function(){
        $('.site-cats_update_form #attributes').children('option').prop('selected', true);
    });

    $('.admin-update-products__cats input[type="radio"]:checked').parents('li').find('>a').addClass('cats_up').removeClass('cats_down');
    $('.admin-update-products__cats input[type="radio"]:checked').parents('li').find('>a span.glyphicon').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
    $('.admin-update-products__cats input[type="radio"]:checked').parents('ul.closed').removeClass('closed');

    $(document).on('change', '.admin-update-products__cats .adminradio', function () {
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "/ajax/get-characteristics-for-cat",
            data: ({'cat_id':th.val(),'product_id':$('.tab-pane#characteristics').data('product_id')}),
            dataType: 'json',
            success: function (response) {
                if (response.status == 'error') {
                } else if (response.status == 'success') {
                    $('.tab-pane#characteristics').html(response.html);
                }
            }
        });
    });
    if ($("div").is(".alert-success")) {
        setTimeout(function () {
            $('.alert-success').fadeOut()
        }, 6000);
    }

})