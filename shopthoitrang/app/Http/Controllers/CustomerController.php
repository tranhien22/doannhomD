<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;

class CustomerController extends Controller
{

    //Registes client
    public function indexRegister()
    {
        return view('cus_register');
    }
    public function authRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|max:10',
            'address' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.max' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Vui lòng nhập địa chỉ'
        ]);

        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'role' => 0,
        ]);
        return redirect()->route('user.cus_login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // login client
    public function indexLogin()
    {
        return view('cus_login');
    }

    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống']);
        }

        if ($user->is_blocked) {
            return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ admin để được hỗ trợ.']);
        }

        if (Hash::check($request->password, $user->password)) {
            if ($user->role == 1) {
                session(['id_user' => $user->id_user]);
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công! Chào mừng Admin.');
            } else {
                session(['id_user' => $user->id_user]);
                session(['cart' => ['user_id' => $user->id_user]]);
                return redirect()->route('home.index')->with('success', 'Đăng nhập thành công! Chào mừng ' . $user->name);
            }
        } else {
            return back()->withErrors(['email' => 'Mật khẩu không chính xác']);
        }
    }

    public function signOut(Request $request)
    {
        $request->session()->forget('cart');
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

}