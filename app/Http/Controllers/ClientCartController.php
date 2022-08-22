<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Cart;
class ClientCartController extends Controller
{
    //
    function add_cart($id,Request $request)
    {
        $product=product::find($id);
        $qty=1;
        Cart::add([
            'id' => $product->id,
            'name' =>  $product->productName,
            'qty' => $qty,
            'price' => $product->productPrice,
            'options' => ['size' => 'large','productThumb'=>$product->productThumb,'productDiscount'=>$product->productDiscount]
        ]);

        return redirect()->route("client.product.cart.show_cart");

    }
    function destroy_entire_cart()
    {
        Cart::destroy();
        return view("client.cart.show_cart");
    }
    function update_cart(Request $request)
    {
        $qty=$request->input("num-order");
        if($request->input("updatecart"))
        {
            foreach($qty as $k=>$qty_value)
            {
                Cart::update($k, $qty_value); // Will update the quantity
            }
            return redirect()->route("client.product.cart.show_cart");
        }
    }
    function remove_cart($rowId)
    {
        $rowId= $rowId;
        Cart::remove($rowId);
        return redirect()->route("client.product.cart.show_cart");
    }
    function update_cart_ajax()
    {
        
        $id=$_GET['id'];
        $qty=$_GET['qty'];
        $rowId=$_GET['rowId'];
        $price=$_GET['price'];
        Cart::update($rowId, $qty); // Will update the quantity
        $total=Cart::total(0,',',',');
        $result=array(
            'subtotal'=> number_format($qty*$price,0,',',','),
            'total'=>$total,
            'id'=>$id,
        );
        Cart::update($rowId,['subtotal' => $qty*$price]);
        echo json_encode($result);
    }
    function update_cart_ajax_from_detail()
    {    
        foreach(cart::content() as $item)
        {
           if($item->id==$id_of_product)
           {
                $qty=$_GET['qty']-1;
                $price=$_GET['price'];
                $id_of_product=$_GET['id_of_product'];
                Cart::update($item->rowId, $qty); // Will update the quantity
                $result=array(
                    'subtotal'=> number_format($qty*$price,0,',',','),
                    // 'total'=>$total,
                    'id'=>$id_of_product,
                );
                Cart::update($item->rowId,['subtotal' => $qty*$price]);
                echo json_encode($result);
           }
        }
    }
    function show_cart()
    {
        return view("client.cart.show_cart");
    }
    function buy_now($id)
    {
        return view("client.cart.show_cart");
    }
    function payment()
    {
        return view("client.cart.payment");
    }
}
