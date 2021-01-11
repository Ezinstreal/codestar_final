<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLoginRequest;
use App\Http\Requests\PostRegisterRequest;
use App\Http\Requests\RecoverRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Jobs\SendMailJob;
use App\Notifications\UserFollowed;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RecoverPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getLogin(Request $request){
        $headerUrl = $request->path();

        return view('frontend.users.sign_in',compact('headerUrl'));
    }
    public function postLogin(PostLoginRequest $request){
        if(Auth::attempt($request->only('email','password'),true)){
            return redirect('/');
        }
        else{
            return back()->withInput($request->all())->withErrors(['password'=>'Sai password']);
        }

    }
    public function getRegister(){
        return view('frontend.users.sign_up');
    }
    public function postRegister(PostRegisterRequest $request){
        if($request->rule == 1){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->notify(new VerifyEmail());
            SendMailJob::dispatch();
            $role = Role::where('name','user')->first()->id;
            $user->roles()->attach($role);
            $profile = new Profile();
            $profile->nickname = Str::slug($user->name,'').$user->id.'sa'.mt_rand(100,999);
            $profile->user_id = $user->id;
            $profile->image = 's.png';
            $profile->save();
            Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
            return redirect()->route('users.settings.index');
        }else
        return back()->withInput($request->all)->withErrors(['rule','Bạn chưa xác nhận đồng ý với điều khoản sử dụng!']);

    }
    public function verifyAgain(){
        $user = User::findOrFail(Auth::user()->id);
        $user->notify(new VerifyEmail());
        SendMailJob::dispatch();
        return back()->with('success','Đã gửi email xác thực thành công. Bạn vui lòng kiểm tra lại email của mình!');
    }
    public function verify(Request $request,$id){
        if(!$request->hasValidSignature()){
            abort(401);
        }
        $user = User::query()->find($id);
        $user->email_verified_at = now();
        $user->save();
        return 'done';
    }
    public function postForgot(Request $request){
        $user = User::where('email',$request->email)->first();
        $user->notify(new RecoverPassword());
        SendMailJob::dispatch();
        return back()->with('success','Gửi email thành công. Vui lòng kiểm tra email của bạn!');
    }
    public function getRecover(Request $request, $id){
        if(!$request->hasValidSignature()){
            abort(401);
        }
        $data = User::query()->find($id);
        return view('frontend.users.recover',compact('data'));
    }
    public function postRecover(RecoverRequest $request){
        $user = User::where('email',$request->email);
        $user->update(['password'=>Hash::make($request->password)]);
        Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
        return redirect()->route('users.settings.index')->with('success','Cập nhật mật khẩu thành công !');

    }
    public function settings(){
        $user = Auth::user();
        $profile = Profile::where('user_id',$user->id)->first();
        return view('frontend.users.settings',compact('user','profile'));
    }
    public function profile(UpdateProfileRequest $request){
        $id = Auth::user()->id;
        $profile = Profile::where('user_id',$id)->first();
        $user = User::findOrFail($id);
        if($request->hasFile('image')){
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $image = str_replace(' ','',$file_name);
            $file->move('upload',$image);
            $data = [
                'image' => $image,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'link' => $request->link,
                'phone' => $request->phone,
            ];
            $profile->update($data);
            $user->update(['name'=>$request->name]);
            return back()->with('success','Profile cập nhật thành công!');
        }
        $data = [
            'birthday' => $request->birthday,
            'address' => $request->address,
            'link' => $request->link,
            'phone' => $request->phone,
        ];
        $profile->update($data);
        $user->update(['name'=>$request->name]);
        return back()->with('success','Profile cập nhật thành công!');

    }
    public function pw(Request $request){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $email = $user->email;
        if (Hash::check($request->password, $user->password)) {
            if(strlen($request->new_password)>7){
                if($request->new_password == $request->cf_password){
                    $user->update(['password'=> Hash::make($request->new_password)]);
                    $auth = Auth::attempt(['email' => $email, 'password' => $request->new_password], true);
                    return redirect('users/settings#v-pills-password')->with('success','Cập nhật mật khẩu thành công !');
                }
                return redirect('users/settings#v-pills-password')->with('danger','Mật khẩu mới và xác nhận mật khẩu không khớp !');
            }
            return redirect('users/settings#v-pills-password')->with('danger','Mật khẩu mới quá ngắn !');
        }
        return redirect('users/settings#v-pills-password')->with('danger','Sai mật khẩu !');
    }
    public function logout(){
        Auth::logout();
		return redirect()->route('home.index');
    }
    public function mypage($nickname){
        $id = Auth::user()->id;
        $profile = Profile::where('nickname',$nickname)->first();
        $user = $profile->user;
        if($user->id == $id){
            $can_follow = 0;
        }else{
            $gido = User::findOrFail($id)->follows()->get()->where('id',$user->id)->first();
            if($gido !== null){
                $can_follow = 2;
            }else
                $can_follow = 1;
        }

        return view('frontend.users.mypage',compact('profile','user','can_follow'));
    }
    public function follow($nickname){
        $user2 = Profile::where('nickname',$nickname)->first()->user;
        $id = $user2->id;
        $user = User::findOrFail(Auth::user()->id);
        if($user->follows->where('id',$id)->first()){
            $user->follows()->toggle($id);
            return back();
        }
        $user->follows()->toggle($id);

        $user2->notify(new UserFollowed($user));
        return back();
        // if($user->followers->where('id',$id)->first()){
        //     $user2->notify(new UserFollowed($user));
        // }
    }
    public function notification(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        $notification  = $user->notifications->where('id',$request->noti_id)->first();
        $notification->markAsRead();
    }
    public function notifications(){
        $user = User::findOrFail(Auth::user()->id);
        $notifications = $user->notifications->markAsRead();
    }
    public function getForgot(){
        return view('frontend.users.forgot');
    }
}
