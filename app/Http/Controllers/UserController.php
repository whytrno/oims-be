<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        try {
            $data = User::with(['profile', 'role'])->get();

            return view('master-data.users.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function detail($id)
    {
        try {
            $data = User::with(['profile', 'role'])->find($id);

            return view('master-data.users.detail', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = Profile::where('user_id', $id)->first();

        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'nik' => 'nullable|size:16|unique:profiles,nik,' . $user->id . ',id',
            'tempat_lahir' => 'nullable|string|max:255',
            'anak' => 'nullable|integer',
            'tgl_lahir' => 'nullable|date',
            'alamat_ktp' => 'nullable|string|max:255',
            'domisili' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu',
            'status_pernikahan' => 'nullable|in:belum menikah,menikah,cerai',
            'kontak_darurat' => 'nullable|string|max:255',
            'mcu' => 'nullable|int:ada,tidak ada',
            'no_rek_bca' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|in:sd,smp,sma,d3,s1,s2,s3',
            'tgl_bergabung' => 'nullable|date',
            'nrp' => 'nullable|string|max:255',
            'no_kontrak' => 'nullable|string|max:255',
            'status_kontrak' => 'nullable|in:aktif,tidak aktif',
            'lokasi_site' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        try {
            $user->update([
                'foto' => $request->foto ? $request->foto->store('profile', 'public') : $user->foto,
                'nama' => $request->nama ? $request->nama : $user->nama,
                'no_hp' => $request->no_hp ? $request->no_hp : $user->no_hp,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'anak' => $request->anak,
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

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
