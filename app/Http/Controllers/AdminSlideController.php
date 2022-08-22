<?php

namespace App\Http\Controllers;

use App\Models\slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminSlideController extends Controller
{
    //
    function list(Request $request)
    {  
        if (Gate::allows('list_slide_model')) {

                 //----------------------
                // return $textSearch= $request->input("txtSearch");
                // $slides=slide::where("slideTitle",'like',"%$textSearch%")->paginate(10);
                // $slides=slide::paginate(10);
                // return $slide;
                // $countActive=slide::count();
                // $countTrash=slide::onlyTrash()->get();
                // return $request->all();
                //------------------------
                $status = $request->input("status");
                $textSearch = $request->input("txtSearch");
                if ($status == "trash") {
                    $acts = ['per_delete' => 'Xóa vĩnh viễn', 'restore' => 'Khôi phục'];
                    $slides = slide::onlyTrashed()->paginate(10);
                } else {
                    $acts = ['temp_delete' => 'Xóa tạm thời'];
                    $slides = slide::paginate(10);
                }
                $countActive = slide::count();
                $countTrash = slide::onlyTrashed()->count();
                $count = array(
                    'active' => $countActive,
                    'trash' => $countTrash,
                );
                return view("admin.slide.list", compact("slides", "count", "acts"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function  excecute(Request $request)
    {
        $listcheck = $request->input("listcheck");
        $act = $request->input("acts");
        if ($listcheck) {
            switch ($act) {
                case 'temp_delete':
                    slide::destroy($listcheck);
                    return redirect("admin/slide/list")->with("status", "Đã chọn vào xóa tạm thời");
                    break;
                case 'per_delete':
                    if (Gate::allows('delete_slide_model')) {
                        slide::where("id", $listcheck)->forceDelete();
                        return redirect("admin/slide/list")->with("status", "Đã chọn vào xóa vĩnh viễn");
                        break;
                    } else {
                          
                             abort(403);
                          
                     }
                case 'restore':
                    slide::where("id", $listcheck)->onlyTrashed()->restore();
                    return redirect("admin/slide/list")->with("status", "Đã khôi phục bản ghi");
                    break;
                default:
                    return redirect("admin/slide/list")->with("status", "Bạn chưa chọn thao tác nào cả");
            }
        } else
            return redirect("admin/slide/list")->with("status", "Bạn chưa đánh dấu bản ghi nào");
    }
    function delete($id)
    {
        if (Gate::allows('delete_slide_model')) {
            slide::where("id", "=", "$id")->delete();
            return redirect("admin/slide/list")->with("status", "Bạn đã xóa thành công");
        } else {
              
                 abort(403);
              
         }
    }
    function add()
    {
        if (Gate::allows('add_slide_model')) {
            return view("admin.slide.add");
        } else {
              
                 abort(403);
              
         }
    }
    function create(Request $request)
    {
        if ($request->input('btn-add')) {
            $request->validate(
                [
                    'slidePic' => 'required|image|max:20000', // max 10000kb
                    // 'slideTitle' => 'required|string|max:255',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'image' => 'dữ liệu nhập vào phải là ảnh'
                ],
                [
                    'slidePic' => 'ảnh',
                    // 'slideTitle' => 'tiêu đề slide',
                ]
            );
            if ($request->hasFile("slidePic")); {
                $file = $request->slidePic;
                $filename = $file->getClientOriginalName();
                if ($file->move(base_path("/storage/photos/1/slides"), $filename)) {
                    $slidePic = '../storage/photos/1/slides/'.'/'.$filename;
                    slide::create([
                        'slidePic' => $slidePic,
                        'user_id' => Auth::user()->id,
                        'slideStatus' => $request->input("slideStatus"),
                        'slideTime' => date("d/m/Y"),
                    ]);
                }
                return redirect("admin/slide/list")->with("status", "Bạn đã thêm thành công");
            }
        }
    }
    function edit($id)
    {
        if (Gate::allows('edit_slide_model')) {

            $slide = slide::where('id', '=', "$id")->get();
            return view("admin.slide.edit", compact("slide"));
        
        } else {
              
                 abort(403);
              
         }
    }
    function update($id, Request $request)
    {
        // return $request->input("btn-update");
        $request->validate(
            [
                'slidePic' => 'image|max:20000', // max 10000kb
                // 'slideTitle' => 'required|string|max:255',
            ],
            [
                'required' => 'Trường :attribute không được để trống',
                'string' => 'Yêu cầu nhập chuỗi ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'image' => 'dữ liệu nhập vào phải là ảnh'
            ],
            [
                'slidePic' => 'ảnh',
                // 'slideTitle' => 'tiêu đề slide',
            ]
        );
        $imgPath =str_replace("http://localhost/unitop.vn/back-end/php/LARAVELPRO/laravel-unitop.vn/unimart/","../",$request->input("hn_slidePic"));
        if ($request->input("btn-update")) {
            if ($request->has("slidePic")) {
                $file = $request->slidePic;
                $fileName =$file->getClientOriginalName();
                if ($file->move(base_path("/storage/photos/1/slides"), $fileName)) {
                    $path='../storage/photos/1/slides/'.'/'.$fileName;
                    slide::find($id)->update([
                        'slidePic' => $path,
                        'user_id' => Auth::user()->id,
                        'slideTime' => date("d/m/Y"),
                        'slideStatus' => $request->input("slideStatus"),
                    ]);
                }
            } else {
                slide::find($id)->update([
                    'slidePic' => $imgPath,
                    'user_id' => Auth::user()->id,
                    'slideTime' => date("d/m/Y"),
                    'slideStatus' => $request->input("slideStatus"),
                ]);
            }
            return redirect("admin/slide/list")->with("status", "Đã cập nhật bản ghi thành công");
        }
    }
}
