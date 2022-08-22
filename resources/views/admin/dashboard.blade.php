@extends('layouts.admin')
@section("content")
<div class="container-fluid py-5">
    {{-- <textarea id="mytextarea">Hello, World!</textarea> --}}
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body" style="padding:1.16rem">
                    <h5 class="card-title">{{$get_status['finishing']}}</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>  
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$get_status['processing']}}</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$get_total}}</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$get_status['cancering']}}</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG ĐANG GIAO</div>
                <div class="card-body">
                    <h5 class="card-title">{{$get_status['delivering']}}</h5>
                    <p class="card-text">Số đơn đang được giao</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-yellow mb-3" style="max-width: 18rem;">
                <div class="card-header"></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-yellow mb-3" style="max-width: 18rem;">
                <div class="card-header"></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-yellow mb-3" style="max-width: 18rem;">
                <div class="card-header"></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            @if ($customer->total()>0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Ghi chú của KH</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $item)
                    <tr>
                        <td>{{$item->code}}</td>
                        <td>
                            {{$item->fullname}} <br>
                           {{$item->phone}}
                        </td>
                        <td>
                            @php
                                $qty=0;
                                foreach ($item->order as $ite) {
                                    # code...
                                     $qty+=$ite->qty;
                                }
                                echo $qty;
                            @endphp
                        </td>
                        <td>
                            @php
                                $total=0;
                                foreach ($item->order as $ite) {
                                    # code...
                                    $total+=$ite->subtotal;
                                }
                                echo number_format($total,0,',',',').'₫';
                             @endphp
                        </td>
                        <td>
                            {{-- <span class="badge badge-warning">{{$item->order[0]->status}}</span> --}}
                            @php
                                if($item->order[0]->status=='Đang xử lý')
                                    echo "<span class='badge badge-warning'>".$item->order[0]->status."</span>";
                                if($item->order[0]->status=='Đang được giao')
                                    echo "<span class='badge badge-secondary'>".$item->order[0]->status."</span>";
                                if($item->order[0]->status=='Hoàn thành')
                                    echo "<span class='badge badge-success'>".$item->order[0]->status."</span>";
                                if($item->order[0]->status=='Hủy')
                                    echo "<span class='badge badge-dark'>".$item->order[0]->status."</span>";    
                            @endphp
                        </td>
                        <td>{{$item->time}}</td>
                        <td width="187px">{{$item->note}}</td>
                        <td>
                            <a href="{{url('/admin/order/list',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.dashboard.customer.delete',$item->id)}}" onclick="return confirm('Bạn có muốn xóa bản khi không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="bg-light">Không có đơn hàng.</p>
            @endif

            {{$customer->links()}}
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