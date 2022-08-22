@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách slides</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" name="txtSearch" value="{{request()->input("txtSearch")}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary p-1">
                </form>
            </div>
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['active']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count['trash']}})</span></a>
            </div>
            <form action="{{route('excecute')}}" method="post">
                @csrf
                <div class="form-action form-inline py-3">
                    <select name="acts" class="form-control mr-1" id="">
                        <option value="choose">Chọn</option>
                        @foreach ($acts as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>   
                            <th scope="col">Ảnh</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            @php
                                if(request()->input("status")!='trash')
                                {
                            @endphp
                                 <th scope="col">Tác vụ</th>
                            @php       
                                }
                            @endphp
                        </tr>
                    </thead>
                    <tbody>
                        @if($slides->total()>0)
                            @foreach ($slides as $slide)
                            <tr>
                                <td>
                                    <input type="checkbox" name="listcheck[]" value="{{$slide->id}}">
                                </td>
                                <td><img src="{{asset($slide->slidePic)}}" width="200px" height="80px" class="img-fluid" alt=""></td>
                                <td>{{$slide->slideStatus}}</td>
                                <td>{{$slide->User->name}}</td>
                                <td>{{$slide->slideTime}}</td>
                                @php
                                    if(request()->input("status")!='trash')
                                    {
                                @endphp
                                <td>
                                   <a href="{{route('slide.edit',"$slide->id")}}"> <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
                                   <a href="{{route("delete","$slide->id")}}"> <button class="btn btn-danger btn-sm rounded-0" type="button" onclick="return confirm('Bạn có muốn xóa bản ghi không?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                </td>
                                @php
                                    }
                                @endphp
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="6"><span class="bg-white">Không tìm thấy bản ghi nào.</span></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
               
            </form>
             {{$slides->links()}}
        </div>
    </div>
</div>
@endsection