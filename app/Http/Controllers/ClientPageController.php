<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Page;
use App\Models\product;
use Illuminate\Http\Request;

class ClientPageController extends Controller
{
    //
    function page_intro()
    {
        $page=Page::where([['id','1'],['pageStatus','Công khai']])->get();
         //phần các sản phẩm bán chạy 
        // $orders = order::skip(0)->take(10)->distinct()->get();
        $products=product::all();
        $orders = order::distinct()->get("idOfProduct");
        $show_hot_selling_product=array();
        // return $orders;
        foreach($products as $item)
        {
           foreach($orders as $ite)
           {
                if($ite->idOfProduct==$item->id)
                {
                    $show_hot_selling_product[]=[
                       'id'=>$item->id,
                       'productThumb'=> $item->productThumb,
                       'productDetailThumb'=>$item->productDetailThumb,
                       'productName'=>$item->productName,
                       'productPrice'=>number_format($item->productPrice,"0",',',','),       
                    ];
                }
           }
        }
        return view("client.page.intro",compact("page","show_hot_selling_product"));
    }
    function page_contract()
    {
           //phần các sản phẩm bán chạy 
        // $orders = order::skip(0)->take(10)->distinct()->get();
        $products=product::all();
        // $orders = order::distinct()->get("idOfProduct");
        $orders = order::skip(0)->take(10)->distinct()->get("idOfProduct");
        $show_hot_selling_product=array();
        // return $orders;
        foreach($products as $item)
        {
           foreach($orders as $ite)
           {
                if($ite->idOfProduct==$item->id)
                {
                    $show_hot_selling_product[]=[
                       'id'=>$item->id,
                       'productThumb'=> $item->productThumb,
                       'productDetailThumb'=>$item->productDetailThumb,
                       'productName'=>$item->productName,
                       'productPrice'=>number_format($item->productPrice,"0",',',','),       
                    ];
                }
           }
        }
        $page=Page::where([['id','2'],['pageStatus','Công khai']])->get();
        return view("client.page.contract",compact("page","show_hot_selling_product"));
    }
}
