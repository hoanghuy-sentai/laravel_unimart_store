<?php

namespace App\Http\Controllers;
use App\Models\productcat;
use App\Models\product;
use Illuminate\Http\Request;

class ClientFilterController extends Controller
{
    //
    function __construct()
    {
        function data_tree_breakcum($data,$parent_id)
        {
            $rs=[];
            foreach($data as $item)
            {
                if( $parent_id==$item['id'])
                {
                    $id=$item['id'];
                    $rs["$id"."k"]=$item['productcatName'];
                    $part_id=$item['parent_id'];
                    $child= data_tree_breakcum($data,$part_id);
                    $rs=array_merge($child,$rs);
                }
            }
            return $rs;
        }
        function data_tree($data,$parent_id=0)
        {
            $result=[];
            foreach($data as $item)
            {
                if($item['parent_id']==$parent_id)
                {
                    $result[]=$item['id'];
                    $id=$item['id'];
                    $child= data_tree($data,$id);
                    $result=array_unique(array_merge($result,$child));
                }
            }
            return $result;
        }
    }
    function price_filter(Request $request, $id)
    {
        if(productcat::where("id",$id)->count()>0)
        {
            $parentcat_id=productcat::where("id",$id)->get("parent_id");
            $rs_parentcat_id=$parentcat_id[0]->parent_id;;
    
            $productcat = productcat::where([["productcatStatus",'=',"Công khai"],['id','=',$id]])->get();
            $productcats = productcat::all();
            
    
            $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
            $breakcum[$productcat[0]->id]=$productcat[0]->productcatName;
    
            $fullPathBreakCum=$breakcum;
    
            switch($request->input("r-price")){
                case "under500": $products=product::where([["productStatus","Công khai"],["productPrice",'<','500000']])->get(); 
                break;
                case "between500tAndnd1m": $products=product::where([["productStatus","Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->get(); 
                break;
                case "between1mAnd5m": $products=product::where([["productStatus","Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->get(); 
                break;
                case "between5mAnd10m": $products=product::where([["productStatus","Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->get(); 
                break;
                case "older10m": $products=product::where([["productStatus","Công khai"],["productPrice",'>','10000000']])->get(); 
                break;
                default:0;  
            }
           
    
            $parent_id_product=data_tree($productcats,$id);
            if(count($parent_id_product)==0)
            {
                $id=$id;
            }
    
            return view("client.product_cat",compact("products",'productcats','productcat','parent_id_product','id','fullPathBreakCum'));
    
            //value under500-between500tAndnd1m-between1mAnd5m-between5mAnd10m-older10m
            // return $request->input("r-price");
        }
        else{
            return redirect("/");
        }

    }
    function price_arrange_filter(Request $request,$id)
    {
        // A-Z,Z-A,hightPriceToLowPrice,lowPriceToHightPrice
        // return $request->input("select");
        if(productcat::where("id",$id)->count()>0)
        {
            $parentcat_id=productcat::where("id",$id)->get("parent_id");
            $rs_parentcat_id=$parentcat_id[0]->parent_id;;
    
            $productcat = productcat::where([["productcatStatus",'=',"Công khai"],['id','=',$id]])->get();
            $productcats = productcat::all();
            
    
            $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
            $breakcum[$productcat[0]->id]=$productcat[0]->productcatName;
    
            $fullPathBreakCum=$breakcum;
            
            return $request->input("r-price");
            switch($request->input("select")){
                case "A-Z": $products=product::where([["productStatus","Công khai"]])->orderBy("productName","ASC")->get(); 
                break;
                case "Z-A": $products=product::where([["productStatus","Công khai"]])->orderBy("productName","DESC")->get(); 
                break;
                case "hightPriceToLowPrice": $products=product::where([["productStatus","Công khai"]])->orderBy("productPrice","DESC")->get(); 
                break;
                case "lowPriceToHightPrice": $products=product::where([["productStatus","Công khai"]])->orderBy("productPrice","ASC")->get(); 
                break;
                default:0;  
            }
    
            $parent_id_product=data_tree($productcats,$id);
            if(count($parent_id_product)==0)
            {
                $id=$id;
            }
    
            return view("client.product_cat",compact("products",'productcats','productcat','parent_id_product','id','fullPathBreakCum'));
        }
        else{
            return redirect("/");
        }   
    }
}
