@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm kích hoạt</h5>
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
            <form method="POST" action="{{route("product.excecute")}}">
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
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá sản phẩm</th>
                            <th scope="col">Giảm giá</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Trạng thái</th>
                            @php if(request()->input('status')!='trash')
                            { @endphp
                              <th scope="col">Tác vụ</th>
                            @php 
                            }@endphp
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->total()>0)
                        @foreach ($products as $product)
                        {{-- @php
                            echo "<pre>";
                            print_r(asset($product->productThumb));
                            echo "</pre>";
                        @endphp --}}
                        <tr>
                            <td>
                                <input type="checkbox" name="listcheck[]" value="{{$product->id}}">
                            </td>
                            <td width='120.75px'><img  src="{{asset($product->productThumb)}}" class="img-fluid" style="width:60px;height:auto"   alt="{{$product->productTitle}}"></td></td>
                            <td width="200px">{{strlen($product->productName)>=20?Str::of($product->productName)->substr(0,20).str_repeat('.',3):$product->productName}}</td>
                            <td>{{number_format($product->productPrice,0,'.','.')}}đ</td>
                            <td>{{$product->productDiscount.str_repeat('%',1)}}</td>
                            <td width="120px"><span class="badge badge-primary">{{$product->productcat->productcatName}}</span></td>{{-- {{$product->postcat->catName}}---}}
                            <td>{{$product->productTime}}<br>{{$product->User->name}}</td>
                            {{-- <td><span class="badge badge-success">{{$product->qty>0?"Còn hàng($product->qty)":"Hết hàng"}}</span></td> --}}
                            <td> @if ($product->productQty>0)<span class="badge badge-success">Còn hàng({{$product->productQty}})</span> @else<span class="text-dark badge badge-secondary">Hết hàng({{$product->productQty}})</span>  @endif</td>
                            <td>
                                @php
                                if(request()->input('status')!='trash')
                                {
                                @endphp
                                <a href="{{route('product.edit',$product->id)}}"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                <a href="{{route('product.delete',$product->id)}}">
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
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection