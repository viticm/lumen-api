<?php

/**
 * AuthController.php
 * PHP version 7
 * @category    PHP
 * @package     lumen
 * @author      leafly
 * @copyright   leafly
 * @uses The account auth controller class.
 **/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use illuminate\support\Str;
use Illuminate\Http\Request;
use Hautelook\Phpass\PasswordHash;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * 用户注册
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function signup(Request $request)
    {
        // 参数校验
        $this->validate($request, [
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        // 注册记录校验
        $row = User::where('username', $username)->orWhere('email', $email)->first();
        if($row !== null) {
            return $this->failed("当前邮箱或用户名已被注册");
        }
        $passwordHasher = new PasswordHash(8, false);

        // 插入数据
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $passwordHasher->HashPassword($password);

        if($user->save() === false) {
            return $this->failed("用户注册失败");
        }
        return $this->successd();
    }

    /**
     * 用户登陆
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function signin(Request $request)
    {
        Log::info("request signin===================================");
        /*
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        */
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'required' => 'user or password empty'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->failed($errors->first(), 60203);
        }

        $email = $request->input('username');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        Log::info("email: ".$email." password: ".$password);
        if (is_null($user)) {
            return $this->failed('当前用户不存在', 60204);
        }
        if ($user->active !== 1) {
            return $this->failed('用户已被禁用', 60205);
        }
        $passwordHasher = new PasswordHash(8, false);
        // Check password.
        if ($passwordHasher->CheckPassword($password, $user->password) === false) {
            return $this->failed('密码错误');
        }
        // Generate the token.
        $user->remember_token = Str::random(60); //这个token会不会重复？
        if ($user->save() === false) {
            return $this->failed('登陆错误');
        }
        return $this->succeed(['token'=> $user->remember_token]);
    }

    /**
     * 用户认证（框架提供的方式比较齐全，但内容也相对多，不建议API使用）
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     */ 
    public function authenticate(Request $request)
    {
        $email = $request->input('username');
        $password = $request->input('password');
        if (Auth::attempt(
            ['email' => $email, 'password' => $password, 'active' => 1])) {
            // The user is active, not suspended, and exists.
        }
    }

    /**
     * 用户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     */
    public function info(Request $request)
    {
        $token = $request->input('token');
        $user = User::where('remember_token', $token)->first();
        if (! is_null($user)) {
            /*
            $data = [
                'roles'         => json_decode($user->roles),
                'name'          => $user->name,
                'avatar'        => $user->avatar,
                'introduction'  => $user->introduction
            ];
            */
            // The data must be a array.
            return $this->succeed($user->toArray());
        }
        return $this->failed('Maybe you need relogin');
    }

    /**
     * 用户登出
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     */
    public function signout(Request $request)
    {
        $token = $request->input('token');
        $user = User::where('remember_token', $token)->first();
        $succeed = true;
        if (!is_null($user)) {
            $user->remember_token = '';
            $succeed = $user->save();
        }
        return $succeed ? $this->succeed() : $this->failed();
    }
}
