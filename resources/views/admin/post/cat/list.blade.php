@extends("layouts.admin")
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục bài viết
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{Session::get('status')}}
                    </div>
                    @endif
                    {{-- method="POST" post.cat.list --}}
                    <form method="POST" action="{{Route('post.cat.list')}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group w-100">
                                    <label for="name">Tên danh mục</label>
                                    <input class="form-control" type="text" name="catName" id="name">
                                    @error('catName')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="catStatus" id="public"
                                            value="Chờ duyệt" checked>
                                        <label class="form-check-label" for="public">
                                            Chờ duyệt
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="catStatus" id="waiting"
                                            value="Công khai">
                                        <label class="form-check-label" for="waiting">
                                            Công khai
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group w-100">
                                    <label for="">Danh mục cha<span class="text-danger">(Nếu không chọn mục này mặc định
                                            sẽ là danh mục cha)</span></label>
                                    <select name="parent_id" class="form-control" id="">
                                        <option value="0">Chọn danh mục cha</option>
                                        @foreach ($listPostcats as $item)
                                        <option value="{{$item->id}}">
                                            {{str_repeat('-',$item['level']).$item['catName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn-add" value="Add new" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Số lượng bài viết</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($postcats->total()>0)
                            @foreach ($listPostcats as $item)
                            <tr>
                                <td>{{str_repeat('-',$item['level']).$item['catName']}}</td>
                                <td>{{$item->post->count()}}</td>
                                <td><span class="badge badge-primary">{{$item->catStatus}}</span></td>
                                <td>{{$item->catCreate}}</td>
                                <td>{{$item->catTime}}</td>
                                <td><a href="{{route("post.cat.edit",$item->id)}}"><button
                                            class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                    <a href="{{route("post.cat.delete",$item->id)}}">
                                        <button class="btn btn-danger btn-sm rounded-0"
                                            onclick="return confirm('Bạn có muốn xóa không?')" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7"><span class="bg-white">Không có bản ghi nào</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection