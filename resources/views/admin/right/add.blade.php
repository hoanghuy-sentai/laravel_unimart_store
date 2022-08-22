@extends("layouts.admin")
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm quyền
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            <form method="POST" action="{{route('admin.right.createRight')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Tên quyền</label>
                    <input class="form-control" type="text" name="nameOfRight" id="name">
                    @error('nameOfRight')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Mô tả</label>
                    <textarea id="editer" name="descriptionOfRight" class="form-control" id="content" cols="30"
                        rows="5">{{old('productDesc')}}</textarea>
                    @error('descriptionOfRight')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" name="btn-add" value="add new" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection