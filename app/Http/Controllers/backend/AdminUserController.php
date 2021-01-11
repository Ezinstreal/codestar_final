<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddUserRequest;
use App\Http\Requests\AdminEditUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('backend.user.index',compact('users'));
    }
    public function create(){
        return view('backend.user.create');
    }
    public function store(AdminAddUserRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($request->role);
        $profile = new Profile();
        $profile->nickname = Str::slug($user->name,'').$user->id.'sa'.mt_rand(100,999);
        $profile->user_id = $user->id;
        $profile->birthday = $request->birthday;
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->link = $request->link;
        $profile->image = 's.png';
        $profile->save();
        return redirect()->route('admin.user.index')->with('success','Tao Tai Khoan Thanh Cong!');
    }
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        $user->role()->detach();
        return back()->with('success','Xóa thàng công!');
    }

    public function edit($id)  {
        $role =Role::all();
        $data = User::findOrFail($id);
        $profile = $data->profile;
        return view('backend.user.edit',compact('data','profile','role'));
    }

    public function update(AdminEditUserRequest $request, $id) {
        $user = User::findOrfail($id);
        $data = [
            'name' => $request->name,
            // 'password' => Hash::make($request->password),
        ];
        $data2 = [
            'birthday' => $request->birthday,
            'address' => $request->address,
            'phone' => $request->phone,
            'link' => $request->link,
        ];
        $profile = Profile::where('user_id',$id)->first();
        $profile->update($data2);
        $user->update($data);
        $user->roles()->sync($request->role);

        return redirect()->route('admin.user.index')->with('success','Cập nhật người dùng thành công !');
    }

    public function password(Request $request, $id) {
        $user = User::findOrFail($id);
        if($request->password != null) {
            if ($request->password == $request->cf_password) {
                $user->password = Hash::make($request->password);
                $user->save();

                return back()->with('success','Đổi mật khẩu thành công!');
            }
            else {
                return back()->with('danger','Xác nhận mật khẩu sai!');
            }
        }
        else {
            return back()->with('danger','Mật khẩu không được để trống!');
        }

    }
    public function logout(){
        Auth::logout();
		return redirect()->route('login');
    }
}
