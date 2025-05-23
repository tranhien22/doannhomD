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
        return redirect()->route('user.cus_login');
    }

    // login client
    public function indexLogin()
    {
        return view('cus_login');
    }

    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        // Kiểm tra tài khoản có tồn tại không
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Kiểm tra tài khoản bị chặn
        if ($user->is_blocked) {
            return back()->withErrors(['email' => 'Tài khoản của bạn đã bị chặn!']);
        }

        if (Hash::check($request->password, $user->password)) {
            if ($user->role == 1) {
                // Nếu là admin
                session(['id_user' => $user->id_user]);
                return redirect()->route('admin.dashboard');
            } else {
                // Nếu là user thường
                session(['id_user' => $user->id_user]);
                session(['cart' => ['user_id' => $user->id_user]]);
                return redirect()->route('home.index');
            }
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
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