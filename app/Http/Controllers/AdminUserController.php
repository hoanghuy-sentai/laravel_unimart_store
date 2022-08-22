<?php

namespace App\Http\Controllers;

use App\Models\right;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //
    function __construct()
    {
        // $this->middleware(function($request,$next){
            // session(['module_active'=>'user']);
            // return $next($request);
        // });
    }
    function list(Request $request)
    {
        if (Gate::allows('list_user_model')) {
            // $users=user::all();
            // $user = $request->input("searchUserText");
            // return $user;
            // return $users;
            // dd($users);
            // dd($request->fullUrlWithQuery(['love'=>'tue anh']));
            // if($request->input('status')=='active')
            // {
            //    $users = user::where("name", "like", "%{$user}%")->paginate(6);
            // }
            $list_act = array(
                'tem_delete' => 'Xóa tạm thời',
            );
            // return $list_act;
            $keyword = "";
            if ($request->input('status') == "trash") {
                $list_act = array(
                    'tem_delete' => 'Xóa vĩnh viễn',
                    'restore' => 'Khôi phục',
                );
                $users = user::onlyTrashed()->paginate(10);
            } else {
                if ($request->input("searchUserText")) {
                    $keyword = $request->input("searchUserText");
                }
                $users = user::where("name", "like", "%{$keyword}%")->paginate(10);
            }
            $count_user_active = user::count();
            $count_user_visible = user::onlyTrashed()->count();
            $count = array('active' => "$count_user_active", 'visible' => "$count_user_visible");
            // echo $count['active'];
            
            return view("admin.user.list", compact("users", "count", "list_act"));        
        } else {
              
                 abort(403);
              
         }
    }
    function add()
    {
        if (Gate::allows('add_user_model')) {
            $rights=right::all();
            return view("admin.user.add",compact("rights"));
        } else {
              
                 abort(403);
              
         }
    }
    function store(Request $request)
    {
        if ($request->input("btn-add")) {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'right_id'=>'required'
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'min' => ':attribute có độ dài tối thiểu :min ký tự',
                    'unique' => ':attribute này đã tồn tại.Vui lòng nhập một email khác',
                    'confirmed' => 'Xác nhận mật khẩu không thành công',
                ],
                [
                    'name' => 'họ và tên',
                    'email' => 'email',
                    'password' => 'mật khẩu',
                    'right_id'=>'quyền'
                ]
            );
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'right_id'=>$request->input('right_id'),
            ]);
            return redirect('admin/user/list')->with('status', "Bạn đã thêm mới một 1 user thành công");
        }
        // return $request->input();
    }
    public function delete_user($id)
    {
        if (Gate::allows('delete_user_model')) {
            if (Auth::user()->id != $id) {
                user::find($id)->delete();
                return redirect("admin/user/list")->with("status", "Đã xóa thành công");
            } else
                return  redirect("admin/user/list")->with("status", "Bạn không thể xóa chính mình");
        } else {
              
                 abort(403);
              
         }
    }
    function trash()
    {
        $users = user::onlyTrashed()->paginate(10);
        // dd($users);
        // return $users;
        return view("admin.user.trash", compact('users'));
    }
    function restore($id)
    {
        user::onlyTrashed()->find($id)->restore();
        // dd($users);
        return redirect("admin/user/list")->with("status", "Đã khôi phục bản ghi thành công");
    }
    public function delete_trash_user($id)
    {
        if (Gate::allows('delete_user_model')) {

            if (Auth::user()->id != $id) {
                user::onlyTrashed()->find($id)->forceDelete();
                return redirect("admin/user/list")->with("status", "Đã xóa thành công");
            } else
                return  redirect("admin/user/list")->with("status", "Bạn không thể xóa chính mình");
        
        } else {
              
                 abort(403);
              
         }
    }
    function excute(Request $request)
    {
        // $variable=$request()->input("check_list");
        // dd($variable);
        // return $request->input('check_list');
        if ($request->input('list_check')) {
            $list_check = $request->input('list_check');
            foreach ($list_check as $k => $v) {
                if (Auth::user()->id == $v) {
                    unset($list_check[$k]);
                    // return $request->input('list_check')[$k];
                }
                if (!empty($list_check)) {
                    $opt = $request->input("option");
                    switch ($opt) {
                        case 'per_delete':
                            User::onlyTrashed()->whereIn('id', $list_check)->forceDelete();
                            return redirect("/admin/user/list")->with('status', "Bạn đã xóa vĩnh viễn bản ghi thành công");
                            break;
                        case 'tem_delete':
                            // return "thôi thôi tôi đi xóa đây câm dkmay";
                            User::destroy($list_check);
                            return redirect("/admin/user/list")->with('status', "Bạn đã xóa tạm thời bản ghi thành công");
                            break;
                        case 'restore':
                            // return "thôi thôi tôi đi khôi phục đây câm dkmay";
                            User::onlyTrashed()->whereIn('id', $list_check)->restore();
                            return redirect("/admin/user/list")->with('status', "Bạn đã khôi phục bản ghi thành công");
                            break;
                        default:
                            return  redirect("/admin/user/list")->with('status', "Bạn chưa chọn thao tác gì cả");
                    }
                    //    if($request->input("option")=="delete")
                    //    {
                    //        return "thôi thôi tôi đi xóa đây câm dkmay";
                    //    }
                    //    if($request->input("option")=="restore")
                    //    {
                    //        return "thôi thôi tôi đi khôi phục đây câm dkmay";
                    //    }
                } else {
                    return redirect("/admin/user/list")->with("status", "Bạn không thể thao tác trên chính user bạn đang chọn");
                }
            }
        } else
            return redirect("/admin/user/list")->with('status', "Bạn chưa chọn gì cả");
    }
    function edit(Request $request, $id)
    {
        if (Gate::allows('edit_user_model')) {
            $user = User::find($id);
            // return $user;
            // return $id;
            $rights=right::all();
            return view("admin.user.edit", compact("user",'rights'));
        } else {
              
                 abort(403);
              
         }
    }
    function update(Request $request, $id)
    {
        if ($request->input('btn-update')) {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    //'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'right_id'=>'required',
                ],
                [
                    'required' => 'Trường :attribute không được để trống',
                    'string' => 'Yêu cầu nhập chuỗi ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'min' => ':attribute có độ dài tối thiểu :min ký tự',
                    'unique' => ':attribute này đã tồn tại.Vui lòng nhập một email khác',
                    'confirmed' => 'Xác nhận mật khẩu không thành công',
                ],
                [
                    'name' => 'họ và tên',
                    'email' => 'email',
                    'password' => 'mật khẩu',
                    'right_id'=>'quyền',
                ]
            );
            User::find($id)->update([
                'name' => $request->input('name'),
                'password' =>Hash::make($request->input('password')),
                'right_id'=>$request->input('right_id'),
            ]);
            return redirect('/admin/user/list')->with('status',"Bạn đã cập nhật thông tin thành công");
        }
    }
}
