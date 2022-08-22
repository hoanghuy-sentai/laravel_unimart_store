<?php

namespace App\Http\Controllers;

use App\Models\polic;
use App\Models\police;
use App\Models\polices;
use App\Models\policies;
use App\Models\policy;
use App\Models\right;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Validation\Rules\Exists;
use Symfony\Component\Routing\Route;
use Illuminate\Support\Str;
class AdminRightController extends Controller
{
    //
    function add()
    {
        if (Gate::allows('add_right_model')) {

            // $t=User::find(1)->right->polices;
            // $t=User::find(1)->right->polices[0]->add;
            // $t=Auth::user()->right->polices;
            // return $t;  

            // $rewrite=Str::slug('Laravel/ 5 Framework', '/');
            // return $rewrite;

            return view("admin.right.add");
        
        } else {
              
                 abort(403);
              
         }
    }
    function delete($id)
    {
        if (Gate::allows('delete_right_model')) {

           right::where("id",$id)->delete();
           return redirect('/admin/right/list')->with('status', "Bạn đã xóa quyền thành công");
        } else {
              
                 abort(403);
              
         }
    }
    function createRight(Request $request)
    {
        if($request->input("btn-add")=="add new")
        {
            $request->validate(
                [
                    'nameOfRight' => 'required|string|max:255', 
                    'descriptionOfRight' => 'required|string|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'unique'=>':attribute đã được thiết lập'
                    // 'string' => 'Yêu cầu nhập chuỗi ký tự',
                    // 'max' => ':attribute có độ dài tối đa :max ký tự',
                    // 'image' => 'dữ liệu nhập vào phải là ảnh'
                ],
                [
                    'nameOfRight' => 'tên quyền',
                    'descriptionOfRight' => 'mô tả quyền',
                ]
            );
            $nameOfRight=$request->input("nameOfRight");
            $descriptionOfRight=$request->input("descriptionOfRight");
            $dateOfCreating= date("d/m/Y");

            right::create([
                'nameOfRight'=>$nameOfRight,
                'descriptionOfRight'=> $descriptionOfRight,
                'dateOfCreating'=>$dateOfCreating,
            ]);

            return redirect('/admin/right/list')->with('status', "Bạn đã thêm quyền thành công");
        }
    }
    function list()
    {
        if (Gate::allows('list_right_model')) {

            $rights = right::paginate(10);
            return view("admin.right.list", compact("rights"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function addPermisstion()
    {
        if (Gate::allows('add_right_model')) {

            $controllers = [];

            foreach (FacadesRoute::getRoutes()->getRoutes() as $route) {
                $action = $route->getAction();
    
                if (array_key_exists('controller', $action)) {
                    // You can also use explode('@', $action['controller']); here
                    // to separate the class name from the method
                    $controllers[] = $action['controller'];
                }
            }
            // dd($controllers);
            $rs=array();
            foreach ($controllers as $k=> $item) {
                // echo "<pre>";
                // print_r(substr($item, 0, 26));
                // echo "</pre>";
                if (substr($item, 0, 26) == "App\Http\Controllers\Admin") {
                    $subStr1 = str_replace('App\Http\Controllers\Admin', '', $item);
                    $subStr2 = str_replace('Controller', '', $subStr1);
    
                    $subStr2 = str_split($subStr2);
    
                    global $sig;
                    for ($i = 0; $i < count($subStr2); $i++) {
                        if ($subStr2[$i] == "@") {
                            //    echo $i;
                            // unset($subStr2[$i]);
                            $sig = $i;
                        }
                    }
                    $subStr2=implode("", $subStr2);
                    $subStr2=substr($subStr2, 0, $sig);
                    $subStr2=$subStr2;
                    $rs[]=$subStr2;
                }
            }
            $listModulNames=array_unique($rs);
            // echo "<pre>";
            // print_r($listModulNames);
            // echo "</pre>";
            return view("admin.right.addPermission",compact("listModulNames"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function edit($id)
    {
        if (Gate::allows('edit_right_model')) {

            $rights=right::where("id",$id)->get();
            $data=polices::where("right_id",$id)->get();
            // return $data;
            return view("admin.right.edit",compact("data",'rights'));
        
        } else {
              
                 abort(403);
              
         }
    }
    function update($id,Request $request)
    {
        if($request->input("btn-update")=="update")
        {
            // $request->validate(
            //     [
            //         'nameOfRight' => 'required|max:255',
            //         'descriptionOfRight'=>'required|max:255' ,
            //         // 'slideTitle' => 'required|string|max:255',
            //     ],
            //     [
            //         'required' => 'Trường :attribute không được để trống',
            //         // 'unique'=>':attribute đã được thiết lập'
            //         // 'string' => 'Yêu cầu nhập chuỗi ký tự',
            //         // 'max' => ':attribute có độ dài tối đa :max ký tự',
            //         // 'image' => 'dữ liệu nhập vào phải là ảnh'
            //     ],
            //     [
            //         'nameOfRight' => 'tên quyền',
            //         'descriptionOfRight'=>'mô tả quyền'
            //         // 'slideTitle' => 'tiêu đề slide',
            //     ]
            // );

            // $list=$request->input("list")!=null?$request->input("list"):0;
            // $add=$request->input("add")!=null?$request->input("add"):0;
            // $edit=$request->input("edit")!=null?$request->input("edit"):0;
            // $delete=$request->input("delete")!=null?$request->input("delete"):0;

            $polices=polices::all();
            foreach($polices as $item)
            {
                polices::where([["right_id",$id],["moduleName",$item->moduleName]])->update([
                    'moduleName'=>$item->moduleName,
                    'list'=>isset($request->input($item->moduleName)['list'])?$request->input($item->moduleName)['list']:0,
                    'add'=>isset($request->input($item->moduleName)['add'])?$request->input($item->moduleName)['add']:0,
                    'edit'=>isset($request->input($item->moduleName)['edit'])?$request->input($item->moduleName)['edit']:0,
                    'delete'=>isset($request->input($item->moduleName)['delete'])?$request->input($item->moduleName)['delete']:0,
                ]);
            }

            // return $request->all();
            // return $request->input("User");

            right::where('id',$id)->update([
                'nameOfRight'=>$request->input('nameOfRight'),
                'descriptionOfRight'=>$request->input('descriptionOfRight'),
            ]);


            return redirect('/admin/right/list')->with('status', "Bạn đã cập nhật permission thành công");
        }
    }
    function createPermisstion(Request $request)
    {
        // return $request->all();
        if($request->input("btn-add")=="add new")
        {
            $request->validate(
                [
                    'moduleName' => 'required|unique:polices', 
                    // 'slideTitle' => 'required|string|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'unique'=>':attribute đã được thiết lập'
                    // 'string' => 'Yêu cầu nhập chuỗi ký tự',
                    // 'max' => ':attribute có độ dài tối đa :max ký tự',
                    // 'image' => 'dữ liệu nhập vào phải là ảnh'
                ],
                [
                    'moduleName' => 'module',
                    // 'slideTitle' => 'tiêu đề slide',
                ]
            );
            $list=$request->input("list")!=null?$request->input("list"):0;
            $add=$request->input("add")!=null?$request->input("add"):0;
            $edit=$request->input("edit")!=null?$request->input("edit"):0;
            $delete=$request->input("delete")!=null?$request->input("delete"):0;

            $rights= right::all();
            foreach($rights as $item)
            {
                polices::create([
                    'moduleName'=>$request->input("moduleName"),
                    'user_id'=>null,
                     'list'=>$list,
                     'add'=>$add,
                     'edit'=>$edit,
                     'delete'=>$delete, 
                     'right_id'=>$item->id,
                ]);
            }
            return redirect('/admin/right/addPermisstion')->with('status', "Bạn đã thêm permission thành công");
        }
    }
}
