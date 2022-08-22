<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use App\Models\customer;
use App\Models\order;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Cart;

class ClientPaymentMailController extends Controller
{
    //

    function sendmail(Request $request)
    {
        if ($request->input("order")) {
            if(cart::count()==0)
                return redirect("/");
            $request->validate(
                [
                    'fullname' => 'required|string|min:5|max:255',
                    // 'email'=>'required',
                    'address' => 'required|string|max:255|min:5',
                    'phone' => 'required|numeric',
                    'note' => 'max:400',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'min' => 'Cần nhập tối thiểu :min ký tự',
                    'numeric' => "Dữ liệu nhập vào là số",
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                ],
                [
                    'fullname' => 'Họ tên ',
                    // 'email' => 'Địa chỉ email ',
                    'address' => 'Địa chỉ ',
                    'phone' => "Số điện thoại ",
                    'note' => 'Ghi chú ',
                ]
            );
            $code="#". substr(time(),6);;
            $data = [
                'payment_method'=>$request->input("payment-method"),
                'direct_payment'=>"<strong>Cách thức nhận hàng:</strong> quý khách nhận hàng tại cửa hàng, địa chỉ nhận hàng sẽ được thông báo đến quý khách sau khi có xác nhận của cửa hàng",
                'home_ship'=>"<strong>Cách thức nhận hàng:</strong> quý khách sẽ nhận được cuộc gọi từ nhân viên vận chuyển và thanh toán tiền cho nhân viên vận chuyển, phí bao gồm phí vận chuyển và tiền sản phẩm",
                'code'=>$code,
                'fullname' => $request->input("fullname"),
                'email' => $request->input("emaill"),
                'address' => $request->input("address"),
                'phone' => $request->input("phone"),
                'note' => $request->input("note"),
            ];
            Mail::to($request->input("emaill"))->send(new sendMail($data));
            //add customer
            $customer = customer::create([
                'code'=>$code,
                'fullname' => $request->input("fullname"),
                'address' => $request->input("address"),
                'email' => $request->input("emaill"),
                'phone' => $request->input("phone"),
                'time'=>date("d/m/Y"),
                'note'=>$request->input("note")
            ]);
            //add order with id is just adding and foreign set at cascade mode
            $id = $customer->id;
            foreach (cart::content() as $item) {
                order::create([
                    'productThumb' => $item->options->productThumb,
                    'productName' => $item->name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                    // 'total'=>$item->cart::total(),
                    'customer_id' => $id,
                    'status'=>"Đang xử lý",
                    'idOfProduct'=>$item->id,
                ]);
            }
            Cart::destroy();
            status::find(1)->update([
                'status'=>1,
            ]);
            // return view("client.cart.order_success",compact("data",'order'));
            return redirect()->route("client.order_success",$id);

            // Cart::destroy();

            // return view("client.cart.order_success",compact("data",'order'));
            // return redirect()->route("client.order_success",$id);
            
        }
    }
    
    function order_s($id)
    {
        $status=status::where('id',1)->get("status");
        // return $status[0]->id;
        if($status[0]->status==1)
        {
            if(customer::where("id",$id)->count()>0)
            {
                $customer=customer::where("id",$id)->get();
                $order=order::where("customer_id",$id)->get();
                status::find(1)->update([
                    'status'=>0,
                ]);
                return view("client.cart.order_success",compact("customer",'order'));
            }
            else
            {
                return redirect("/");
            }
        }
        else
        {
            return redirect("/");
        }
    }
}
