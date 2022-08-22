<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\order;
class DashboardController extends Controller
{
    //
    function __construct()
    {
        $this->middleware("auth");
    }
    function show()
    {
        $customer=customer::paginate(10);
        $finishing=0;
        $processing=0;
        $delivering=0;
        $cancering=0;
        $total=0;
        foreach($customer as $item)
        {
            $status=customer::find($item->id)->order;
            switch($status[0]->status)
            {
                case "Đang xử lý":$processing=$processing+1;
                break;
                case "Đang được giao":$delivering=$delivering+1;
                break;
                case "Hoàn thành":$finishing=$finishing+1;
                break;
                case "Hủy":$cancering=$cancering+1;
                default: 0;
            }
        }
        $get_status=[
            "processing"=>$processing,
            'delivering'=>$delivering,
            'finishing'=>$finishing,
            'cancering'=>$cancering,
        ];
        $order=order::all();
        $t=0;
        foreach($order as $item)
        {
            // echo "<pre>";
            // print_r($item);
            if($item->status=="Hoàn thành")
                $t=$t+$item->subtotal;
                
        }
        $get_total= number_format($t,0,',',',').' đ';
        // dd(number_format($t,0,',',','));
        // dd($get_status);
        // dd($customer);
        return view("admin.dashboard",compact("customer","get_status",'get_total'));
    }
    function delete_cus($id)
    {
        $customer=customer::find($id);
        $customer->delete();
        return redirect("/dashboard");
    }
}
