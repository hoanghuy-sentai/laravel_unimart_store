<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productcat;
use App\Models\producttype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminProductController extends Controller
{
    //\
    function __construct()
    {
        // if(!isset(Auth::user()->name))
        // {
        //     $this->middleware("auth");
        // }
        function data_tree($data, $parent_id = 0, $level = 0)
        {
            $result = [];
            foreach ($data as $item) {
                if ($item['parent_id'] == $parent_id) {
                    $item['level'] = $level;
                    $result[] = $item;
                    $child = data_tree($data, $item['id'], $level + 1);
                    $result = array_merge($result, $child);
                }
            }
            return $result;
        }
    }
    function listcat()
    {
        if (Gate::allows('list_product_model')) {

            $productcats = productcat::paginate(10);
            $listProductcats = data_tree(productcat::all());
            // $parent_cats = productcat::where("parent_id", '=', '0')->get();
            return view("admin.product.cat.list", compact("productcats", "listProductcats"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function createNewProductCat(Request $request)
    {
        if ($request->input("btn-add")) {
            $request->validate(
                [
                    'productcatName' => 'required|string|min:1|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'min' => ':attribute có độ dài tối thiểu :min ký tự',
                ],
                [
                    'productcatName' => 'tên danh mục',
                ]
            );
            productcat::create(
                [
                    "productcatName" => $request->input("productcatName"),
                    "productQty" => 0,
                    "productcatStatus" => $request->input("productcatStatus"),
                    "productcatTime" => date("d/m/Y"),
                    'productcatCreate' => Auth::user()->name,
                    "parent_id" => $request->input("parent_id"),
                    'no' => 0,
                ]
            );
        }
        return redirect("admin/product/cat/list")->with("status", "Bạn vừa thêm danh mục mới thành công");
    }
    function edit($id)
    {
        if (Gate::allows('edit_product_model')) {

            $data = productcat::where("id", "=", $id)->get();
            $productcats = productcat::paginate(10);
            $listProductcats = data_tree(productcat::all());
            return view("admin.product.cat.edit", compact("productcats", "listProductcats", "data"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function update(Request $request, $id)
    {
        if ($request->input("btn-update")) {
            $request->validate(
                [
                    'productcatName' => 'required|string|min:1|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'min' => ':attribute có độ dài tối thiểu :min ký tự',
                ],
                [
                    'productcatName' => 'tên danh mục',
                ]
            );
            productcat::find($id)->update(
                [
                    'productcatName' => $request->input("productcatName"),
                    // 'productQty' => $request->input("productQty"),
                    'productcatStatus' => $request->input("productcatStatus"),
                    'productcatCreate' => Auth::user()->name,
                    'catTime' => date("d/m/Y"),
                    'parent_id' => $request->input("parent_id"),
                ]
            );
        }
        return redirect("admin/product/cat/list")->with("status", "Bạn vừa cập nhật danh mục mới thành công");
    }
    function delete($id)
    {
        if (Gate::allows('delete_product_model')) {

            productcat::where('id','=',$id)->delete();
            return redirect("admin/product/cat/list")->with("status", "Bạn vừa xóa danh mục thành công");
        
        } else {
              
                 abort(403);
              
         }
    }
    function list(Request $request)
    {
        if (Gate::allows('list_product_model')) {

            $status = $request->input("status");
            $actions = ['temp_delete' => 'Xóa tạm thời'];
            if ($status == "trash") {
                $products = product::onlyTrashed()->paginate(5);
                $actions = ['per_delete' => 'Xóa vĩnh viễn', 'restore' => 'Khôi phục'];
            } else {
                $keyword = $request->input("searchData");
                $products = product::where('productName', 'like', "%{$keyword}%")->paginate(5);
            }
            $count_active = product::all()->count();
            $count_trash = product::onlyTrashed()->get()->count();
            $count = [$count_active, $count_trash];
            return view("admin.product.list", compact("products", "count", "actions"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function excecute(Request $request)
    {
        $act = $request->input("act");
        $lischeck = $request->input("listcheck");
        if ($lischeck) {
            // return $request->input("act");
            switch ($act) {
                case 'temp_delete':
                    product::destroy($lischeck);
                    return redirect("admin/product/list")->with("status", "Bạn đã xóa  thành công");
                    break;
                case 'per_delete':
                    if (Gate::allows('delete_product_model')) {
                        product::whereIn("id", $lischeck)->forceDelete();
                        return redirect("admin/product/list")->with("status", "Bạn đã xóa vĩnh viễn bản ghi thành công");
                        break;
                    } else {
                          
                             abort(403);
                          
                     }
                case 'restore':
                    product::whereIn("id", $lischeck)->restore();
                    return redirect("admin/product/list")->with("status", "Bạn đã khôi phục bản ghi thành công");
                    break;
                default:
                    return redirect("admin/product/list")->with("status", "Bạn chưa chọn thao tác nào cả");
            }
        } else
            return redirect("admin/product/list")->with("status", "Bạn chưa tích chọn bản ghi nào");
    }
    function productEdit($id)
    {
        if (Gate::allows('edit_product_model')) {
            $actions=['change'=>'Đổi vị trí ảnh chi tiết sản phẩm','delete'=>'Xóa ảnh chi tiết sản phẩm','insert'=>"Chèn ảnh chi tiết sản phẩm"];
            $listProductcats =data_tree(productcat::all());
            $data = product::where("id", "=", $id)->get();
            return view("admin.product.edit", compact("listProductcats", "data","actions"));
        } else {
              
                 abort(403);
              
         }
    }
    function productDelete($id)
    {
        if (Gate::allows('delete_product_model')) {
            product::find($id)->delete();
            return redirect("admin/product/list")->with("status", "Bạn vừa xóa sản phẩm thành công");  
        } else {
              
                 abort(403);
              
         }
    }
    function add(Request $request)
    {
        if (Gate::allows('add_product_model')) {
            $listProductcats =data_tree(productcat::all());
            return view("admin.product.add", compact("listProductcats"));
        } else {
              
                 abort(403);
              
         }
    }
    function productCreate(Request $request)
    {
        // $file2=$request->file("productDetailThumb");
        // $result=[];
        // foreach ($file2 as $file) {
        //     $file->move("public/uploads", $file->getClientOriginalName());
        //     $result[]= $file->getClientOriginalName();
        // }
        // return implode(",",$result);
        if ($request->input("btn-add")) {
            $request->validate(
                [
                    'productThumb' => 'file|image',
                    // 'productDetailThumb'=>'required',
                    'productName' => 'required|string|min:1|max:60',
                    'productDesc' => 'required|string|min:1',
                    'productShortDesc'=>'required|string|min:1',
                    'productPrice' => 'required|integer',
                    'productOldPrice'=>'integer',
                    'productQty' => 'required|integer',
                    'productDiscount' => 'required|integer',
                    'productcat_id' => 'required',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'file' => 'dữ liệu nhập vào dạng file',
                    'image' => 'dữ liệu nhập vào phải là file ảnh(jpeg,png,bmp,gif...)',
                    'integer' => ':attribute phải là số',
                    'max'=>':attribute không được lớn hơn :max ký tự'
                ],
                [
                    'productThumb' => 'ảnh',
                    // 'productDetailThumb'=>'ảnh chi tiết sản phẩm',
                    'productName' => 'tên sản phẩm',
                    'productDesc' => 'mô tả về sản phẩm',
                    'productShortDesc'=>'mô tả ngắn về sản phẩm',
                    'productPrice' => 'giá sản phẩm',
                    'productOldPrice'=>'giá sản phẩm cũ',
                    'productQty' => 'số lượng sản phẩm',
                    'productDiscount' => 'giảm giá giá sản phẩm',
                    'productcat_id' => "danh mục sản phẩm",
                ]
            );
            if ($request->hasFile("productThumb")&&$request->hasFile("productDetailThumb")) {
                $file = $request->productThumb;
                $filename = $file->getClientOriginalName();
                $file->move(base_path("/storage/photos/1/products"), $filename);

                $file2=$request->file("productDetailThumb");
                $result=[];
                foreach ($file2 as $file) {
                    $file->move(base_path("/storage/photos/1/products"), $file->getClientOriginalName());
                    $result[]= '../storage/photos/1//products/'.'/'.$file->getClientOriginalName();
                }
               
                product::create([
                    // 'productThumb' => 'public/uploads/' . $filename,
                    'productThumb' =>'../storage/photos/1//products/'.'/'.$filename,
                    'productDetailThumb'=>implode(",",$result),
                    'productName' => $request->input('productName'),
                    'productDesc' => $request->input("productDesc"),
                    'productShortDesc'=>$request->input('productShortDesc'),
                    'productPrice' => $request->input('productPrice'),
                    'productQty' => $request->input('productQty'),
                    'productDiscount' => $request->input('productDiscount'),
                    'productcat_id' => $request->input('productcat_id'),
                    'user_id' => Auth::user()->id,
                    'productTime' => date("d/m/Y"),
                    'productStatus' => $request->input('productStatus'),
                    'productFeature' => $request->input('productFeature'),
                    'productType'=>$request->input("producttype_id"),
                ]);
                return redirect("admin/product/list")->with("status", "Bạn đã thêm sản phẩm thành công");
            }
        }
    }
    function productUpdate($id, Request $request)
    {
        if ($request->input("btn-update")) {
            $request->validate(
                [
                    'productThumb' => 'file|image',
                    // 'productDetailThumb'=>'required',
                    'productName' => 'required|string|min:1|max:60',
                    'productDesc' => 'required|string|min:1',
                    'productShortDesc'=>'required|string|min:1',
                    'productPrice' => 'required|integer',
                    'productOldPrice'=>'integer',
                    'productQty' => 'required|integer',
                    'productDiscount' => 'required|integer',
                    'productcat_id' => 'required',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'file' => 'dữ liệu nhập vào dạng file',
                    'image' => 'dữ liệu nhập vào phải là file ảnh(jpeg,png,bmp,gif...)',
                    'integer' => ':attribute phải là số',
                    'max'=>':attribute không được lớn hơn :max ký tự'
                ],
                [
                    'productThumb' => 'ảnh',
                    // 'productDetailThumb'=>'ảnh chi tiết sản phẩm',
                    'productName' => 'tên sản phẩm',
                    'productDesc' => 'mô tả về sản phẩm',
                    'productShortDesc'=>'mô tả ngắn về sản phẩm',
                    'productPrice' => 'giá sản phẩm',
                    'productOldPrice'=>'giá sản phẩm cũ',
                    'productQty' => 'số lượng sản phẩm',
                    'productDiscount' => 'giảm giá giá sản phẩm',
                    'productcat_id' => "danh mục sản phẩm",
                ]
            );
            if ($request->hasFile("productThumb") && $request->hasFile("productDetailThumb")) {
                $file = $request->productThumb;
                $filename = $file->getClientOriginalName();
                $file->move(base_path("/storage/photos/1/products"), $filename);
                  
                $file2=$request->file("productDetailThumb");
                $result=[];
                foreach ($file2 as $file) {
                    $file->move(base_path("/storage/photos/1/products"), $file->getClientOriginalName());
                    $result[]= '../storage/photos/1//products/'.'/'.$file->getClientOriginalName();
                    // $result[]= str_replace('/unimart/public',"/unimart",asset('/storage/photos/1/products/')).'/'.$file->getClientOriginalName();
                }
                // return str_replace('/unimart/public',"/unimart",asset("storage/app/public/photos/1/ ")); 
                // return asset("d");
                product::find($id)->update([
                    'productThumb' => '../storage/photos/1//products/'.'/'.$filename,
                    'productDetailThumb'=>implode(",",$result),
                    'productName' => $request->input('productName'),
                    'productDesc' => $request->input("productDesc"),
                    'productShortDesc'=>$request->input('productShortDesc'),
                    'productDiscount' => $request->input("productDiscount"),
                    'productQty' => $request->input("productQty"),
                    'productPrice' => $request->input("productPrice"),
                    'productcat_id' => $request->input('productcat_id'),
                    'user_id' => Auth::user()->id,
                    'productTime' => date("d/m/Y"),
                    'productStatus' => $request->input('productStatus'),
                    'productFeature' => $request->input('productFeature')
                ]);
                return redirect("admin/product/list")->with("status", "Bạn đã cập nhật sản phẩm thành công");
            }
            if ($request->hasFile("productThumb")) {
                $file = $request->productThumb;
                $filename = $file->getClientOriginalName();
                $file->move(base_path("/storage/photos/1/products"), $filename);
                  
                // $file2=$request->file("productDetailThumb");
                // $result=[];
                // foreach ($file2 as $file) {
                //     $file->move(base_path("storage/app/public/photos/1"), $file->getClientOriginalName());
                //     $result[]= str_replace('/unimart/public',"/unimart",asset('storage/app/public/photos/1/')).'/'.$file->getClientOriginalName();
                // }
                // return str_replace('/unimart/public',"/unimart",asset("storage/app/public/photos/1/ ")); 
                // return asset("d");
                product::find($id)->update([
                    'productThumb' => '../storage/photos/1//products/'.'/'.$filename,
                    'productDetailThumb'=>str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdproductDetailThumb")),
                    'productName' => $request->input('productName'),
                    'productDesc' => $request->input("productDesc"),
                    'productShortDesc'=>$request->input('productShortDesc'),
                    'productDiscount' => $request->input("productDiscount"),
                    'productQty' => $request->input("productQty"),
                    'productPrice' => $request->input("productPrice"),
                    'productcat_id' => $request->input('productcat_id'),
                    'user_id' => Auth::user()->id,
                    'productTime' => date("d/m/Y"),
                    'productStatus' => $request->input('productStatus'),
                    'productFeature' => $request->input('productFeature')
                ]);
                return redirect("admin/product/list")->with("status", "Bạn đã cập nhật sản phẩm thành công");
            }
            if($request->hasFile("productDetailThumb")&&$request->input("act")=='choose'){
                // $file = $request->productThumb;
                // $filename = $file->getClientOriginalName();
                // $file->move(base_path("storage/app/public/photos/1"), $filename);
                  
                $file2=$request->file("productDetailThumb");
                $result=[];
                foreach ($file2 as $file) {
                    $file->move(base_path("/storage/photos/1/products"), $file->getClientOriginalName());
                    $result[]= '../storage/photos/1//products/'.'/'.$file->getClientOriginalName();
                }
                // return str_replace('/unimart/public',"/unimart",asset("storage/app/public/photos/1/ ")); 
                // return asset("d");
                product::find($id)->update([
                    'productThumb' =>str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdproductThumb")),
                    'productDetailThumb'=>implode(",",$result),
                    'productName' => $request->input('productName'),
                    'productDesc' => $request->input("productDesc"),
                    'productShortDesc'=>$request->input('productShortDesc'),
                    'productDiscount' => $request->input("productDiscount"),
                    'productQty' => $request->input("productQty"),
                    'productPrice' => $request->input("productPrice"),
                    'productcat_id' => $request->input('productcat_id'),
                    'user_id' =>Auth::user()->id,
                    'productTime' => date("d/m/Y"),
                    'productStatus' => $request->input('productStatus'),
                    'productFeature' => $request->input('productFeature')
                ]);
                return redirect("admin/product/list")->with("status", "Bạn đã cập nhật sản phẩm thành công");
            }
            if ($request->hasFile("productDetailThumb")&&$request->input("act")) {
                $productDetailThumb= explode(',',$request->input("hdproductDetailThumb"));
                $acts= $request->input("act");
                $result=[];
                $list_check=$request->input("productDetailThumb");

                if($acts=="insert")
                {
                    if ($request->hasFile("productDetailThumb"))
                    {
                        $file2=$request->file("productDetailThumb");
                        $result=[];
                        foreach ($file2 as $file) {
                            $file->move(base_path("/storage/photos/1/products"),$file->getClientOriginalName());
                            // $file->move("storage/app/public/photos/1", $file->getClientOriginalName());
                            $result[]= '../storage/photos/1//products/'.'/'.$file->getClientOriginalName();
                        }
                        $productDetailThumb[]=implode(",",$result);
                        $allFiles= implode(",", $productDetailThumb);
    
                        $productDetailThumb=$allFiles;

                        // $result = str_replace('lap trinh', 'php', 'hoc lap trinh tai freetuts.net');
                        // echo $result;
                        $productDetailThumb= $productDetailThumb;
                        $length=strlen($productDetailThumb);
                        for($i=0;$i<$length;$i++)
                        {
                            if($productDetailThumb[$i]==',')
                                $productDetailThumb[$i]=" ";
                            break;
                        }
                        $productDetailThumb= str_replace(' ','',$productDetailThumb);
                        // return  $productDetailThumb;
                        // $productDetailThumb= substr($productDetailThumb,1);
                    }
                    else return redirect()->back()->with('status',"Chưa chọn bất kỳ file nào trên ổ đĩa của bạn");

                   
                }
                else if($list_check)
                {
                    switch($acts)
                    {
                        case "change":
                            if(count($list_check)>2)
                            {
                                return redirect()->back()->with('status',"Chỉ chọn được 2 ảnh");
                            }
                            else if(count($list_check)==1)
                            {
                                return redirect()->back()->with('status',"Bạn chưa chọn đủ ảnh");
                            }
                            else
                            {
                            //    return  $list_check; 0  3
                            //    $list_pic_check= $productDetailThumb;

                               $x= $productDetailThumb[$list_check[0]];
                               $y= $productDetailThumb[$list_check[1]];
                               
                               $productDetailThumb[$list_check[0]]=$y;
                               $productDetailThumb[$list_check[1]]=$x;

                            //    return  $productDetailThumb;

                                // implode(",",$productDetailThumb);
                                // return   implode(",",$productDetailThumb);
                                $productDetailThumb= implode(",",$productDetailThumb);
                            }
                            ;
                        break;
                        case "delete":
                            foreach($list_check as  $item)
                            {
                            //    unset($productDetailThumb[$item]);
                            //    unlink($productDetailThumb[$item]);
                               $filename= $filename= str_replace('../public/','',$productDetailThumb[$item]);
                               $path=storage_path($filename);
                               unlink($path);
                               unset($productDetailThumb[$item]);
                            }
                            if(count($productDetailThumb)==0)
                                 $productDetailThumb=null;
                            else
                                 $productDetailThumb=implode(",",$productDetailThumb);
                            

                            ;
                        break;
                        default:return redirect()->back()->with('status',"Bạn chưa chọn thao tác nào cả");
                    }
                }
                else
                    return "Bạn chưa chọn ảnh nào,hoặc bạn chưa chọn thao tác nào cả";

                product::find($id)->update([
                    'productThumb' =>  str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdproductThumb")),
                    'productDetailThumb'=>str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$productDetailThumb),
                    'productName' => $request->input('productName'),
                    'productDesc' => $request->input("productDesc"),
                    'productShortDesc'=>$request->input('productShortDesc'),
                    'productDetailDesc' => $request->input("productDetailDesc"),
                    'productDiscount' => $request->input("productDiscount"),
                    'productQty' => $request->input("productQty"),
                    'productPrice' => $request->input("productPrice"),
                    'productcat_id' => $request->input('productcat_id'),
                    'user_id' => Auth::user()->id,
                    'productTime' => date("d/m/Y"),
                    'productStatus' => $request->input('productStatus'),
                    'productFeature' => $request->input('productFeature')
                ]);
                // return redirect(route("product.update",$id))->with("status", "Bạn đã cập nhật sản phẩm thành công");
                // return redirect::to->with("status", "Bạn đã cập nhật sản phẩm thành công");
                // return redirect()->back()->withMessage('Profile saved!');
                return redirect()->back()->with('status',"Cập nhật thành công");
            }
            if ($request->input("productDetailThumb")&&$request->input("act")) {
                $productDetailThumb= explode(',',$request->input("hdproductDetailThumb"));
                $acts= $request->input("act");
                $result=[];
                $list_check=$request->input("productDetailThumb");

                if($acts=="insert")
                {
                    if ($request->hasFile("productDetailThumb"))
                    {
                        $file2=$request->file("productDetailThumb");
                        $result=[];
                        foreach ($file2 as $file) {
                            $file->move(base_path("/storage/photos/1/products"),$file->getClientOriginalName());
                            // $file->move("storage/app/public/photos/1", $file->getClientOriginalName());
                            $result[]= $result[]= '../storage/photos/1/products/'.'/'.$file->getClientOriginalName();
                        }
                        $productDetailThumb[]=implode(",",$result);
                        $allFiles= implode(",", $productDetailThumb);
    
                        $productDetailThumb=$allFiles;

                        // $result = str_replace('lap trinh', 'php', 'hoc lap trinh tai freetuts.net');
                        // echo $result;
                        $productDetailThumb= $productDetailThumb;
                        $length=strlen($productDetailThumb);
                        for($i=0;$i<$length;$i++)
                        {
                            if($productDetailThumb[$i]==',')
                                $productDetailThumb[$i]=" ";
                            break;
                        }
                        $productDetailThumb= str_replace(' ','',$productDetailThumb);
                        // return  $productDetailThumb;
                        // $productDetailThumb= substr($productDetailThumb,1);
                    }
                    else return redirect()->back()->with('status',"Chưa chọn bất kỳ file nào trên ổ đĩa của bạn");

                   
                }
                else if($list_check)
                {
                    switch($acts)
                    {
                        case "change":
                            if(count($list_check)>2)
                            {
                                return redirect()->back()->with('status',"Chỉ chọn được 2 ảnh");
                            }
                            else if(count($list_check)==1)
                            {
                                return redirect()->back()->with('status',"Bạn chưa chọn đủ ảnh");
                            }
                            else
                            {
                            //    return  $list_check; 0  3
                            //    $list_pic_check= $productDetailThumb;

                               $x= $productDetailThumb[$list_check[0]];
                               $y= $productDetailThumb[$list_check[1]];
                               
                               $productDetailThumb[$list_check[0]]=$y;
                               $productDetailThumb[$list_check[1]]=$x;

                            //    return  $productDetailThumb;

                                // implode(",",$productDetailThumb);
                                // return   implode(",",$productDetailThumb);
                                $productDetailThumb= implode(",",$productDetailThumb);
                            }
                            ;
                        break;
                        case "delete":
                            foreach($list_check as  $item)
                            {
                                // return str_replace('http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/storage/app/public/photos/1/','',$productDetailThumb[$item]);
                                $filename= str_replace('../public/','',$productDetailThumb[$item]);
                                // $filename= str_replace('../storage/photos/1/products','',$productDetailThumb[$item]);
                                // return str_replace('http://','',asset($filename));
                                // return storage_path($filename);
                                // return storage_path('d');

                                // $path=str_replace('http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/s','s',$productDetailThumb[$item]);
                                //   $path=$productDetailThumb[$item];
                                // http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/storage/app/public/photos/1/peaceful.png
                                //    return $path=str_replace(" ",'',storage_path("app\public\photos\ 1\ ".$filename));

                               $path=storage_path($filename);
                            //    $path=str_replace(" ",'',storage_path("app\public\photos\ 1\products".$filename));
                               unlink($path);
                               unset($productDetailThumb[$item]);
                            }
                            if(count($productDetailThumb)==0)
                                 $productDetailThumb=null;
                            else
                             $productDetailThumb=implode(",",$productDetailThumb);
                           
                            ;
                        break;
                        default:return redirect()->back()->with('status',"Bạn chưa chọn thao tác nào cả");
                    }
                }
                else
                    return "Bạn chưa chọn ảnh nào,hoặc bạn chưa chọn thao tác nào cả";

                product::find($id)->update([
                    'productThumb' =>  str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdproductThumb")),
                    'productDetailThumb'=>str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$productDetailThumb) ,
                    'productName' => $request->input('productName'),
                    'productDesc' => $request->input("productDesc"),
                    'productShortDesc'=>$request->input('productShortDesc'),
                    'productDetailDesc' => $request->input("productDetailDesc"),
                    'productDiscount' => $request->input("productDiscount"),
                    'productQty' => $request->input("productQty"),
                    'productPrice' => $request->input("productPrice"),
                    'productcat_id' => $request->input('productcat_id'),
                    'user_id' =>Auth::user()->id,
                    'productTime' => date("d/m/Y"),
                    'productStatus' => $request->input('productStatus'),
                    'productFeature' => $request->input('productFeature')
                ]);
                // return redirect(route("product.update",$id))->with("status", "Bạn đã cập nhật sản phẩm thành công");
                // return redirect::to->with("status", "Bạn đã cập nhật sản phẩm thành công");
                // return redirect()->back()->withMessage('Profile saved!');
                return redirect()->back()->with('status',"Cập nhật thành công");
            }
            product::find($id)->update([
                'productThumb' =>  str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdproductThumb")),
                'productDetailThumb'=>str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdproductDetailThumb")) ,
                'productName' => $request->input('productName'),
                'productDesc' => $request->input("productDesc"),
                'productShortDesc'=>$request->input('productShortDesc'),
                'productDetailDesc' => $request->input("productDetailDesc"),
                'productDiscount' => $request->input("productDiscount"),
                'productQty' => $request->input("productQty"),
                'productPrice' => $request->input("productPrice"),
                'productcat_id' => $request->input('productcat_id'),
                'user_id' => Auth::user()->id,
                'productTime' => date("d/m/Y"),
                'productStatus' => $request->input('productStatus'),
                'productFeature' => $request->input('productFeature')
            ]);
            return redirect("admin/product/list")->with("status", "Bạn đã cập nhật thành công");
        }
    }
}
