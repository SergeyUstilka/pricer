;(function ($){

    /* ======================== Clever Search ===================================*/
    $('#search_product').keyup(function (event) {
        event.preventDefault();
        var data = $(this).val();
        var category =$(this).parent().children().eq(2).val()
            // console.log(category);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/clever_search',
            method:'POST',
            data:{patern:data,category:category,_token: $('#signup-token').val()},
            success:function (data) {
                console.log(data);
                var results = JSON.parse(data);
                if(results.length >0){
                    $('#clever_result').css('display','block');
                    var list= "<h4 style='color:#F8694A'>"+results.length+" совпадение:</h4><ul>";
                    for(var i=0; i<results.length; i++){
                        list+='<a href="/product/'+results[i][1]+'/'+results[i][0].slug+'"><li><img src="/storage/img/'+results[i][0].img+'" width="100px;">'+results[i][0].name+'</a></li>';
                    }
                    list+='</ul>'
                    $('#clever_result').html(list);

                    $('#clever_result ul li').click(function () {
                        var product_name = $(this).children().eq(1).html();
                        $('#search_product').val(product_name);
                        $('#clever_result').css('display','none');
                    });
                }else{
                    $('#clever_result').css('display','none');
                }

            },
            error:function(data){
                console.log(data);
            }
        });
    });

    $('#catalog_search_button').click(function (event) {
        event.preventDefault();
        var data = $(this).parent().children().eq(0).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/search',
            method:'POST',
            data:{data:data},
            success:function (data) {
                var products = JSON.parse(data)[0];
                var categories = JSON.parse(data)[1];
                updateCatalogFeed(products, categories)
            },
            error:function (data) {
                console.log(data);
            }
        });
    });
})(jQuery);