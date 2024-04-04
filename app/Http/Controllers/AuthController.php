<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ResponseTrait;

    public function register(Request $request)
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
            return $this->validationFailedResponse($validator->errors(), null, 422);
        }

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

        return $this->successResponse($user, 'Register success', 200);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        if (!Auth::guard("web")->attempt($request->only('email', 'password'))) {
            return $this->failedResponse('Your credentials are wrong', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse($token, 'Login success', 200);
    }


    public function profile()
    {
        $user = Auth::user()->profile;

        return $this->successResponse($user, null, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user()->profile;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationFailedResponse($validator->errors(), null, 422);
        }

        $user->update($request->all());

        return $this->successResponse($user, 'Profile updated successfully', 200);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
//            'old_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|string|min:8',
            'new_password_confirm' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return $this->validationFailedResponse($validator->errors(), null, 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return $this->successResponse(null, 'Password updated successfully', 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse(null, 'You have successfully logged out and the token was successfully deleted', 200);
    }
}
