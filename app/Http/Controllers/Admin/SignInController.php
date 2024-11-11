<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Admin\SignInRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function create(): View
    {
        return view('admins.signin');
    }

    public function store(SignInRequest $request)
    {
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Đăng nhập thành công
            Auth::guard('admin')->login($admin);

            return redirect()->intended('/admin/posts')->with('success', 'Đăng nhập thành công !');
        }

        // Nếu đăng nhập thất bại
        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }
    public function logout(Request $request)
    {
        // Đăng xuất nhân viên
        Auth::guard('admin')->logout();

        // Hủy bỏ phiên đăng nhập (invalidate) và regenerate token để đảm bảo bảo mật
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Điều hướng về trang đăng nhập hoặc trang chủ tùy theo yêu cầu
        return redirect()->route('admin.signin')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
