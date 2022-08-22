@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật thông tin người dùng
        </div>
        <div class="card-body">
            <form action="{{route('user.update',$user->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" value="{{$user->name}}" type="text" name="name" id="name">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" value="{{$user->email}}" type="text" name="email" id="email" disabled>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email-confirm">Xác nhận lại mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="user_id" class="form-control" id="">
                        <option value="">Chọn quyền</option>
                        @foreach ($rights as $right)
                          <option value="{{$right->id}}" {{$user->right->nameOfRight==$right->nameOfRight?'selected':''}} >{{$right->nameOfRight}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" name="btn-update" value="update" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection