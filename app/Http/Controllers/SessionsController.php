<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    // 显示登录页面
    public function create ()
    {
        return view('sessions.create');
    }

    // 提交登录后的操作
    public function store (Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('success', '欢迎回来！');
            return redirect()->intended(route('users.show', [Auth::user()]));
            // intended 方法，该方法可将页面重定向到上一次请求尝试访问的页面上
            // intended 方法，并接收一个【默认跳转地址参数】，当上一次请求记录为空时，跳转到默认地址上。
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }
    }

    // 退出登录，销毁会话（登录）
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
