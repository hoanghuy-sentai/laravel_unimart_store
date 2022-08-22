@extends("layouts.admin")
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
            <form method="POST" action="{{url('/admin/user/store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
                    @error('email')
                     <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password')
                     <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận lại mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="right_id" class="form-control" id="">
                        <option value="">Chọn quyền</option>
                        @foreach ($rights as $right)
                          <option value="{{$right->id}}">{{$right->nameOfRight}}</option>
                        @endforeach
                    </select>
                    @error('right_id')
                    <small class="text-danger">{{$message}}</small>
                   @enderror
                </div>
                <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection