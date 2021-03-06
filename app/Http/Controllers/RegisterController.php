<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function getRegister(){
        $app_url = getenv('APP_URL');
        return view('register',['app_url' => $app_url]);
    }
    public function register(Request $request){
        $name = $request->name;
        $user_id = $request->user_id;
        $sex = $request->sex;
        $phone_number = $request->phone_number;
        $title = $request->title;
        $unit_id = $request->unit_id;
        $email = $request->email;
        $password = $request->password;
        $parent_id = $request->parent_id;

        //表单验证

        $rules = [
            'name' => 'required',
            'user_id'=>'required|max:12',
            'phone_number'=>'required|max:11|min:11',
            'title'=>'required',
//            'unit_id'=>'required',
            'email'=>'email',
            'password'=>'min:6',
            'password_confirmation'=>'required|same:password'
        ];

        //定义提示信息
        $messages = [
            'name.required' => '姓名不能为空',
            'user_id.required' => '工号不能为空',
            'phone_number.required' => '手机号码不能为空',
            'phone_number.min' => '手机号码格式不正确',
            'phone_number.max' => '手机号码格式不正确',
            'title.required' => '职称不能为空',
            'unit_id.required' => '单位名称不能为空',
            'email.email' => 'Email格式不正确',
            'password.min' => '密码最少为8位',
            'password_confirmation.required'=>"确认密码不能为空",
            'password_confirmation.same'=>'两次输入的密码不匹配',

        ];

        //创建验证器
        $validator = Validator::make($request->all(), $rules, $messages);
//        dd($validator);
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;

        $user->name = $name;
        $user->user_id = $user_id;
        $user->sex = $sex;
        $user->phone_number = $phone_number;
        $user->title = $title;
        $user->unit_id = $unit_id;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->parent_id = $parent_id;

        $user->save();

        return view('sucess',[
            'msg' => '注册成功'
        ]);

    }
}
