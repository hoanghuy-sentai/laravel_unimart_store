@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            {!! Form::open(['url'=>route('post.create'),'method'=>'post','files'=>true]) !!}
            @csrf
            <div class="form-group">
                <label for="file" style="cursor:pointer">Ảnh đại diện bài viết</label>
                {!! Form::file('postThumb', ['class'=>'form-control-file','style'=>'cursor:pointer','id'=>'file','value'=>old("postThumb")]) !!}
                @error('postThumb')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group w-100">
                        <label for="name">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" value="{{old('postTitle')}}" name="postTitle" id="name">
                        @error('postTitle')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        <label for="">Danh mục</label>
                        <select name="postcat_id" class="form-control" id="">
                            <option value="">Chọn danh mục</option>
                            @foreach ($listPostcats as $item)
                            <option value="{{$item->id}}" {{old("postcat_id")==$item->id?'selected':''}}>{{str_repeat('-',$item['level']).$item['catName']}}</option>
                            @endforeach
                        </select>
                        @error('postcat_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="content">Mô tả bài viết</label>
                <textarea id="editer" name="postDes" class="form-control" id="content" cols="30"
                    rows="5">{{old('postDes')}}</textarea>
                @error('postDes')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Nội dung bài viết</label>
                <textarea id="editer" name="postContent" class="form-control" id="content" cols="30"
                    rows="5">{{old('postContent')}}</textarea>
                @error('postContent')
                <small class="text-danger">{{$message}}</small>
                @enderror
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



            <button type="submit" name="btn-add" value="add new" class="btn btn-primary">Thêm mới</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection