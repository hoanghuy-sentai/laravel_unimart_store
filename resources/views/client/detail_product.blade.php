@extends("layouts.client")
@section("content")
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    @foreach ($fullPathBreakCum as $key=>$item)
                        <li>
                            {{-- {{$k=str_replace("k",'',$key)}} --}}
                            <a href="{{route("client.product.product_cat",str_replace("k",'',$key))}}" title="">{{$fullPathBreakCum[$key]}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="#" title="" id="main-thumb">
                            <img id="zoom" src="{{asset($product[0]->productThumb)}}" width='350px' height='350px' data-zoom-image="{{str_replace('350x350','700x700',$product[0]->productThumb)}}"/>                 
                        </a>
                        <div id="list-thumb">
                            @if ($product[0]->productDetailThumb!=null)
                                @foreach (explode(',',$product[0]->productDetailThumb) as $key=>$item)
                                   <a href="" data-image="{{asset($item)}}"  data-zoom-image="{{str_replace('350x350','700x700',asset($item))}}">
                                       <img id="zoom" width="50px" height="50px" src="{{asset($item)}}"  />
                                   </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{$product[0]->productName}}</h3>
                        <div class="desc">
                            {!!$product[0]->productShortDesc!!}
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">{{$product[0]->productQty>0?"Còn hàng":'Hết hàng'}}</span>
                        </div>
                        @if ($product[0]->productQty>0)
                            <p class="price">{{number_format($product[0]->productPrice,0,',',',')}}đ</p>
                            <input type="hidden" value="{{$product[0]->productPrice}}" id='price_hd'>
                            <a href="{{route('client.product.cart.add_cart',$product[0]->id)}}" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a> 
                        @endif
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title" id='choose'>Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail product-content">
                     {!! $product[0]->productDesc !!}
                     {{-- style="left: 384.5px; display: none;"  --}}
                     <a class="extend-content" style="cursor:pointer">Xem thêm <span>↓</span></a>
                     <a class="collapse-content" style="cursor:pointer">Thu gọn <span>↑</span></a>
                     <div class="opacity"></div>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                @if(count($products_to_show)>0)
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                            @foreach ($products_to_show as $item) 
                                <li>
                                    <a href="{{route('client.product.detail_product',['id'=>$item->id,'slug'=>Str::slug($item['productName'])])}}" title="" class="thumb">
                                        <img src="{{$item->productThumb}}">
                                    </a>
                                    <a href="{{route('client.product.detail_product',['id'=>$item->id,'slug'=>Str::slug($item['productName'])])}}" title="" class="product-name">{{$item->productName}}</a>
                                    <div class="price">
                                        <span class="new">{{number_format($item['productPrice'],0,',',',')}}đ</span>
                                        <span class="old">{{number_format($item['productOldPrice'],0,',',',').'đ'?$item['productOldPrice']>0:""}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    @include("layouts.client_slidebar_categories")
                    @php
                        echo "<ul class='list-item'>";
                        data_tree($productcats);
                        echo "<ul>";
                    @endphp
                    {{-- <ul class="list-item">
                        <li>
                            <a href="?page=category_product" title="">Điện thoại</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=category_product" title="">Iphone</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Samsung</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="?page=category_product" title="">Iphone X</a>
                                        </li>
                                        <li>
                                            <a href="?page=category_product" title="">Iphone 8</a>
                                        </li>
                                        <li>
                                            <a href="?page=category_product" title="">Iphone 8 Plus</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Oppo</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Bphone</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Máy tính bảng</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">laptop</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Tai nghe</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Thời trang</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Đồ gia dụng</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Thiết bị văn phòng</a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        {{-- <img src="public/images/banner.png" alt=""> --}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection