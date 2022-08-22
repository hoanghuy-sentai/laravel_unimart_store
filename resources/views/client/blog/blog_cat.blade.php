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
                        <a href="{{route('client.blog.list')}}" title="">Blog</a>
                    </li>
                    <li>
                        @if (isset($postcat[0]->postcat->catName))
                            <a href="" title="">{{$postcat[0]->postcat->catName}}</a>
                        @else
                            <a href="" title="">Thông báo</a>
                        @endif
                        
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @php
                            $t=0;
                        @endphp
                        @if (!empty($postcat))
                            @foreach ($postcat as $post)
                            @php
                                $t=$t+1;
                            @endphp
                            <li class="clearfix">
                                <a href="{{route("client.blog.detail",$post->id)}}" title="" class="thumb fl-left">
                                    <img id="postThumb"  src="{{$post['postThumb']}}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route("client.blog.detail",$post->id)}}" title="" class="title">{{$post['postTitle']}}</a>
                                    <span class="create-date">{{$post['postTime']}}</span>
                                    <p class="desc">{!!$post['postDes']!!}</p>
                                </div>
                            </li>
                             @endforeach
                        @endif
                        @if($t==0)
                            <p class="bg-light">Bài viết đã bị xóa hoặc không tồn tại,ấn vào đây để trở lại trang <a href="{{route('client.blog.list')}}">bài viết</a>.</p>
                        @endif
                      
                        
                        {{-- <li class="clearfix">
                            <a href="?page=detail_blog" title="" class="thumb fl-left">
                                <img src="public/images/img-post-01.jpg" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">Mời gọi kiều bào hiến kế, chung sức xây dựng phát triển TP. Hồ Chí Minh</a>
                                <span class="create-date">28/11/2017</span>
                                <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_blog" title="" class="thumb fl-left">
                                <img src="public/images/img-post-01.jpg" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">Mời gọi kiều bào hiến kế, chung sức xây dựng phát triển TP. Hồ Chí Minh</a>
                                <span class="create-date">28/11/2017</span>
                                <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_blog" title="" class="thumb fl-left">
                                <img src="public/images/img-post-01.jpg" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">Mời gọi kiều bào hiến kế, chung sức xây dựng phát triển TP. Hồ Chí Minh</a>
                                <span class="create-date">28/11/2017</span>
                                <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_blog" title="" class="thumb fl-left">
                                <img src="public/images/img-post-01.jpg" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">Mời gọi kiều bào hiến kế, chung sức xây dựng phát triển TP. Hồ Chí Minh</a>
                                <span class="create-date">28/11/2017</span>
                                <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_blog" title="" class="thumb fl-left">
                                <img src="public/images/img-post-01.jpg" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">Mời gọi kiều bào hiến kế, chung sức xây dựng phát triển TP. Hồ Chí Minh</a>
                                <span class="create-date">28/11/2017</span>
                                <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_blog" title="" class="thumb fl-left">
                                <img src="public/images/img-post-01.jpg" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">Mời gọi kiều bào hiến kế, chung sức xây dựng phát triển TP. Hồ Chí Minh</a>
                                <span class="create-date">28/11/2017</span>
                                <p class="desc">Trong ngày hôm nay (11/11) đoàn kiều bào đã tổ chức thành 4 nhóm đi tham quan các điểm như huyện Cần Giờ, Đại học Quốc gia, Khu công nghệ cao TP.HCM, Công viên phần mềm Quang Trung, Khu Nông nghiệp Công nghệ cao, Khu Đô thị mới Thủ Thiêm, Cảng Cát Lái... để kiều bào hiểu thêm về tình hình phát [...]</p>
                            </div>
                        </li> --}}
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
                    {{-- {{$posts->links()}} --}}
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
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection