@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật slide
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            {!! Form::open(['url'=>route('slide.update',$slide[0]->id),'method'=>'post','files'=>true]) !!}
            @csrf
            <div class="form-group">
                <label for="file" style="cursor:pointer">Ảnh slide</label>
                <input type="file" name="slidePic" class="form-control-file" style="cursor:pointer" id="file">
                <img src="{{asset($slide[0]->slidePic)}}" width="200px" height="auto" class="mt-1" alt="{{$slide[0]->slidePic}}">Ảnh slide hiện có
                <input type="hidden" name="hn_slidePic" value="{{asset($slide[0]->slidePic)}}">
            </div>
            @error('slidePic')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pageStatus" class="d-block">Trạng thái</label>
                        <div class="form-check  form-check-inline">
                            <input type="radio" {{$slide[0]->slideStatus=="Công khai"?'checked':''}} name="slideStatus" value="Công khai" id="publicStatus"
                                class="form-check-input">
                            <label for="publicStatus" class="form-check-label">Công khai</label>
                        </div>
                        <div class="form-check  form-check-inline">
                            <input type="radio" {{$slide[0]->slideStatus=="Chờ duyệt"?'checked':''}} name="slideStatus" value="Chờ duyệt" id="watingStatus"
                                class="form-check-input">
                            <label for="watingStatus" class="form-check-label">Chờ duyệt</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="btn-update" value="update" class="btn btn-primary">Cập nhật</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
@endsection