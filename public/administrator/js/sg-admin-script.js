;(function ($){


//    ============   Ajax deleting  ===============


    $('.delete-data').click(function (event) {
        console.log($(this));
        event.preventDefault();
        var url = $(this).data('url');
        var row = $(this).closest('tr');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            method: 'DELETE',
            success: function () {
                row.css('display', 'none');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });


    $('.activate-csv').click(function (event) {
        event.preventDefault();
        var url = $(this).data('url');
        var csv_name = $(this).data('csv');
        var csv_id= $(this).data('csv_id');
        var activeStatusBlock = $(this).parent().parent().children().eq(4);
        var disactiveStatusButton = $(this).parent().parent().children().eq(6).children().eq(0);
        var activeStatusButton = $(this).parent().parent().children().eq(6).children().eq(1);
        var shop_id = $(this).data('shop');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            data:{csv:csv_name,shop:shop_id, csv_id:csv_id},
            success: function (data) {
                activeStatusBlock.html(1);
                disactiveStatusButton.removeClass('hidden');
                activeStatusButton.addClass('hidden');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('.disactivate-csv').click(function (event) {
        event.preventDefault();
        var url = $(this).data('url');
        var csv_id= $(this).data('csv_id');
        var activeStatusBlock = $(this).parent().parent().children().eq(4);
        var disactiveStatusButton = $(this).parent().parent().children().eq(6).children().eq(0);
        var activeStatusButton = $(this).parent().parent().children().eq(6).children().eq(1);
        var shop_id = $(this).data('shop');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            data:{csv_id:csv_id},
            success: function (data) {
                console.log(data);
                activeStatusBlock.html(0);
                disactiveStatusButton.addClass('hidden');
                activeStatusButton.removeClass('hidden');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });


})(jQuery);
