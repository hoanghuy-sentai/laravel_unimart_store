$(document).ready(function () {
    // SELECT SORT
    // $("select[name=sort-by]").change(function () {
    //     var sort_by = $(this).val();
    //     $("#sort-now").submit();
    // })


    var middle_outer_width_product_content = $(".product-content").outerWidth() / 2;
    var middle_outer_width_extend_content = $(".extend-content").outerWidth() / 2;
    var position_left = middle_outer_width_product_content - middle_outer_width_extend_content;
    $("a.extend-content").css('left', position_left);
    $("a.collapse-content").css('left', position_left);
    $('a.extend-content').click(function () {
        $(".product-content").addClass('max-height-none');
        $(".opacity").hide();
        $('a.extend-content').hide();
        $('a.collapse-content').show();
        return false;
    })

    $('a.collapse-content').click(function () {
        $(".product-content").removeClass('max-height-none');
        $(".opacity").show();
        $('a.extend-content').show();
        $('a.collapse-content').hide();
        return false;

    })
    //Execute ajax product cart part
    // $("#num-order-wp").click(function () {
    //     var price = $("#price_hd").val();
    //     var qty = $("#num-order").val();
    //     var total = price * qty;
    //     var url=$(this).attr("url");
    //     var id_of_product=$(this).attr("id_of_product");


    //     var value = (total).toLocaleString(
    //         undefined, // leave undefined to use the visitor's browser
    //         // locale or a string like 'en-US' to override it.
    //         // { minimumFractionDigits: 2 }
    //     );
    //     $(".price").text(value + "đ");


    //     var data={id_of_product:id_of_product,qty:qty,url:url,price:price};
    //     $.ajax({
    //         url:url,
    //         method:'GET',
    //         data:data,
    //         dataType:'text',
    //         success:function(data){
    //             // $("#result").html("<strong>Năm nay bạn "+data+" tuổi.</strong>");
    //         //    console.log(data);
    //             $(".num-order").text(data.qty);
    //             $("#"+data.id_of_product).html(data.subtotal+"đ");
    //             $(".total").html(data.total+" Đ");
    //         console.log(data);
    //         }
    //     })

    // });

    //auto reload web wen back(I should use ajax to cusmer don't show old side first)
    // window.addEventListener("pageshow", function (event) {
    //     var historyTraversal = event.persisted ||
    //         (typeof window.performance != "undefined" &&
    //             window.performance.navigation.type === 2);
    //     if (historyTraversal) {
    //         // Handle page restore.
    //         window.location.reload();
    //     }
    // });
    // if(performance.navigation.type == 2){
    //     location.reload(true);
    //  }
    $("#sm-s").click(function () {
        var s = $("#s").val();
        if (s.length <= 3) {
            // alert("Ok");
            $("#sm-s").attr("type", "button");
            $("#sm-s").removeAttr("typle", "submit");
        }
        else {
            $("#sm-s").attr("type", "submit");
        }
    })

    var el = document.getElementById("s");
    el.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            // alert(event.key  + " " + event.which);
            // event.preventDefault();
            var s = $("#s").val();
            if (s.length <= 3) {
                // alert("Ok");
                $("#sm-s").attr("type", "button");
                $("#sm-s").removeAttr("typle", "submit");
                event.preventDefault();
            }
            else {
                $("#sm-s").attr("type", "submit");
            }
        }
    });

    //apply ajax to update cart without upload the page
    $(".num-order").change(function () {
        var id = $(this).attr("product_id");
        // alert(id);
        var qty = $(this).val();
        var url = $(this).attr("url");
        var rowId = $(this).attr("rowId");
        var price = $(this).attr("price");
        var data = { id: id, qty: qty, url: url, rowId: rowId, price: price };
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (data) {
                // $("#result").html("<strong>Năm nay bạn "+data+" tuổi.</strong>");
                console.log(data);
                $(".num-order").text(data.qty);
                $("#" + data.id).html(data.subtotal + "đ");
                $(".total").html(data.total + " Đ");
            }
        })
    })

    //reload page when press back

    window.addEventListener("pageshow", function (event) {
        var historyTraversal = event.persisted ||
            (typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2);
        if (historyTraversal) {
            // Handle page restore.
            // window.location.reload();
            // var qty_cart=$("#qty_cart").text();
            // this.alert(qty_cart);
        }
    });
    //no load 'sắp xếp' filter
    $("#btn_arrangement-filter").click(function(){
       var value_of_select=  $("select#arrangement-filter").val();
       if(value_of_select==0)
            return false;
    })
    //apply ajaxt in show cart status
    // $("#icon-cart").click(function(){
    //     alert("OK");
    // })
    //ajax excute for filter of price price_filter
    $(".price_filter").click(function () {
        var url=$(this).attr("url");
        var value=$(this).attr("data-value");
        var data={url:url,value:value}
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            dataType: 'text',
            success: function (data) {
                // $("#result").html("<strong>Năm nay bạn "+data+" tuổi.</strong>");
                // console.log(data);
                // $(".num-order").text(data.qty);
                // $("#" + data.id).html(data.subtotal + "đ");
                // $(".total").html(data.total + " Đ");
                alert("ok");
            }
        })
    })
//when click subcriber 
    $("#frm").submit(function(){
        alert("Cảm ơn bạn đã đăng ký!");
        // $(this).val('');
    })

})

