<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationFailedResponse($validator->errors(), null, 422);
        }

        try {
            $user = User::create([
                'role_id' => $request->role_id,
                'email' => $request->email,
                'password' => $request->password
            ]);

            Profile::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
            ]);

            return $this->successResponse($user, 'Register success', 200);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request['email'])->first();

            if (!Auth::guard("web")->attempt($request->only('email', 'password'))) {
                return $this->failedResponse('Your credentials are wrong', 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse($token, 'Login success', 200);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }


    public function profile()
    {
        $auth = Auth::user();
        try {
            $user = User::findOrFail($auth->id)->with(['profile', 'role'])->first();

            return $this->successResponse($user, null, 200);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user()->profile;

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'nik' => 'nullable|size:16|unique:profiles,nik,' . $user->id . ',id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'alamat_ktp' => 'nullable|string|max:255',
            'domisili' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu',
            'status_pernikahan' => 'nullable|in:belum menikah,menikah,cerai',
            'kontak_darurat' => 'nullable|string|max:255',
            'mcu' => 'nullable|string|max:255',
            'no_rek_bca' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|in:sd,smp,sma,d3,s1,s2,s3',
            'tgl_bergabung' => 'nullable|date',
            'nrp' => 'nullable|string|max:255',
            'no_kontrak' => 'nullable|string|max:255',
            'status_kontrak' => 'nullable|in:aktif,tidak aktif',
            'lokasi_site' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationFailedResponse($validator->errors(), null, 422);
        }

        try {
            $user->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat_ktp' => $request->alamat_ktp,
                'domisili' => $request->domisili,
                'agama' => $request->agama,
                'status_pernikahan' => $request->status_pernikahan,
                'kontak_darurat' => $request->kontak_darurat,
                'mcu' => $request->mcu,
                'no_rek_bca' => $request->no_rek_bca,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'tgl_bergabung' => $request->tgl_bergabung,
                'nrp' => $request->nrp,
                'no_kontrak' => $request->no_kontrak,
                'status_kontrak' => $request->status_kontrak,
                'lokasi_site' => $request->lokasi_site,
            ]);

            return $this->successResponse($user, 'Profile updated successfully', 200);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}