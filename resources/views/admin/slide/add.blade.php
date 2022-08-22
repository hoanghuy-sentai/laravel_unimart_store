@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm slide
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            {!! Form::open(['url'=>route('slide.create'),'method'=>'post','files'=>true]) !!}
            @csrf
            <div class="form-group">
                <label for="file" style="cursor:pointer">Ảnh slide</label>
                <input type="file" name="slidePic" class="form-control-file" style="cursor:pointer" id="file">
                {{-- {!!
                Form::file('productThumb',['class'=>'form-control-file','style'=>'cursor:pointer','id'=>'file'])!!} --}}
            </div>
            @error('slidePic')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pageStatus" class="d-block">Trạng thái</label>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="slideStatus" value="Công khai" id="publicStatus"
                                class="form-check-input">
                            <label for="publicStatus" class="form-check-label">Công khai</label>
                        </div>
                        <div class="form-check  form-check-inline">
                            <input type="radio" name="slideStatus" checked value="Chờ duyệt" id="watingStatus"
                                class="form-check-input">
                            <label for="watingStatus" class="form-check-label">Chờ duyệt</label>
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