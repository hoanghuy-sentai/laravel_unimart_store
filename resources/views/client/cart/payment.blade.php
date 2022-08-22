@extends("layouts.client")
@section("content")
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="{{url('client/sendEmail')}}" name="form-checkout">
            @csrf
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ & tên*</label>
                                <input type="text" value="{{old('fullname')}}" required name="fullname" id="fullname">
                                @error('fullname')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email*</label>
                                <input type="email" value="{{old('email')}}" required name="emaill" id="email">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ*</label>
                                <input type="text" value="{{old('address')}}" required name="address" id="address">
                                @error('address')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại*</label>
                                <input type="tel" required pattern="^0[0-9]{9}$" value="{{old('phone')}}" name="phone" id="phone">
                                @error('phone')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú(tùy chọn)</label>
                                <textarea name="note">{{old('note')}}</textarea>
                                @error('note')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $item)
                                    <tr class="cart-item">
                                        <td class="product-name">{{$item->name}}<strong class="product-quantity">x {{$item->qty}}</strong></td>
                                        <td class="product-total">{{number_format($item->subtotal,0,',',',').'đ'}} </td>
                                    </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price">{{cart::total(0,',',',')." đ"}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="Thanh toán khi nhận hàng">
                                <label for="direct-payment">Thanh toán khi nhận hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" checked name="payment-method" value="Giao hàng - Thu tiền (COD)">
                                <label for="payment-home"> Giao hàng - Thu tiền (COD)</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" name="order" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        <form>
    </div>
</div>
@endsection