@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật sản phẩm
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            {!! Form::open(['url'=>route('product.update',$data[0]->id),'method'=>'post','files'=>true]) !!}
            @csrf
            <div class="form-group">
                <label for="file" style="cursor:pointer">Ảnh đại diện sản phẩm</label>
                {!! Form::file('productThumb', ['class'=>'form-control-file','style'=>'cursor:pointer','id'=>'file'])
                !!}
                <input type="hidden" name="hdproductThumb" value="{{$data[0]->productThumb}}">
                <img src="{{asset($data[0]->productThumb)}}" class="thumbImages mt-1">Ảnh đại diện sản phẩm hiển có
                @error('productThumb')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="file" style="cursor:pointer">Ảnh chi tiết sản phẩm</label>
                        <input type="file" name="productDetailThumb[]" multiple class="form-control-file" value="{{old('productDetailThumb[]')}}"  style="cursor:pointer" id="file">
                        @php
                            // echo "<pre>";
                            // print_r(explode(',',$data[0]->productDetailThumb));
                            // echo "</pre>";
                        @endphp
                        @if ($data[0]->productDetailThumb!=null)
                            @foreach (explode(',',$data[0]->productDetailThumb) as $key=>$item)
                                 <input type="checkbox" class="pointer" name="productDetailThumb[]" value="{{$key}}"> <img src="{{asset($item)}}"  class="thumbImages mt-1">
                            @endforeach
                        @endif
                        <input type="hidden" name="hdproductDetailThumb" value="{{asset($data[0]->productDetailThumb)}}">
                        Ảnh chi tiết sản phẩm hiển có
                    </div>
                    @error('productDetailThumb')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="col">
                    <div class="form-action form-inline py-3">
                        <select name="act" class="form-control mr-1" id="">
                            <option value="choose">Chọn</option>
                            @foreach ($actions as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="submit" name="btn-editPic" value="Áp dụng" class="btn btn-primary"> --}}
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col">
                    <div class="form-group w-100">
                        <label for="name">Tên sản phẩm</label>
                        <input class="form-control" value="{{$data[0]->productName}}" type="text" name="productName"
                            id="name">
                        @error('productName')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        {{-- <label for="">Danh mục sản phẩm</label>
                        <select name="productcat_id" class="form-control" id="">
                            <option value="">Chọn danh mục</option>
                            @foreach ($listProductcats as $item)
                                <option value="{{$item->id}}" {{$item->productcatName==$data[0]->productcat->productcatName?'selected':''}}>
                                    {{str_repeat("-",$item['level']).$item['productcatName']}}
                                </option>
                            @endforeach
                        </select> --}}
                        <label for="" class="d-block">Danh mục sản phẩm</label>
                        <select name="productcat_id" class="form-control" id="">
                            <option value="">Chọn danh mục</option>
                            @foreach ($listProductcats as $item)
                            <option value="{{$item->id}}"  {{$data[0]->productcat->productcatName==$item['productcatName']?'selected':''}}>{{str_repeat('-',$item['level']).$item['productcatName']}}</option>
                            @endforeach
                        </select>
                        @error('productcat_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productPrice">Giá sản phẩm</label>
                        <input class="form-control" type="text" value="{{$data[0]->productPrice}}" name="productPrice"
                            id="productPrice">
                        @error('productPrice')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productOldPrice">Giá sản phẩm cũ</label>
                        <input class="form-control" type="text" value="{{$data[0]->productOldPrice}}" name="productOldPrice"
                            id="productOldPrice">
                        @error('productOldPrice')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productQty">Số lượng sản phẩm</label>
                        <input class="form-control" type="text" value="{{$data[0]->productQty}}" name=" productQty"
                            id="productQty">
                        @error('productQty')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productDiscount">Giảm giá</label>
                        <input class="form-control" type="text" value="{{$data[0]->productDiscount}}"
                            name="productDiscount" id="productDiscount">
                        @error('productDiscount')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="content">Mô tả sản phẩm</label>
                <textarea id="editer" name="productShortDesc" class="form-control" id="content" cols="30"
                    rows="5">{{$data[0]->productShortDesc}}</textarea>
                @error('productShortDesc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Mô tả chi tiết sản phẩm</label>
                <textarea id="editer" name="productDesc" class="form-control" id="content" cols="30"
                    rows="5">{{$data[0]->productDesc}}</textarea>
                @error('productDesc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pageStatus" class="d-block">Trạng thái</label>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productStatus" {{$data[0]->productStatus=='Công khai'?'checked':''}} value="Công khai" id="publicStatus" class="form-check-input">
                            <label for="publicStatus" class="form-check-label">Công khai</label>
                        </div>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productStatus" {{$data[0]->productStatus=='Chờ duyệt'?'checked':''}} value="Chờ duyệt" id="watingStatus"  class="form-check-input">
                            <label for="watingStatus" class="form-check-label">Chờ duyệt</label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="pageStatus" class="d-block">Nổi bật</label>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productFeature" {{$data[0]->productFeature=='Có'?'checked':''}}
                            value="Có" id="yesFeature"
                            class="form-check-input">
                            <label for="yesFeature" class="form-check-label">Có</label>
                        </div>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productFeature" {{$data[0]->productFeature=='Không'?'checked':''}}
                            value="Không" id="noFeature"
                            class="form-check-input">
                            <label for="noFeature" class="form-check-label">Không</label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="form-group">
                <label for="">Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Chờ duyệt
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                        value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Công khai
                    </label>
                </div>
            </div> --}}



            <button type="submit" name="btn-update" value="update" class="btn btn-primary">Cập nhật</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection