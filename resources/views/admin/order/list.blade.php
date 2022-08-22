@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold">DANH SÁCH ĐƠN HÀNG</h5>
        </div>
        <div class="card-body">
            <h5 class="font-weight-bold"><span class="text-info pr-2"><i class="fa fa-info-circle" aria-hidden="true"></i></span>Thông tin khách hàng</h5>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-info">
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ghi chú KH</th>
                        <th scope="col">Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cus as $item)
                    <tr>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->note}}</td>
                        <td>{{$item->time}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h5 class="font-weight-bold"><span class="text-info pr-2"><i class="fa fa-list" aria-hidden="true"></i></span>Tình trạng đơn hàng</h5>
            <div class="form-action form-inline py-3">
                <select name="act" class="form-control mr-1 w-25" url="{{route('admin.update_status')}}" data_id={{$cus[0]->id}} id="ordering_status">
                    <option value="Đang xử lý" {{$order[0]->status=='Đang xử lý'?'selected':""}} >Đang xử lý</option>
                    <option value="Đang được giao" {{$order[0]->status=='Đang được giao'?'selected':""}}>Đang được giao</option>
                    <option value="Hoàn thành" {{$order[0]->status=='Hoàn thành'?'selected':""}}>Hoàn thành</option>
                    <option value="Hủy" {{$order[0]->status=='Hủy'?'selected':""}}>Hủy</option>
                </select>
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold font-weight-bold">CHI TIẾT ĐƠN HÀNG</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                @php
                    // echo "<pre>";
                    // print_r($cus);
                @endphp
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // echo "<pre>";
                        // print_r($order);
                        $t=0;
                    @endphp
                    @foreach ($order as $item)
                    <tr>
                        <td>
                            @php
                                $t=$t+1;
                                echo $t;
                            @endphp
                        </td>
                        <td><img class="img-fluid" style="width:60px;height:auto" src="{{$item->productThumb}}" alt="no-img"></td>
                        <td>{{$item->productName}}</td>
                        <td>{{number_format($item->price,0,',',',')."đ"}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{number_format($item->subtotal,0,',',',')."đ"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </div>
</div>
@endsection