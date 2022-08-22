<?php

namespace App\Http\Controllers;

use App\Models\filter;
use App\Models\order;
use App\Models\post;
use App\Models\product;
use App\Models\productcat;
use App\Models\slide;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
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
    function products()
    {
        //product-cat
        $productcats = productcat::where("productcatStatus",'=',"Công khai")->get();
        //end product-cat
        $products=product::all();
        $productcats = productcat::where("productcatStatus",'=',"Công khai")->get();
         //phần các sản phẩm bán chạy 
        $orders = order::skip(0)->take(10)->distinct()->get("idOfProduct");
        // $orders = order::distinct()->get("idOfProduct");
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
        return view("client.products",compact("products","show_hot_selling_product","productcats"));
    }
    function show()
    {
        $products=product::all();
        $list_slide=slide::all();
        $productcats = productcat::where("productcatStatus",'=',"Công khai")->get();
        // return $productcats;

        //phần các sản phẩm bán chạy 
        $orders = order::skip(0)->take(10)->distinct()->get("idOfProduct");
        // $orders = order::distinct()->get("idOfProduct");
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
        // return $show_hot_selling_product;
        return view("client.home",compact("productcats","list_slide","products","orders","show_hot_selling_product"));
    }
    function product_cat($id,Request $request)
    {
        // echo "Hiển thị danh mục sản phẩm có cat-id là".$cat_id;
        if(productcat::where("id",$id)->get("parent_id")->count()>0)
        {
            $parentcat_id=productcat::where("id",$id)->get("parent_id");
            $rs_parentcat_id=$parentcat_id[0]->parent_id;;
    
            $productcat = productcat::where([["productcatStatus",'=',"Công khai"],['id','=',$id]])->get();
            $productcats = productcat::all();
            
    
            $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
            $breakcum[$productcat[0]->id]=$productcat[0]->productcatName;
    
            $fullPathBreakCum=$breakcum;
    
            if ($request->session()->exists('price_arrangement')) {
                $r_price=$request->session()->get("price_arrangement");
                // return $r_price;
                switch($request->input("select")){
                    case "A-Z": 
                        {
                            switch($r_price){
                                case "under500":  $products=product::where([["productStatus","Công khai"],["productPrice",'<','500000']])->get(); 
                                break;
                                case "between500tAndnd1m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->orderBy("productName","ASC")->get();                                                                    
                                break;
                                case "between1mAnd5m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->orderBy("productName","ASC")->get();                                 
                                break;              
                                case "between5mAnd10m":  $products=product::where([["productStatus","Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->orderBy("productName","ASC")->get();                                                                  
                                break;
                                case "older10m": $products=product::where([["productStatus","Công khai"],["productPrice",'>','10000000']])->orderBy("productName","ASC")->get();                                                                      
                                break;
                                default: return "OK";  
                            }
                        }
                        // $products=product::where([["productStatus","Công khai"]])->orderBy("productName","ASC")->get(); 
                    break;
                    case "Z-A":
                        {
                            switch($r_price){
                                case "under500":  $products=product::where([["productStatus","Công khai"],["productPrice",'<','500000']])->orderBy("productName","DESC")->get(); 
                                break;
                                case "between500tAndnd1m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->orderBy("productName","DESC")->get();                                                                    
                                break;
                                case "between1mAnd5m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->orderBy("productName","DESC")->get();                                 
                                break;              
                                case "between5mAnd10m":  $products=product::where([["productStatus","Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->orderBy("productName","DESC")->get();                                                                  
                                break;
                                case "older10m": $products=product::where([["productStatus","Công khai"],["productPrice",'>','10000000']])->orderBy("productName","DESC")->get();                                                                      
                                break;
                                default:;  
                            }
                        } 
                        // $products=product::where([["productStatus","Công khai"]])->orderBy("productName","DESC")->get(); 
                    break;
                    case "hightPriceToLowPrice":
                        {
                            switch($r_price){
                                case "under500":  $products=product::where([["productStatus","Công khai"],["productPrice",'<','500000']])->orderBy("productPrice","DESC")->get(); 
                                break;
                                case "between500tAndnd1m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->orderBy("productPrice","DESC")->get();                                                                    
                                break;
                                case "between1mAnd5m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->orderBy("productPrice","DESC")->get();                                 
                                break;              
                                case "between5mAnd10m":  $products=product::where([["productStatus","Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->orderBy("productPrice","DESC")->get();                                                                  
                                break;
                                case "older10m": $products=product::where([["productStatus","Công khai"],["productPrice",'>','10000000']])->orderBy("productPrice","DESC")->get();                                                                      
                                break;
                                default:;  
                            }
                        } 
                        // $products=product::where([["productStatus","Công khai"]])->orderBy("productPrice","DESC")->get(); 
                    break;
                    case "lowPriceToHightPrice":
                        {
                            switch($r_price){
                                case "under500":  $products=product::where([["productStatus","Công khai"],["productPrice",'<','500000']])->orderBy("productPrice","ASC")->get(); 
                                break;
                                case "between500tAndnd1m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->orderBy("productPrice","ASC")->get();                                                                    
                                break;
                                case "between1mAnd5m":$products=product::where([["productStatus","Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->orderBy("productPrice","ASC")->get();                                 
                                break;              
                                case "between5mAnd10m":  $products=product::where([["productStatus","Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->orderBy("productPrice","ASC")->get();                                                                  
                                break;
                                case "older10m": $products=product::where([["productStatus","Công khai"],["productPrice",'>','10000000']])->orderBy("productPrice","ASC")->get();                                                                      
                                break;
                                default:;  
                            }
                        } 
                        // $products=product::where([["productStatus","Công khai"]])->orderBy("productPrice","ASC")->get(); 
                    break;
                    default:$products=product::where("productStatus","Công khai")->get();   
                }
                // $request->session()->forget('price_arrangement');
            }
            else{
                 switch($request->input("select")){
                    case "A-Z": $products=product::where([["productStatus","Công khai"]])->orderBy("productName","ASC")->get(); 
                    break;
                    case "Z-A": $products=product::where([["productStatus","Công khai"]])->orderBy("productName","DESC")->get(); 
                    break;
                    case "hightPriceToLowPrice": $products=product::where([["productStatus","Công khai"]])->orderBy("productPrice","DESC")->get(); 
                    break;
                    case "lowPriceToHightPrice": $products=product::where([["productStatus","Công khai"]])->orderBy("productPrice","ASC")->get(); 
                    break;
                    default:$products=product::where("productStatus","Công khai")->get();   
                 }
                 $request->session()->forget('price_arrangement');
            }
    
            $parent_id_product=data_tree($productcats,$id);
            if(count($parent_id_product)==0)
            {
                $id=$id;
            }
            //Show all producs part
            $displayProduct=array();
            foreach($products as $product)
            {
                foreach($parent_id_product as $k=> $item)
                {
                    if($parent_id_product[$k]==$product['productcat_id'])
                    {
                        $displayProduct[]=[
                           'id'=>  $product->id,
                           'productThumb'=> $product->productThumb,
                           'productName'=> $product->productName,
                           'productPrice'=> $product->productPrice,
                           'productOldPrice'=> $product->productOldPrice,
                        ];
                    }
                }
            };
            //     @foreach ($products as $product)
            //     @foreach ($parent_id_product as $k=> $item)
            //        @if ($parent_id_product[$k]==$product['productcat_id'])
            //                 @php
            //                     $i=$i+1; 
            //                 @endphp
            //                 <li>
            //                     <a href="{{route('client.product.detail_product',$product->id)}}" title="" class="thumb">
            //                         <img src="{{$product->productThumb}}">
            //                     </a>
            //                     <a href="{{route('client.product.detail_product',$product->id)}}" title="" class="product-name">{{strlen($product->productName)>25?Str::of($product->productName)->substr(0,22)."...":$product->productName}}</a>
            //                     <div class="price">
            //                         <span class="new">{{number_format($product->productPrice,0,',',',')}}đ</span>
            //                         <span class="old">{{$product->productOldPrice==0?"":$product->productOldPrice."đ"}}</span>
            //                     </div>
            //                 </li>  
            //         @endif
            //     @endforeach
            // @endforeach
            
            //do các sản phẩm bán chạy 
            $orders = order::skip(0)->take(10)->get();
            return view("client.product_cat",compact("products",'productcats','productcat','parent_id_product','id','fullPathBreakCum','displayProduct','orders'));
        }
        else
        {
            return  redirect("/");
        }
    }
    function price_arrangement($id,Request $request)
    {
        // echo "Hiển thị danh mục sản phẩm có cat-id là".$cat_id;
        if(productcat::where("id",$id)->get("parent_id")->count()>0)
        {
            $parentcat_id=productcat::where("id",$id)->get("parent_id");
            $rs_parentcat_id=$parentcat_id[0]->parent_id;;
    
            $productcat = productcat::where([["productcatStatus",'=',"Công khai"],['id','=',$id]])->get();
            $productcats = productcat::all();
            
    
            $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
            $breakcum[$productcat[0]->id]=$productcat[0]->productcatName;
    
            $fullPathBreakCum=$breakcum;
            
            switch($request->input("r-price")){
                case "under500": 
                    {
                        $products=product::where([["productStatus","Công khai"],["productPrice",'<','500000']])->get(); 
                        $request->session()->put('price_arrangement',"under500");
                        // return $request->session()->get("price_arrangement");
                    }
                break;
                case "between500tAndnd1m":
                    {
                        $products=product::where([["productStatus","Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->get(); 
                        $request->session()->put('price_arrangement',"between500tAndnd1m");
                    } 
                break;
                case "between1mAnd5m":
                    {
                        $products=product::where([["productStatus","Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->get(); 
                        $request->session()->put('price_arrangement',"between1mAnd5m");
                    } 
                break;
                case "between5mAnd10m": 
                    {
                        $products=product::where([["productStatus","Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->get(); 
                        $request->session()->put('price_arrangement',"between5mAnd10m");
                    }
                break;
                case "older10m": 
                    {
                        $products=product::where([["productStatus","Công khai"],["productPrice",'>','10000000']])->get(); 
                        $request->session()->put('price_arrangement',"older10m");
                    }
                break;
                default:$products=product::where("productStatus","Công khai")->get();  
            }
                // switch($request->input("select")){
                //     case "A-Z": $products= $products->sortBy("productName"); 
                //     break;
                //     case "Z-A":  $products= $products->sortByDesc("productName"); 
                //     break;
                //     case "hightPriceToLowPrice": $products=$products->orderBy("productPrice","DESC")->get(); 
                //     break;
                //     case "lowPriceToHightPrice": $products=$products->orderBy("productPrice","ASC")->get(); 
                //     break;
                //     default:;   
                // }
    
            $parent_id_product=data_tree($productcats,$id);
            if(count($parent_id_product)==0)
            {
                $id=$id;
            }
            //Show all producs part
            $displayProduct=array();
            $ok=0;
            $notOK=0;
            foreach($products as $product)
            {
                foreach($parent_id_product as $k=> $item)
                {
                    if($parent_id_product[$k]==$product['productcat_id'])
                    {
                        $ok=$ok+1;
                        $displayProduct[$ok]=[
                           'id'=>  $product->id,
                           'productThumb'=> $product->productThumb,
                           'productName'=> $product->productName,
                           'productPrice'=> $product->productPrice,
                           'productOldPrice'=> $product->productOldPrice,
                        ];
                    }
                }
            }
            //     @foreach ($products as $product)
            //     @foreach ($parent_id_product as $k=> $item)
            //        @if ($parent_id_product[$k]==$product['productcat_id'])
            //                 @php
            //                     $i=$i+1; 
            //                 @endphp
            //                 <li>
            //                     <a href="{{route('client.product.detail_product',$product->id)}}" title="" class="thumb">
            //                         <img src="{{$product->productThumb}}">
            //                     </a>
            //                     <a href="{{route('client.product.detail_product',$product->id)}}" title="" class="product-name">{{strlen($product->productName)>25?Str::of($product->productName)->substr(0,22)."...":$product->productName}}</a>
            //                     <div class="price">
            //                         <span class="new">{{number_format($product->productPrice,0,',',',')}}đ</span>
            //                         <span class="old">{{$product->productOldPrice==0?"":$product->productOldPrice."đ"}}</span>
            //                     </div>
            //                 </li>  
            //         @endif
            //     @endforeach
            // @endforeach
            return view("client.product_cat",compact("products",'productcats','productcat','parent_id_product','id','fullPathBreakCum','displayProduct'));
        }
        else
        {
            return  redirect("/");
        }
    }

    function detail_product($id,$slug)
    {
        // return "Product has ".$id." and has slug is ".$slug;
        if(product::where("id",$id)->get("productcat_id")->count()>0)
        {
            $productcat_id=product::where("id",$id)->get("productcat_id");
        $productcat_id_raw=$productcat_id[0]->productcat_id;
        $parentcat_id=productcat::where("id",$productcat_id_raw)->get("parent_id");
        $productcatCurrentName=productcat::where("id",$productcat_id_raw)->get();
        $productcatCurrentId=productcat::where("id",$productcat_id_raw)->get();
        $productcatCurrentNameRaw= $productcatCurrentName[0]->productcatName;
        $productcatCurrentNameId= $productcatCurrentName[0]->id;
        $parentcat_id_raw=$parentcat_id[0]->parent_id;

        $rs_parentcat_id=$parentcat_id_raw;
      

        $productcat = productcat::where([["productcatStatus",'=',"Công khai"],['id','=',$id]])->get();
        $productcats = productcat::all();
        
        $rs_parentcat_id_in_productcat_raw=$rs_parentcat_id;



        $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id_in_productcat_raw);
        $breakcum[$productcatCurrentNameId]=$productcatCurrentNameRaw;
        $fullPathBreakCum=$breakcum;

        $product=product::where('id','=',$id)->get();

       
        $productcats = productcat::all();

        #cùng chuyên mục
        $products=product::all();
        $product_cat=product::where("id",$id)->get("productcat_id");
        $product_cat_raw=$product_cat[0]->productcat_id;
        $products_to_show=product::where([["productcat_id",$product_cat_raw],['id','!=',$id]])->get();
        #---
        
        return view("client.detail_product",compact("productcats","product","fullPathBreakCum",'products_to_show'));
        }
        else
        {
            return  redirect("/");
        }
    }
    function test($id,$slug)
    {
        return "Product has ".$id." and has slug is ".$slug;
    }
}
