<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8',
            'password_confirm' => 'required|same:password',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'role_id' => $request->role_id,
                'email' => $request->email,
                'password' => $request->password
            ]);

            Profile::create([
                'user_id' => $user->id,
                'nama' => $request->name,
                'no_hp' => $request->phone,
            ]);

            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        try {
            if (!Auth::guard("web")->attempt($request->only('email', 'password'))) {
                return redirect()->back()->with('error', 'Email atau password salah');
            }

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
