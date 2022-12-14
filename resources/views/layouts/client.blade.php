
<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('public/uploads/bag-shopping-solid.svg')}}" />
    <link href="{{asset("client/public/css/bootstrap/bootstrap-theme.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/css/bootstrap/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/reset.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/css/carousel/owl.carousel.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/css/carousel/owl.theme.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/css/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/style.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("client/public/responsive.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="{{asset("client/public/js/jquery-2.2.4.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("client/public/js/elevatezoom-master/jquery.elevatezoom.js")}}" type="text/javascript"></script>
    <script src="{{asset("client/public/js/bootstrap/bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("client/public/js/carousel/owl.carousel.js")}}" type="text/javascript"></script>
    <script src="{{asset("client/public/js/main.js")}}" type="text/javascript"></script>
    <script src="{{asset("client/public/js/custom.js")}}" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{route('client.page_contract')}}" title="" id="payment-link"  class="fl-left">H??nh th???c thanh to??n</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{url('/')}}" title="">Trang ch???</a>
                                </li>
                                <li>
                                    <a href="{{route("client.products")}}" title="">S???n ph???m</a>
                                </li>
                                <li>
                                    <a href="{{route('client.blog.list')}}" title="">B??i vi???t</a>
                                </li>
                                <li>
                                    <a href="{{route('client.page_intro')}}" title="">Gi???i thi???u</a>
                                </li>
                                <li>
                                    <a href="{{route('client.page_contract')}}" title="">Li??n h???</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- {{asset('')}} --}}
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{url('/')}}" title="" id="logo" class="fl-left"><img src="{{asset('client/public/images/logo.png')}}" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="{{route('client.query')}}">
                                <input type="text" name="q" id="s" placeholder="Nh???p t??? kh??a t??m ki???m t???i ????y!">
                                <button type="button" id="sm-s">T??m ki???m</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">T?? v???n</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="{{route("client.product.cart.show_cart")}}" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{route("client.product.cart.show_cart")}}" style="color: white"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <span id="num">{{Cart::count()}}</span>
                                </div>
                                <div id="dropdown" style="min-height: 100px">
                                    <p class="desc">C?? <span>{{cart::count()}} s???n ph???m</span> trong gi??? h??ng</p>
                                    <ul class="list-cart">
                                        @foreach (cart::content() as $item)
                                            @if(cart::count()>0)
                                            <li class="clearfix">
                                                {{-- {{route('client.product.detail_product')}} --}}
                                                <a href="{{route('client.product.detail_product',['id'=>$item->id,'slug'=>Str::slug($item->name)])}}" title="" class="thumb fl-left">
                                                    <img src="{{asset($item->options->productThumb)}}" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title="" class="product-name">{{$item->name}}</a>
                                                    <p class="price">{{number_format($item->price,0,',',',').'??'}}</p>
                                                    <p class="qty">S??? l?????ng: <span>{{$item->qty}}</span></p>
                                                </div>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @if(cart::count()>0)
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">T???ng:</p>
                                            <p class="price fl-right">{{cart::total()}}??</p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="{{route("client.product.cart.show_cart")}}" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                            <a href="{{route("client.product.cart.payment")}}" title="Thanh to??n" class="checkout fl-right">Thanh
                                                to??n</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end header --}}
            <div id="wp-content">
                @yield("content")
            </div>
            {{-- footer --}}
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">ISMART</h3>
                            <p class="desc">ISMART lu??n cung c???p lu??n l?? s???n ph???m ch??nh h??ng c?? th??ng tin r?? r??ng, ch??nh
                                s??ch ??u ????i c???c l???n cho kh??ch h??ng c?? th??? th??nh vi??n.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="{{asset('client/public/images/img-foot.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Th??ng tin c???a h??ng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>106 - Tr???n B??nh - C???u Gi???y - H?? N???i</p>
                                </li>
                                <li>
                                    <p>0987.654.321 - 0989.989.989</p>
                                </li>
                                <li>
                                    <p>vshop@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Ch??nh s??ch mua h??ng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy ?????nh - ch??nh s??ch</a>
                                </li>
                                <li>
                                    <a href="" title="">Ch??nh s??ch b???o h??nh - ?????i tr???</a>
                                </li>
                                <li>
                                    <a href="" title="">Ch??nh s??ch h???i vi???n</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao h??ng - l???p ?????t</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">B???ng tin</h3>
                            <p class="desc">????ng k?? v???i ch??ng t??i ????? nh???n ???????c th??ng tin ??u ????i s???m nh???t</p>
                            <div id="form-reg">
                                <form id='frm' method="GET" action="#">
                                    <input type="email" name="email"  id="email" placeholder="Nh???p email t???i ????y">
                                    <button type="submit" id="sm-reg">????ng k??</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">?? B???n quy???n thu???c v??? unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang ch???</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>??i???n tho???i</a>
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
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Nokia</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title>M??y t??nh b???ng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>????? d??ng sinh ho???t</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Li??n h???</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="btn-top"><img src="{{asset('client/public/images/icon-to-top.png')}}" alt="" /></div>
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
        </script>
</body>

</html>