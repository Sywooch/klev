$(function () {
    $(document).on('click','.shop-catalog1_wrap_right_list1_wrap_item_basket a.v_korzine',function(){
        location.href('/cart');
    });
    $(document).on('click','.shop-catalog1_wrap_right_list1_wrap_item_basket a',function(){
        th = $(this);
        $.ajax({
            type: "POST",
            url: "/ajax/addtocart",
            data: ({count: 1,product_id: th.data('id')}),
            success: function (response) {
                th.addClass('v_korzine');
                var result = response.split(',');
                if (result[0]=='success'){
                    console.log(result);
                    $('.header2__wrap_basket_img span ').text(result[2]);
                    $('.header2__wrap_basket_content_sum').text(result[1] + ' р.');
                }
            }
        });
        return false;
    });
})
