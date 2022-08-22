@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" name="searchData" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary p-1">
                </form>
            </div>
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích hoạt<span
                        class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô hiệu hóa<span
                        class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form method="POST" action="{{route("post.excecute")}}">
                @csrf
                <div class="form-action form-inline py-3">
                    <select name="act" class="form-control mr-1" id="">
                        <option value="choose">Chọn</option>
                        @foreach ($actions as $k=>$v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-apply" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Người tạo - ngày tạo</th>
                            @php if(request()->input('status')!='trash') { @endphp
                            <th scope="col">Tác vụ</th>
                            @php }@endphp
                        </tr>
                    </thead>
                    <tbody>
                        @if ($posts->total()>0)
                        @foreach ($posts as $post)
                        <tr>
                            <td>
                                <input type="checkbox" name="listcheck[]" value="{{$post->id}}">
                            </td>
                            <td width='140.75px'><img  src="{{asset($post->postThumb)}}" class="img-fluid thumbImages"   alt="{{$post->postTitle}}"></td></td>
                            <td width="400px">{{strLen($post->postTitle)>50?Str::of($post->postTitle)->substr(0,50).str_repeat('.',3):$post->postTitle}}</td>
                            <td><span class="badge badge-primary">{{$post->postcat->catName}}</span></td>
                            <td>{{$post->postTime}}<br>{{$post->User->name}}</td>
                            <td>
                                @php
                                if(request()->input('status')!='trash')
                                {
                                @endphp
                                <a href="{{route('post.edit',$post->id)}}"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <a href="{{route('post.delete',$post->id)}}">
                                    <button onclick="return confirm('Bạn có muốn xóa bản khi không?')"
                                        class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                        data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                </a>
                                @php
                                }
                                @endphp
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7"><span class="bg-white">Không tìm thấy bản ghi nào</span></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection