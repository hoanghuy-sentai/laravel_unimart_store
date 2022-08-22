@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật trang
        </div>
        <form action="{{route('page.update',$get_page_by_id[0]->id)}}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="pageName">Tên trang</label>
                <input class="form-control" type="text" name="pageName" value="{{$get_page_by_id[0]->PageName}}"
                    id="pageName">
                @error('pageName')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="pageContent">Nội dung trang</label>
                <textarea id="pageContent" name="pageContent">{{$get_page_by_id[0]->pageContent}}</textarea>
                @error('pageContent')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="pageStatus" class="d-block">Trạng thái</label>
                <div class="form-check  form-check-inline">
                    <input type="radio" name="pageStatus"  {{$get_page_by_id[0]->pageStatus=='Công khai'?'checked':''}} value="Công khai" id="publicStatus" class="form-check-input">
                    <label for="publicStatus" class="form-check-label">Công khai</label>
                </div>
                <div class="form-check  form-check-inline">
                    <input type="radio" name="pageStatus" {{$get_page_by_id[0]->pageStatus=='Chờ duyệt'?'checked':''}} value="Chờ duyệt" id="watingStatus"
                        class="form-check-input">
                    <label for="watingStatus" class="form-check-label">Chờ duyệt</label>
                </div>
            </div>
            {{-- <div class="form-group">
                <label for="user_id">Người tạo</label>      
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($creators as $creator)
                    <option {{$creator->user->name==$get_page_by_id[0]->user->name?'selected':""}}
                        value="{{$creator->user_id}}">{{$creator->user->name}}</option>
                    @endforeach
                </select>
            </div> --}}
            <button type="submit" name="btn-update" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
</div>
@endsection