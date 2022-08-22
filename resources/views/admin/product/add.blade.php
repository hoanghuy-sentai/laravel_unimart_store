@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            {!! Form::open(['url'=>route('product.create'),'method'=>'post','files'=>true]) !!}
            @csrf
            <div class="form-group">
                <label for="file" style="cursor:pointer">Ảnh đại diện sản phẩm</label>
                <input type="file" name="productThumb" class="form-control-file" value="{{old('productThumb')}}" style="cursor:pointer" id="file">
                {{-- {!!
                Form::file('productThumb',['class'=>'form-control-file','style'=>'cursor:pointer','id'=>'file'])!!} --}}
            </div>
            @error('productThumb')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="form-group">
                <label for="file" style="cursor:pointer">Ảnh chi tiết sản phẩm</label>
                <input type="file" name="productDetailThumb[]" multiple class="form-control-file"  style="cursor:pointer" id="file">
                {{-- {!!
                Form::file('productThumb',['class'=>'form-control-file','style'=>'cursor:pointer','id'=>'file'])!!} --}}
            </div>
            @error('productDetailThumb')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="row">
                <div class="col">
                    <div class="form-group w-100">
                        {{-- @php
                             $nameValue=$_POST['name'];
                        @endphp --}}
                        {{-- $productName=$request->old("productName"); --}}
                        <label for="name">Tên sản phẩm</label>
                        <input class="form-control" value="{{old('productName')}}" type="text" name="productName" id="name">
                        @error('productName')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="" class="d-block">Danh mục sản phẩm</label>
                        <select name="productcat_id" class="form-control" id="">
                            <option value="">Chọn danh mục</option>
                            @foreach ($listProductcats as $item)
                            <option value="{{$item->id}}"  {{old('productcat_id')==$item['id']?'selected':''}}>{{str_repeat('-',$item['level']).$item['productcatName']}}</option>
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
                        <input class="form-control" value="{{old('productPrice')}}" type="text" name="productPrice" id="productPrice">
                        @error('productPrice')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productOldPrice">Giá sảm phẩm cũ</label>
                        <input class="form-control" value="{{old('productOldPrice')}}" type="text" name="productOldPrice" id="productOldPrice">
                        @error('productOldPrice')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productQty">Số lượng</label>
                        <input class="form-control" type="text" value="{{old('productQty')}}" name="productQty" id="productQty">
                        @error('productQty')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="productDiscount">Giảm giá</label>
                        <input class="form-control" value="{{old('productDiscount')}}" type="text" name="productDiscount" id="productDiscount">
                        @error('productDiscount')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="content">Mô tả sản phẩm</label>
                <textarea id="editer" name="productShortDesc" class="form-control" id="content" cols="30"
                    rows="5">{{old('productShortDesc')}}</textarea>
                @error('productShortDesc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Mô tả chi tiết sản phẩm</label>
                <textarea id="editer" name="productDesc" class="form-control" id="content" cols="30"
                    rows="5">{{old('productDesc')}}</textarea>
                @error('productDesc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pageStatus" class="d-block">Trạng thái</label>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productStatus" value="Công khai" id="publicStatus"
                                class="form-check-input">
                            <label for="publicStatus" class="form-check-label">Công khai</label>
                        </div>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productStatus" checked value="Chờ duyệt" id="watingStatus"
                                class="form-check-input">
                            <label for="watingStatus" class="form-check-label">Chờ duyệt</label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="pageStatus" class="d-block">Nổi bật</label>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productFeature" value="Có" id="yesFeature"
                                class="form-check-input">
                            <label for="yesFeature" class="form-check-label">Có</label>
                        </div>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="productFeature" checked value="Không" id="noFeature"
                                class="form-check-input">
                            <label for="noFeature" class="form-check-label">Không</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="btn-add" value="add new" class="btn btn-primary">Thêm mới</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
@endsection