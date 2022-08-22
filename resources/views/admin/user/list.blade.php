@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách thành viên</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" name="searchUserText"
                            value="{{request()->input('searchUserText')}}" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary p-1">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích hoạt<span
                            class="text-muted">({{$count['active']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô hiệu hóa<span
                            class="text-muted">({{$count['visible']}})</span></a>
                </div>
                @php
                // echo "<pre>";
                // print_r($list_act);
                // echo "</pre>";
                @endphp
                <form action="{{url("admin/user/excute")}}" method="get">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="option">
                            <option>Chọn</option>
                            @foreach ($list_act as $k =>$v )
                                <option value="{{$k}}"> {{$list_act[$k];}}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="check_all"">
                                </th>
                                <th scope=" col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                               @php if(request()->input('status')!='trash'){ @endphp 
                               <th scope="col">Thao tác</th>
                               @php }  @endphp
                            </tr>
                        </thead>
                        @php
                        // echo "<pre>";
                            // print_r($users);
                            // echo "<pre>";
                        @endphp
                        @if ($users->total()>0)
                        <tbody>
                            @php
                            $numerical_order=1;
                            @endphp
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" name="list_check[]" value="{{$user->id}}">
                                </td>
                                <td scope="row">
                                    @php
                                    echo $numerical_order++;
                                    @endphp
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->right->nameOfRight}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    @php
                                        if(request()->input('status')!='trash')
                                        {
                                    @endphp
                                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    @if (Auth::user()->email!=$user->email)
                                    <a href="{{route('delete_user',$user->id)}}"
                                        onclick="return confirm('Bạn có muốn xóa bản ghi này không?')"
                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                            class="fa fa-trash"></i></a>
                                    @endif
                                    @php
                                    }
                                    @endphp
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="bg-light">Không tìm thấy bản ghi nào</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </form>
                {{$users->links()}}
            </div>
        </div>
    </div>
    @endsection