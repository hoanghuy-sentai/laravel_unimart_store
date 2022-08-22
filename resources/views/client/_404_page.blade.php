@extends("layouts.client")
@section("content")
    <style>
        .box{
            width: auto;
            min-height: 250px;
            padding-left: 95px;
            padding-top: 54px;
        }
    </style>
    <div class="box">
        <p class="bg-light" style="display: flex"><img style="display: block;max-width: 100px" src={{asset('client/public/images/error.png')}}><span style='margin:26px 0px 0px 5px'>Không tìm thấy sản phẩm nào.Ấn vào <a href='{{url('/')}}'>đây</a> để trở về trang chủ</span></p>
    </div>
@endsection