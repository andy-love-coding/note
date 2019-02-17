<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Category;

class UsersController extends Controller
{
    public function show (User $user)
    {
        $categories = Category::all();
        return view('users.show', compact('user', 'categories'));
    }

    public function create ()
    {
        $categories = Category::all();
        return view('users.create', compact('categories'));
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:5'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user); // 注册后自动等登录
        session()->flash('success', '恭喜，注册成功！');
        return redirect()->route('users.show', [$user]);
    }
}
