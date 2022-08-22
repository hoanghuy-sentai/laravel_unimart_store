@extends("layouts.client")
@section("content")
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- @php
            echo "<pre>";
            print_r($productcats);
            echo "</pre>";
        @endphp --}}
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                @foreach ($productcats as $item)
                    @if($item['parent_id']==0)
                        <div class="section-head">
                            <a href="{{route('client.product.product_cat',$item['id'])}}"> <h3 class="section-title">{{$item['productcatName']}}</h3></a>
                        </div>
                        @php
                        $i=0;
                        @endphp
                         <div class="section-detail">
                            <ul class="list-item clearfix">
                                @foreach ($productcats as $value)
                                    @if($value['parent_id']==$item['id'])
                                            @foreach ($products as $val)
                                            @if ($val->productcat_id==$value['id'])
                                                @if ($i<4) 
                                                    <li>
                                                        <a href="{{route('client.product.detail_product',['id'=>$val->id,'slug'=>Str::slug($val['productName'])])}}" title="" class="thumb">
                                                            <img src="{{asset($val->productThumb)}}">
                                                        </a>
                                                        <a href="{{route('client.product.detail_product',['id'=>$val->id,'slug'=>Str::slug($val['productName'])])}}"" title="" class="product-name">{{$val->productName}}</a>
                                                        <div class="price">
                                                            <span class="new">{{number_format($val['productPrice'],0,',',',')}}đ</span>
                                                            {{-- <span
                                                                class="old">{{number_format($item['productOldPrice'],0,',',',')?$item['productOldPrice']>0:""}}đ</span>
                                                            --}}
                                                        </div>
                                                    </li>
                                                @endif
                                                @php
                                                $i++;
                                                @endphp
                                            @endif
                                        @endforeach 
                                    @endif
                                @endforeach
                         </ul>
                     </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    @include("layouts.client_hot_saling_products")
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection