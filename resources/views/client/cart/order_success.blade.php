@extends("layouts.client")
@section("content")
<style>
    body{
        font-family: 'Roboto Regular';
        font-size: 14px;
        line-height: 24px;
    }
    #main-wp-content{
        background: #f7f7f7;
        padding-top: 25px;
        padding-bottom: 75px;
    }
    #wp-inner {
        width: 1170px;
        margin: 0px auto;
    }
    #alert-thank-you{
        margin-bottom: 20px;
    }
    .client-info{
        margin-bottom: 20px
    }
    h5{
        font-weight: normal;
        font-size: 100%;
    }
    .info-client-icon{
        display: flex;
    }
    span i.info,span i.cart{
        display: block;
        padding: 0px 3px 0px;
    }
</style>
<div id="main-wp-content">
    <div id="wp-inner">
        <p></p>
        <div id="alert-thank-you">
            <h1 style="color: #f12a43; font-weight:bold; text-align:center;font-size:20px;">CẢM ƠN QUÝ KHÁCH ĐÃ ĐẶT HÀNG
                CỦA CHÚNG TÔI</h1>
            <h3 style="color: #f12a43; font-weight:bold; text-align:center;font-size:15px;">Đơn hàng của bạn đã được
                chúng tôi gửi đến {{$customer[0]->email}} vui lòng vào email của bạn để kiểm tra đơn hàng</h3>
        </div>
        <div class="client-info" style="margin-bottom:20px;">
            <div class="info-client-icon">
                <span><i class="fa fa-info-circle info" aria-hidden="true" ></i></span>
                <h5>Thông tin khách hàng</h5>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$customer[0]->fullname}}</td>
                        <td>{{$customer[0]->address}}</td>
                        <td>{{$customer[0]->email}}</td>
                        <td>{{$customer[0]->phone}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="info-client-icon">
            <span><i class="fa fa-shopping-cart cart" aria-hidden="true"></i></span>
            <h5>Thông tin đơn hàng</h5>
        </div>
        <div class="info-product">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($order as $item) 
                    <tr>
                            <td>{{$item->productName}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{number_format($item->price,0,',',',').'đ'}}</td>
                            <td>{{number_format($item->subtotal,0,',',',').'đ'}}</td>
                    </tr>
                   @endforeach
                   <tr>
                        <td colspan="3">Tổng tiền</td>
                        @php
                            $t=0;
                            foreach ($order as $item) {
                                # code...
                                $t+=$item->subtotal;
                            }
                        @endphp
                        <td>{{number_format($t,0,',',',').'đ'}}</td>
                   </tr>
                </tbody>
            </table>
        </div>
        <div id="turn-home" style="margin-top:20px;text-align:center">
            <button style="background: #f12a43; border: none;color: white;padding: 5px 15px;border-radius: 5px;">
                <p style="text-align: center;margin-bottom:0px">Quay lại <a href="{{url('/')}}" style="text-decoration:none; color:white;">Trang Chủ</a><span style="padding:0px 5px;"><i class="fa fa-backward" aria-hidden="true"></i>
                </span></p>
            </button>
        </div>
    </div>
</div>
@endsection