<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminPageController extends Controller
{
    //
    function list(Request $request)
    {
        if (Gate::allows('list_page_model')) {

            $keyword = $request->input("dataSearch");
            $status = $request->input("status");
            if ($status == "trash") {
                $actions = ['per_delete' => 'Xóa vĩnh viễn', 'restore' => 'Khôi phục'];
                $pages = Page::onlyTrashed()->paginate(5);
            } else {
                $actions = ['temp_delete' => 'Xóa tạm thời', 'restore' => 'Khôi phục'];
                $pages = Page::where("pageName", 'like', "%{$keyword}%")->paginate(5);
            }
            $count_page_active = Page::count();
            $count_page_trash = Page::onlyTrashed()->count();
            $count = ["active" => $count_page_active, 'trash' => $count_page_trash];
            return view("admin.page.list", compact("pages", "actions", "count"));
        
        } else { 
            abort(403);   
         }
    }
    function delete($id)
    {
        //    return  "Delete record at:".$id;
        if (Gate::allows('delete_page_model')) {

            Page::find($id)->delete();
            return redirect("admin/page/list")->with("status", "Bạn vừa xóa thành công");
        
        } else {
    
            abort(403);
    
        }
    }
    function multi_option(Request $request)
    {
        $listcheck = $request->input('listcheck');
        if ($listcheck) {
            //    return $request->input('listcheck');
            $option = $request->input('option');
            switch ($option) {
                case 'temp_delete':
                    Page::destroy($listcheck);
                    return redirect("admin/page/list")->with('status', "Bạn đã xóa thành công");
                    break;
                case "per_delete":
                    if (Gate::allows('delete_page_model')) {

                        Page::withTrashed()->whereIn('id', $listcheck)->forceDelete();
                        return redirect("admin/page/list")->with('status', "Bạn đã xóa vĩnh viễn bản ghi thành công");
                        break;
        
                    } else { 
                         abort(403);   
                     }
                case "restore":
                    Page::withTrashed()->whereIn('id', $listcheck)->restore();
                    return redirect("admin/page/list")->with('status', "Bạn đã khôi phục bản ghi thành công");
                    break;
                default:
                    return redirect("admin/page/list")->with('status', "Bạn chưa chọn tác vụ nào cả");
            }
            //   return $request->input('option');
        } else {
            // return "Bạn chưa chọn gì cả";
            return redirect("admin/page/list")->with('status', "Bạn chưa chọn bản ghi nào");
        }
    }
    function add()
    {
        if (Gate::allows('add_page_model')) {

            // return view("admin.page.add");
            $creators = Page::select("user_id")->distinct()->get();
            // return $creators;
            return view("admin.page.add", compact("creators"));
        
        } else {
    
            abort(403);
    
        }
    }
    function store(Request $request)
    {
        if ($request->input('btn-add')) {
            $request->validate(
                [
                    'pageName' => 'required|string|max:255',
                    'pageContent' => 'required|string',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                ],
                [
                    'pageName' => 'tên trang',
                    'pageContent' => 'nội dung trang',
                ]
            );
            // return $request->input('user_id');

            Page::create([
                'PageName' => $request->input('pageName'),
                'pageStatus' => $request->input('pageStatus'),
                'pageContent' => $request->input('pageContent'),
                'user_id' => Auth::user()->id,
                'pageCreate' => date("d/m/Y"),
            ]);
            return redirect("admin/page/list")->with('status','Bạn đã thêm trang thành công');
            
        }
    }
    function edit(Request $request,$id)
    {
        if (Gate::allows('edit_page_model')) {

            $get_page_by_id=Page::where("id","=","$id")->get();
            // return $get_page_by_id[0]->id;
            // return $get_page_by_id;
            $creators = Page::select("user_id")->distinct()->get();
            return view("admin.page.edit",['get_page_by_id'=>$get_page_by_id],compact("creators"));
    
        } else {
    
            abort(403);
    
        }
    }
    function update(Request $request,$id)
    {
        if ($request->input('btn-update')) {
            $request->validate(
                [
                    'pageName' => 'required|string|max:255',
                    'pageContent' => 'required|string',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                ],
                [
                    'pageName' => 'tên trang',
                    'pageContent' => 'nội dung trang',
                ]
            );
            // return $request->input('user_id');
            Page::find($id)->update([
                'PageName' => $request->input('pageName'),
                'pageStatus' => $request->input('pageStatus'),
                'pageContent' => $request->input('pageContent'),
                'user_id' => Auth::user()->id,
                'pageCreate' => date("d/m/Y"),
            ]);
            return redirect("admin/page/list")->with('status','Bạn đã cập nhật trang thành công');
        }
    }
}
