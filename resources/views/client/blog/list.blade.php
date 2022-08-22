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
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Bài viết</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($posts as $post)
                            <li class="clearfix">
                                <a href="{{route("client.blog.detail",$post->id)}}" title="" class="thumb fl-left">
                                    <img id="postThumb"  src="{{asset($post['postThumb'])}}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route("client.blog.detail",$post->id)}}" title="" class="title">{{$post['postTitle']}}</a>
                                    <span class="create-date">{{$post['postTime']}}</span>
                                    <p class="desc">{!!$post['postDes']!!}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục bài viết</h3>
                </div>
                <div class="section-detail">
                    @include("layouts.client_slidebar_post_categories")
                    @php
                        echo "<ul class='list-item'>";
                            data_tree($post_cats);
                        echo "<ul>";
                    @endphp
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