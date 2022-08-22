<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\post;
use App\Models\postcat;
use App\Models\product;
use Illuminate\Http\Request;

class ClientBlogController extends Controller
{
    //
    function blog()
    {
        $post_cats = postcat::all();
        $posts=post::paginate(5);
        return view("client.blog.list",compact("posts","post_cats"));
    }
    function blog_detail($id)
    {
        if(post::where('id','=',$id)->count()>0)
        {
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
            $post=post::where('id','=',$id)->get();
            return view("client.blog.blog_detail",compact("post","show_hot_selling_product"));
        }
        else
        {
            return redirect("/");
        }
    }
    function blog_cat($id)
    {
        if(postcat::where('id',$id)->count()>0)
        {   
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
            //--
            $postcat=postcat::find($id)->post;

            // return $posts;
            return view("client.blog.blog_cat",compact("postcat","show_hot_selling_product"));
        }
        else
        {
            return redirect("/");
        }
    }
}
