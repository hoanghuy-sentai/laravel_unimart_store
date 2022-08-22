<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\postcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class AdminPostController extends Controller
{
    //
    function __construct()
    {
        function data_tree($data,$parent_id=0,$level=0)
        {
            $result=[];
            foreach($data as $item)
            {
                if($item['parent_id']==$parent_id)
                {
                    $item['level']=$level;
                    $result[]=$item;
                    $child=data_tree($data,$item['id'],$level+1);
				    $result=array_merge($result,$child);
                }
            }
            return $result;
        }
    }
    function list(Request $request)
    {
        if (Gate::allows('list_post_model')) {

            $status = $request->input("status");
            $actions = ['temp_delete' => 'Xóa tạm thời'];
            if ($status == "trash") {
                $posts = post::onlyTrashed()->paginate(5);
                $actions = ['per_delete' => 'Xóa vĩnh viễn', 'restore' => 'Khôi phục'];
            } else {
                $keyword = $request->input("searchData");
                $posts = post::where('postTitle', 'like', "%{$keyword}%")->paginate(5);
            }
            $count_active = post::all()->count();
            $count_trash = post::onlyTrashed()->get()->count();
            $count = [$count_active, $count_trash];
            return view("admin.post.list", compact("posts", "count", "actions"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function listcat()
    {
        if (Gate::allows('list_post_model')) {

            $list_postcats = postcat::all();
            $listPostcats=data_tree($list_postcats);
            $postcats = postcat::paginate(10);
            // $list_postcats = postcat::all();
            // return $parent_cats[0]->id;
            // $parent_cats_with_id=[];
            return view("admin.post.cat.list", compact("postcats","listPostcats"));
        
        } else {
              
                 abort(403);
              
         }

    }
    function createListCat(Request $request)
    {
        if ($request->input("btn-add")) {
            $request->validate(
                [
                    'catName' => 'required|string|min:1|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'min' => ':attribute có độ dài tối thiểu :min ký tự',
                ],
                [
                    'catName' => 'tên danh mục',
                ]
            );
            postcat::create(
                [
                    'catName' => $request->input("catName"),
                    'qtyPost' => $request->input("qtyPost"),
                    'catStatus' => $request->input("catStatus"),
                    'catCreate' => Auth::user()->id,
                    'catTime' => date("d/m/Y"),
                    'parent_id' => $request->input("parent_id"),
                ]
            );
        }
        return redirect("admin/post/cat/list")->with("status", "Bạn vừa thêm danh mục mới thành công");
    }
    function delete($id)
    {
        if (Gate::allows('delete_post_model')) {

            postcat::find($id)->delete();
            return redirect("admin/post/cat/list")->with("status", "Bạn vừa xóa danh mục thành công"); 
        
        } else {
              
                 abort(403);
              
         }
      
    }
    function edit($id)
    {
        if (Gate::allows('edit_post_model')) {

             // function data_tree($data,$parent_id=0,$level=0)
            // {
            //     $result=[];
            //     foreach($data as $item)
            //     {
            //         if($item['parent_id']==$parent_id)
            //         {
            //             $item['level']=$level;
            //             $result[]=$item;
            //             $child=data_tree($data,$item['id'],$level+1);
            // 		    $result=array_merge($result,$child);
            //         }
            //     }
            //     return $result;
            // }
            $list_postcats = postcat::all();
            $listPostcats=data_tree($list_postcats);
            $data = postcat::where("id", "=", $id)->get();
            $postcats = postcat::paginate(5);
            return view("admin.post.cat.edit", compact("postcats","listPostcats", "data"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function update(Request $request, $id)
    {
        if ($request->input("btn-update")) {
            $request->validate(
                [
                    'catName' => 'required|string|min:1|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'min' => ':attribute có độ dài tối thiểu :min ký tự',
                ],
                [
                    'catName' => 'tên danh mục',
                ]
            );
            postcat::find($id)->update(
                [
                    'catName' => $request->input("catName"),
                    'qtyPost' => $request->input("qtyPost"),
                    'catStatus' => $request->input("catStatus"),
                    'catCreate' => Auth::user()->id,
                    'catTime' => date("d/m/Y"),
                    'parent_id' => $request->input("parent_id"),
                ]
            );
        }
        return redirect("admin/post/cat/list")->with("status", "Bạn vừa cập nhật danh mục mới thành công");
    }
    function postDelete(Request $request, $id)
    {
        if (Gate::allows('delete_post_model')) {
            post::find($id)->delete();
            return redirect("admin/post/list")->with("status", "Bạn vừa xóa bài viết thành công");
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
                    post::destroy($lischeck);
                    return redirect("admin/post/list")->with("status", "Bạn đã xóa  thành công");
                    break;
                case 'per_delete':
                    if (Gate::allows('delete_post_model')) {

                        post::whereIn("id", $lischeck)->forceDelete();
                        return redirect("admin/post/list")->with("status", "Bạn đã xóa vĩnh viễn bản ghi thành công");
                        break;
        
                    } else {
                          
                             abort(403);
                          
                     }
                case 'restore':
                    post::whereIn("id", $lischeck)->restore();
                    return redirect("admin/post/list")->with("status", "Bạn đã khôi phục bản ghi thành công");
                    break;
                default:
                    return redirect("admin/post/list")->with("status", "Bạn chưa chọn thao tác nào cả");
            }
        } else
            return redirect("admin/post/list")->with("status", "Bạn chưa tích chọn bản ghi nào");
    }
    function postAdd()
    {
        if (Gate::allows('add_post_model')) {

            $listPostcats = postcat::get();
            return view("admin.post.add", compact("listPostcats"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function postCreate(Request $request)
    {
        if ($request->input("btn-add")) {
            $request->validate(
                [
                    'postcat_id'=>'required',
                    'postDes'=>'required|max:376',
                    'postThumb' => 'required|file|image',
                    'postTitle' => 'required|string|min:1|max:255',
                    'postContent' => 'required|string|min:1',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'file' => 'dữ liệu nhập vào dạng file',
                    'image' => 'dữ liệu nhập vào phải là file ảnh(jpeg,png,bmp,gif...)',
                    'max'=>'Trường :attribute cần nhập tối đa :max ký tự'
                ],
                [
                    'catName'=>'danh mục bài viết',
                    'postThumb' => 'ảnh',
                    'postDes'=>'mô tả bải viết',
                    'postTitle' => 'tiêu đề bải viết',
                    'postContent' => 'nội dung bài viết',
                ]
            );
            // if ($request->input("postcat_id") == "none") {
            //     return redirect("admin/post/add")->with("status", "Bạn chưa chọn danh mục nào");
            // }
            if ($request->hasFile("postThumb")) {
                $file = $request->postThumb;
                $filename = $file->getClientOriginalName();
                $file->move(base_path("/storage/photos/1/posts"), $filename);
                post::create([
                    'postThumb' => '../storage/photos/1/posts/'.'/'.$filename,
                    'postTitle' => $request->input('postTitle'),
                    'postDes'=>$request->input('postDes'),
                    'postContent' => $request->input("postContent"),
                    'postcat_id' => $request->input('postcat_id'),
                    'user_id' => Auth::user()->id,
                    'postTime' => date("d/m/Y"),
                ]);
                return redirect("admin/post/list")->with("status", "Bạn đã thêm bài viết thành công");
            }
        }
    }
    function postEdit($id)
    {
        if (Gate::allows('edit_post_model')) {

            // $listcats = postcat::all();
            $listPostcats =data_tree(postcat::all());
            $data = post::find($id);
            // return $data;
            return view("admin.post.edit", compact('listPostcats', 'data'));
        
        } else {
              
                 abort(403);
              
         }
    }
    function postUpdate(Request $request, $id)
    {
        // return strlen($request->input('postDes'));
        if ($request->input("btn-update")) {
            $request->validate(
                [
                    'postcat_id'=>'required',
                    'postDes'=>'required|max:376',
                    // 'postThumb' => 'required|file|image',
                    'postTitle' => 'required|string|min:1|max:255',
                    'postContent' => 'required|string|min:1',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'file' => 'dữ liệu nhập vào dạng file',
                    'image' => 'dữ liệu nhập vào phải là file ảnh(jpeg,png,bmp,gif...)',
                    'max'=>'Trường :attribute cần nhập tối đa :max ký tự'
                ],
                [
                    'catName'=>'danh mục bài viết',
                    'postThumb' => 'ảnh',
                    'postDes'=>'mô tả bải viết',
                    'postTitle' => 'tiêu đề bải viết',
                    'postContent' => 'nội dung bài viết',
                ]
            );
            if ($request->hasFile("postThumb")) {
                $file = $request->postThumb;
                $filename = $file->getClientOriginalName();
                $file->move(base_path("/storage/photos/1/posts/"), $filename);
                post::find($id)->update([
                    'postThumb' => '../storage/photos/1/posts/'.'/'.$filename,
                    'postTitle' => $request->input('postTitle'),
                    'postDes'=>$request->input('postDes'),
                    'postContent' => $request->input("postContent"),
                    'postcat_id' => $request->input('postcat_id'),
                    'user_id' => Auth::user()->id,
                    'postTime' => date("d/m/Y"),
                ]);
                return redirect("admin/post/list")->with("status", "Bạn đã cập nhật bài viết thành công");
            } else {
                post::find($id)->update([
                    'postThumb' =>str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hdpostThumb")) ,
                    'postTitle' => $request->input('postTitle'),
                    'postDes'=>$request->input('postDes'),
                    'postContent' => $request->input("postContent"),
                    'postcat_id' => $request->input('postcat_id'),
                    'user_id' => Auth::user()->id,
                    'postTime' => date("d/m/Y"),
                ]);
                return redirect("admin/post/list")->with("status", "Bạn đã cập nhật bài viết thành công");
            }
        }
    }
}
