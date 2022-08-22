@extends("layouts.admin")
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật danh mục
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{Session::get('status')}}
                    </div>
                    @endif
                    {{-- method="POST" post.cat.list --}}
                    <form method="POST" action="{{Route('product.cat.update',$data[0]->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group w-100">
                                    <label for="name">Tên danh mục</label>
                                    <input class="form-control" type="text" name="productcatName" value="{{$data[0]->productcatName}}"
                                        id="name">
                                    @error('productcatName')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input {{$data[0]->productcatStatus=='Chờ duyệt'?'checked':''}}
                                        class="form-check-input" type="radio" name="productcatStatus"
                                        id="public" value="Chờ duyệt" >
                                        <label class="form-check-label" for="public">
                                            Chờ duyệt
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="productcatStatus" id="waiting"
                                            value="Công khai" {{$data[0]->productcatStatus=='Công khai'?'checked':''}}>
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
                                        @foreach ($listProductcats as $item)
                                        <option value="{{$item->id}}"  {{$data[0]->parent_id==$item->id?'selected':''}}>{{str_repeat("-",$item->level).$item->productcatName}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="btn-update" value="Add new" class="btn btn-primary">Cập nhật</button>
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
                            @php
                            $no=1;
                            @endphp
                            @if ($productcats->total()>0)
                            @foreach ($listProductcats as $item)
                            <tr>
                                <td>{{str_repeat("-",$item['level']).$item['productcatName']}}</td>
                                <td>{{$item->product->count()}}</td>
                                <td><span class="badge badge-primary">{{$item->productcatStatus}}</span></td>
                                <td>{{$item->productcatCreate}}</td>
                                <td>{{$item->productcatTime}}</td>
                                <td><a href="{{route("product.cat.edit",$item->id)}}"><button
                                            class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                    <a href="{{route("product.cat.delete",$item->id)}}">
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
                                    <td colspan="7"><span class="bg-white">Không có bản khi nào</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- {{$productcats->links()}} --}}
</div>
@endsection