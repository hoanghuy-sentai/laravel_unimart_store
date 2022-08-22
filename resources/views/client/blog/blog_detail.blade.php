@extends("layouts.client")
@section("content")
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('client.blog.list')}}" title="">Blog</a>
                    </li>
                    <li>
                        <a href="{{route('client.blog.cat',$post[0]->postcat->id)}}" title="">{{$post[0]->postcat->catName}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">{{$post[0]->postTitle}}</h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">{{$post[0]->postTime}}</span>
                    <div class="detail">
                        {{-- <p><strong>Elon Musk nghĩ rằng các công ty lưới điện không có gì phải lo sợ các hệ thống mái ngói năng lượng mặt trời. Nhiều báo cáo cho rằng đang có một “cuộc chiến” giữa các công ty năng lượng mặt trời và các công ty lưới điện tại Hoa Kỳ, xoay quanh một số vấn đề quan trọng.</strong></p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>
                        <p>Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn</p>
                        <p style="text-align: center;">
                            <img src="public/images/img-detail.jpg" alt="">
                        </p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời. Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn.</p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời. Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn.</p>
                        <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p> --}}
                        {!! $post[0]->postContent !!}
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
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
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection