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
                <h5 class="m-0 ">Danh sách sách quyền</h5>
            </div>
            <div class="card-body">
                @php
                // echo "<pre>";
                // print_r($list_act);
                // echo "</pre>";
                @endphp
                <form action="{{url("admin/user/excute")}}" method="get">
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope=" col">#</th>
                                <th scope="col">Tên quyền</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        @php
                        // echo "<pre>";
                            // print_r($users);
                            // echo "<pre>";
                                $t=0;
                        @endphp
                        <tbody>
                            @if ($rights->total()>0)
                                @foreach ($rights as $right)
                                <tr>
                                    <td>@php $t=$t+1; echo $t; @endphp</td>
                                    <td>{!!$right->nameOfRight!!}</td>
                                    <td scope="row">{!!$right->descriptionOfRight!!}</td>
                                    <td>{{$right->dateOfCreating}}</td>
                                    <td>
                                        <a href="{{route('admin.right.edit',$right->id)}}"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                        <a href="{{route('admin.right.delete',$right->id)}}">
                                            <button onclick="return confirm('Bạn có muốn xóa bản khi không?')"
                                                class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                        </a>
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
               
            </div>
        </div>
    </div>
    @endsection