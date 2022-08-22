@extends('layouts.admin')
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm trang mới
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/page/store')}}">
                @csrf
                <div class="form-group">
                    <label for="pageName">Tên trang</label>
                    <input class="form-control" type="text" name="pageName" id="pageName">
                    @error('pageName')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pageContent">Nội dung trang</label>
                    <textarea id="editer" name="pageContent"></textarea>
                    @error('pageContent')
                     <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pageStatus" class="d-block">Trạng thái</label>
                    <div class="form-check  form-check-inline">
                        <input type="radio" name="pageStatus" value="Công khai" id="publicStatus" class="form-check-input">
                        <label for="publicStatus" class="form-check-label">Công khai</label>
                    </div>
                    <div class="form-check  form-check-inline">
                        <input type="radio" name="pageStatus" checked value="Chờ duyệt" id="watingStatus" class="form-check-input">
                        <label for="watingStatus" class="form-check-label">Chờ duyệt</label>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="user_id">Người tạo</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($creators as $creator)
                            <option value="{{$creator->user_id}}">{{$creator->user->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection