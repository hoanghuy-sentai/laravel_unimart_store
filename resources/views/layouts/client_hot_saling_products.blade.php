<ul class="list-item">
    @foreach ($show_hot_selling_product as $item)
    <li class="clearfix">
        {{-- {{route('client.product.detail_product',['id'=>$item->id,'slug'=>Str::slug($item['productName'])])}} --}}
        <a href="{{route('client.product.detail_product',['id'=>$item['id'],'slug'=>Str::slug($item['productName'])])}}" title=""
            class="thumb fl-left">
            <img src="{{asset($item['productThumb'])}}" alt="">
        </a>
        <div class="info fl-right">
            <a href="{{route('client.product.detail_product',['id'=>$item['id'],'slug'=>Str::slug($item['productName'])])}}" title=""
                class="product-name">{{$item['productName']}}</a>
            <div class="price">
                <span class="new">{{$item['productPrice'].'đ'}}</span>
                <span class="old"></span>
            </div>
            <a href="{{route('client.product.cart.add_cart',$item['id'])}}" title=""
                class="buy-now">Mua ngay</a>
        </div>
    </li>
    @endforeach
</ul>