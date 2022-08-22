$(document).ready(function () {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();
    $('#sidebar-menu li.nav-link').find('.none-sub').hide();
    $('#sidebar-menu li.nav-link').click(function () {
        $(this).children('.sub-menu').slideToggle();
        $(this).find('.arrow').toggleClass('fa-angle-right fa-angle-down');
        return true;
    });

    // $('#sidebar-menu .arrow').click(function() {
    //     $(this).parents('li').children('.sub-menu').slideToggle();
    //     $(this).toggleClass('fa-angle-right fa-angle-down');
    // });

    $("input[name='checkall']").click(function () {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
     //ajax excute for order
     $("#ordering_status").change(function(){
        var url=$(this).attr("url");
        var id=$(this).attr("data_id");
        var status=$(this).val();
        var data = { id: id, url: url,status:status };
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
                alert(data);
            }
        })
    });
});