@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách trang</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" name="dataSearch"
                        value="{{request()->input('dataSearch')}}" placeholder="Tìm kiếm">
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
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['active']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count['trash']}})</span></a>
            </div>
            <form action="{{route('page.multi-option')}}" method="POST">
                <div class="form-action form-inline py-3">
                    @csrf
                    <select class="form-control mr-1" name="option" id="">
                        <option>Chọn</option>
                        @foreach ($actions as $k=>$v)
                          <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">Tên trang</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            @php if(request()->input('status')!='trash') { @endphp
                            <th scope="col">Tác vụ</th>
                            @php }  @endphp
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pages->total()>0)
                        @foreach ($pages as $page)
                        <tr>
                            <td>
                                <input type="checkbox" name="listcheck[]" value="{{$page->id}}">
                            </td>
                            <td>{{$page->PageName}}</td>
                            <td><span class="badge badge-primary">{{$page->pageStatus}}</span></td>
                            <td>
                                {{$page->user->name}}
                            </td>
                            <td>{{$page->pageCreate}}</td>
                            <td>
                                @php
                                if(request()->input('status')!='trash')
                                {
                                @endphp
                                <a href="{{route("page.edit",$page->id)}}"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <a href="{{route("page.delete",$page->id)}}">
                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                        data-placement="top" title="Delete"
                                        onclick="return confirm('Bạn có muốn xóa không?')"><i
                                            class="fa fa-trash"></i></button>
                                </a>
                                @php
                                 }
                                @endphp
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="bg-light">Không tìm thấy bản ghi nào</td>
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
            {{$pages->links()}}
        </div>
    </div>
</div>
@endsection