@extends("layouts.client")
@section("content")

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url("/")}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                @if(Cart::count()>0)
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (cart::content() as $row)
                        <form action="{{route('client.product.cart.update_cart')}}" method="GET">
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>
                                    {{-- {{route('client.product.detail_product',$row->id)}} --}}
                                    <a href="{{route('client.product.detail_product',['id'=>$row->id,'slug'=>Str::slug($row->name)])}}" title="" class="thumb">
                                        <img src="{{$row->options->productThumb}}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('client.product.detail_product',['id'=>$row->id,'slug'=>Str::slug($row->name)])}}" title="" class="name-product">{{$row->name}}</a>
                                </td>
                                <td>{{number_format($row->price,0,',',',')}}đ</td>
                                <td>
                                    {{-- <input type="text" name="num-order" value="1" class="num-order"> --}}
                                    <input type="number" name="num-order[{{$row->rowId}}]" price="{{$row->price}}" rowId="{{$row->rowId}}" min="1" max="10" value="{{$row->qty}}"  url={{route('client.product.cart.update_cart_ajax')}} product_id="{{$row->id}}" class="num-order">
                                </td>
                                <td><span id={{$row->id}} class="subtotal">{{number_format($row->subtotal,0,',',',')}}đ</span></td>
                                <td>
                                    <a href="{{route("client.product.cart.remove_cart",$row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span class="total">{{cart::total(0,',',',').' đ'}}</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <input type="submit" value="Cập nhật giỏ hàng" name="updatecart" id="update-cart">
                                        <a href="{{route("client.product.cart.payment")}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </form>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="{{url("/")}}" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="{{route('client.product.cart.destroy_entire_cart')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
        @else
        <style>
            body{
                overflow: hidden;
            }
            .box{
                min-height: 72px;
                width: auto;
            }
        </style>
        <p class="box bg-light">Không có sản phẩm nào trong giỏ hàng vui lòng ấn <a href="{{url("/")}}">vào đây</a> để mua hàng.</p>
        @endif
    </div>
</div>
@endsection
 