@extends("layouts.client")
@section("content")
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                @php
                   
                @endphp
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>  
                    @foreach ($breakcum as $key=>$item)
                    <li>
                        <a href="{{route("client.product.product_cat",str_replace("k",'',$key))}}" title="">{{$breakcum[$key]}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Danh sách sản phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">
                            {{-- Hiển thị 45 trên 50 sản phẩm --}}
                            @php
                                $total=0;
                            @endphp

                            @foreach ($products as $item)
                                @php
                                    $total=$total+1;
                                @endphp               
                            @endforeach
                            Tìm thấy {{$total}} trên tổng sổ sản phẩm
                        </p>
                        @php
                            $t=0;
                        @endphp
                        @foreach ($products as $item)
                        @php  $t=$t+1; @endphp
                        @endforeach
                        @if ($t>4)
                        <div class="form-filter">
                            <form method="GET" id="arrangement-filter" action="{{route('client.product.client.filter2')}}">
                                <select id="arrangement-filter" name="option">
                                    <option value="0">Sắp xếp</option>
                                    <option value="tu-a-z">Từ A-Z</option>
                                    <option value="tu-z-a">Từ Z-A</option>
                                    <option value="tu-cao-xuong-thap">Giá cao xuống thấp</option>
                                    <option value="tu-thap-xuong-cao">Giá thấp lên cao</option>
                                </select>
                                <button id="btn_arrangement-filter" type="submit">Lọc</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($products as $product)
                            <li>
                                <a href="{{route('client.product.detail_product',['id'=>$item->id,'slug'=>Str::slug($item['productName'])])}}" title="" class="thumb">
                                    <img src="{{asset($product->productThumb)}}">
                                </a>
                                <a href="{{route('client.product.detail_product',['id'=>$item->id,'slug'=>Str::slug($item['productName'])])}}" title="" class="product-name">{{strlen($product->productName)>25?Str::of($product->productName)->substr(0,22)."...":$product->productName}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($product->productPrice,0,',',',')}}đ</span>
                                    <span class="old">{{$product->productOldPrice==0?"":$product->productOldPrice."đ"}}</span>
                                </div>
                            </li>       
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    {{-- <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul> --}}
                    {{-- {{$products->links();}} --}}
                </div>
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
                </div>
            </div>
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="GET" action="{{route('client.product.client.filter2')}}">
                        <table>
                            @include("layouts.client_price_filter")
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection