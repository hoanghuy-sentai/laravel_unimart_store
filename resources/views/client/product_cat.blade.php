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
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">{{$productcat[0]->productcatName}}</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">
                            {{-- Hiển thị 45 trên 50 sản phẩm --}}
                            @php
                                $total=0;
                            @endphp
                            @foreach ($products as $product)
                                @foreach ($parent_id_product as $k=> $item)
                                    @if ($parent_id_product[$k]==$product['productcat_id'])
                                           @php
                                               $total=$total+1;
                                           @endphp
                                    @endif
                                @endforeach
                            @endforeach

                            @foreach ($products as $item)
                                @if ($item['productcat_id']==$id)
                                    @php
                                        $total=$total+1;
                                    @endphp
                                @endif
                            @endforeach
                            Hiển thị {{$total}} trên tổng sổ sản phẩm
                        </p>
                        @php
                            $t=0;
                        @endphp
                        @foreach ($displayProduct as $item)
                           @php  $t=$t+1; @endphp
                        @endforeach
                        @if ($t>4)
                        <div class="form-filter">
                            <form method="POST" action="{{route("client.product.product_cat.arrangement_filter",$id)}}">
                                @csrf
                                <select id="arrangement-filter" name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="A-Z">Từ A-Z</option>
                                    <option value="Z-A">Từ Z-A</option>
                                    <option value="hightPriceToLowPrice">Giá cao xuống thấp</option>
                                    <option value="lowPriceToHightPrice">Giá thấp lên cao</option>
                                </select>
                                <button id="btn_arrangement-filter" type="submit">Lọc</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="section-detail">
                    @php
                        // echo "<pre>";
                        // print_r($displayProduct);
                        // echo "</pre>";
                    @endphp
                    <ul class="list-item clearfix" style="display:flex;justify-content: flex-start;flex-wrap: wrap;align-content: flex-end;">
                        @php
                            $i=0;
                        @endphp
                        @foreach ($displayProduct as $item)
                            @php
                                $i=$i+1; 
                            @endphp
                            <li>
                                <a href="{{route('client.product.detail_product',['id'=>$item['id'],'slug'=>Str::slug($item['productName'])])}}" title="" class="thumb">
                                    <img src="{{asset($item['productThumb'])}}">
                                </a>
                                <a href="{{route('client.product.detail_product',['id'=>$item['id'],'slug'=>Str::slug($item['productName'])])}}" title="" class="product-name">{{strlen($item['productName'])>25?Str::of($item['productName'])->substr(0,22)."...":$item['productName']}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item['productPrice'],0,',',',')}}đ</span>
                                    <span class="old">{{$item['productOldPrice']==0?"":$item['productOldPrice']."đ"}}</span>
                                </div>
                            </li>  
                        @endforeach
    

                        @foreach ($products as $product)
                        @if ($product['productcat_id']==$id)
                            <li>
                                <a href="{{route('client.product.detail_product',['id'=>$product['id'],'slug'=>Str::slug($product['productName'])])}}" title="" class="thumb">
                                    <img src="{{asset($product->productThumb)}}">
                                </a>
                                <a href="{{route('client.product.detail_product',['id'=>$product->id,'slug'=>Str::slug($product['productName'])])}}" title="" class="product-name">{{strlen($product->productName)>25?Str::of($product->productName)->substr(0,22)."...":$product->productName}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($product->productPrice,0,',',',')}}đ</span>
                                    <span class="old">{{$product->productOldPrice==0?"":$product->productOldPrice."đ"}}</span>
                                </div>
                               
                            </li>
                        @endif
                        @endforeach
                    </ul>
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
                    <form method="POST" action="{{route("client.product.product_cat.price_filter",$id)}}">
                        <table>
                            @csrf
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
</div>
@endsection