<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productcat;
use Illuminate\Http\Request;

class ClientSearchController extends Controller
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
        function filter($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"]])->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_a_z($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"]])->orderBy("productName","ASC")->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_z_a($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"]])->orderBy("productName","DESC")->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_height_to_low($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"]])->orderBy("productPrice","DESC")->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_low_to_height($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"]])->orderBy("productPrice","ASC")->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_under_500($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"],["productPrice",'<','500000']])->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_between500tAndnd1m($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"],["productPrice",'>=','500000'],["productPrice",'<=','1000000']])->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_between1mAnd5m($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"],["productPrice",'>=','1000000'],["productPrice",'<=','5000000']])->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_between5mAnd10m($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"],["productPrice",'>=','5000000'],["productPrice",'<=','10000000']])->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
        function filter_older10m($query)
        {
           $productcat_id_from_product=product::where("productName",'like',"%$query%")->get('productcat_id');
           if(count($productcat_id_from_product)>0)
           {
              for($i=0;$i<=count($productcat_id_from_product);$i++)
              {
                 $rs= $productcat_id_from_product[$i]->productcat_id;
                 break;
              }
              $products=product::where([["productcat_id",$rs],["productStatus",'=',"Công khai"],["productPrice",'>','10000000']])->get();
              $productcat_id=productcat::where('id',$rs)->get("parent_id");
              $rs_parentcat_id=$productcat_id[0]->parent_id;
              $productcats = productcat::all();
     
              $produdctcats_name=productcat::where('id',$rs)->get("productcatName");
              $rs_produdctcats_name=$produdctcats_name[0]->productcatName;
     
     
              $breakcum=data_tree_breakcum($productcats,$rs_parentcat_id);
  
              return view("client.product_list_from_searching",compact("products","breakcum",'rs_produdctcats_name','productcats'));
           }
           else
           {
              $productcats = productcat::all();
              return view("client._404_page",compact('productcats'));
           }
        }
    }
    function query(Request $request)
    {
        $request->validate(
            [
                'q' => 'required|min:4',      
            ],
            [
                'required' => 'Trường :attribute không được để trống',
            ],
            [
                'q' => 'tìm kiếm',
            ]
        );
         $query= $request->q;
         $request->session()->put('query',$query);

         return filter($query);
    }
    function filter(Request $request)
    {
        // return $request->input("option");
        $query= $request->session()->get('query');
        $option= $request->input("option");
        $price_option= $request->input("r-price");
        switch($option)
        {
            case 'tu-a-z':
                return   filter_a_z($query)
                ;
            break;
            case 'tu-z-a':
                return   filter_z_a($query)
                ;
            break;
            case "tu-cao-xuong-thap":
                return filter_height_to_low($query)
                ;
            break;
            case 'tu-thap-xuong-cao':
                return filter_low_to_height($query)
                ;
            break;
            default:0;
        }
        //-----------
        switch($price_option)
        {
            case 'under500':
                return   filter_under_500($query)
                ;
            break;
            case 'between500tAndnd1m':
                return   filter_between500tAndnd1m($query)
                ;
            break;
            case "between1mAnd5m":
                return filter_between1mAnd5m($query)
                ;
            break;
            case "between5mAnd10m":
                return filter_between5mAnd10m($query)
                ;
            break;
            case 'older10m':
                return filter_older10m($query)
                ;
            break;
            default:0;
        }

    }
}
