$(function () {
    if ($("div").is(".alert-success")) {
        setTimeout(function () {
            $('.alert-success').fadeOut('fast')
        }, 3000);  //30000 = 30 секунд
    }
    if ($("input").is("#modarendaregions-name")) {
        $("#modarendaregions-name").focus();
    }
    $(document).on('click', '.custom_tree_ul .custom_tree_glyph', function () {
        var th = $(this);
        var id = th.parent().data('id');
        th.parent().toggleClass('show');
            $.ajax({
                type: "POST",
                url: "admin/city-list1",
                data: ({'region_id':id}),
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'error') {
                    } else if (response.status == 'success') {
                        th.parent().find('>ul .content').html(response.html);
                    }
                }
            });
        return false;

    });
});
