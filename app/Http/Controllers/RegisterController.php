<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function show(){
        return view('frontend.users.sign_up');
    }
    public function register_me(){
        $pas = Hash::make('password');
        // $data = ['name'=> 'Admin 1','email1'=>'admin@gmail.com','password'=>$pas];
        // $user = User::create($data);
        $user = new User();
        $user->name = 'Admin14';
        $user->email = 'admin100@gmail.com';
        $user->password = $pas;
        $user->save();
        $user->notify(new VerifyEmail());
        dd('1');

        SendMailJob::dispatch();
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

}
