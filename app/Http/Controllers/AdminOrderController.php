<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\order;
use App\Models\product;
use App\Models\productcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Exists;

class AdminOrderController extends Controller
{
    //
    function list($id)
    {
        if (Gate::allows('list_order_model')) {
            $productcats=productcat::all();
            //when has cus I will get his producs
            $cus=customer::where("id",$id)->get();
            $order=order::where("customer_id",$id)->get();
            return view("admin.order.list",compact("productcats","cus",'order'));
        } else {      
                abort(403);    
         }
    }
    function update_status()
    {
        $status=$_GET['status'];//get chose when click drowbox
        $id=$_GET['id'];//get id in a record in cus tbl.Yep I have to set relation between two tables
        order::where('customer_id',$id)->update(['status'=>$status]);//update status when choose one item in dropdow box

        if($status=="Hoàn thành")
        {
            $curent_order=order::where([["customer_id",$id],['status','Hoàn thành']])->get();
            // 'idOfProduct'
            // $curent_order_1=order::where([["customer_id",$id],['status','Hoàn thành']])->get('qty');
           
           foreach($curent_order as $item)
           {
                $productQty=product::where("id",$item->idOfProduct)->get("productQty");
                $leftQty=$productQty[0]->productQty-($item->qty);
                //update qty for current qty product
                product::where("id",$item->idOfProduct)
                ->update(['productQty'=>$leftQty]);
           }
        }
        echo "Đã update trạng thái đơn hàng thành công";
    }
}
