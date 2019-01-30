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


})(jQuery);
