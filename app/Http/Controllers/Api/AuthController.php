<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
                'password' => Crypt::encrypt($request->password)
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
            $user = User::where('email', $request->email)->first();

            if ($request->password !== Crypt::decrypt($user->password)) {
                return $this->failedResponse('Password is incorrect', 401);
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
            $user = User::where('id', $auth->id)->with(['profile', 'role'])->first();

            $user->profile->foto = $user->profile->foto ? asset('storage/' . $user->profile->foto) : null;

            return $this->successResponse($user, null, 200);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user()->profile;

        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'nik' => 'nullable|size:16|unique:profiles,nik,' . $user->id . ',id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'alamat_ktp' => 'nullable|string|max:255',
            'anak' => 'nullable|integer',
            'domisili' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu',
            'status_pernikahan' => 'nullable|in:belum menikah,menikah,cerai',
            'kontak_darurat' => 'nullable|string|max:255',
            'mcu' => 'nullable|in:ada,tidak ada',
            'no_rek_bca' => 'nullable|size:10',
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
            $foto = $request->file('foto');

            $user->update([
                'foto' => $foto ? $foto->store('profile', 'public') : $user->foto,
                'nama' => $request->nama ? $request->nama : $user->nama,
                'no_hp' => $request->no_hp ? $request->no_hp : $user->no_hp,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat_ktp' => $request->alamat_ktp,
                'domisili' => $request->domisili,
                'agama' => $request->agama,
                'status_pernikahan' => $request->status_pernikahan,
                'anak' => $request->anak,
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
