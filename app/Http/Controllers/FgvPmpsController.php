<?php

namespace App\Http\Controllers;

use App\Models\Tandan;
use App\Models\Tugasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FgvPmpsController extends Controller
{

    public function login(Request $request)
    {
        $user = User::where('no_kakitangan', $request->no_kakitangan)->first();

        if (!isset($user)) {
            return 'User Tidak Dijumpai';
        }

        $credentials = $request->only('no_kakitangan', 'password');
        if (!Auth::attempt($credentials)) {
            return 'Kata Laluan Salah';
        }
        return response()->json($user);
    }

    public function profil(User $user)
    {
        return response()->json($user);
    }

    public function senarai_tugasan()
    {
        $tugasans = Tugasan::all();
        return response()->json($tugasans);
    }
    public function senarai_tugasan_user($id)
    {
        $tugasans = Tugasan::where('petugas_id', $id)->get();
        return response()->json($tugasans);
    }

    public function cipta_tugasan(Request $request)
    {

        $tandan = Tandan::where('no_daftar', $request->no_daftar)->first();
        if ($tandan == null) {
            return [
                'error' => '404',
                'log' => 'Tandan tidak wujud',
            ];
        }

        $tandan = Tandan::where('no_daftar', $request->no_daftar)->whereNotNull('pokok_id')->first();
        if ($tandan == null) {
            return [
                'error' => '404',
                'log' => 'Data tandan belum didaftarkan pokok',
            ];
        }

        $tugasan = Tugasan::create([
            'tandan_id' => $tandan->id,
            'jenis' => $request->jenis, //['balut','debung','kawal','tuai']
            'catatan' => $request->catatan, // description pelaksanaan
            'status' => 'dicipta', //['dicipta','siap','disahkan','rosak']
            'tarikh' => $request->tarikh,
            'petugas_id' => $request->petugas_id, // user yang perlu melaksanakan tugas
        ]);

        $tugasan['no_daftar'] = $tandan->no_daftar;
        $tugasan['pokok_id'] = $tandan->pokok_id;
        return response()->json($tugasan);

    }

    public function satu_tugasan($id)
    {
        $tugasan = Tugasan::findOrFail($id);
        return response()->json($tugasan);
    }

    public function siap($id, Request $request)
    {
        $tugasan = Tugasan::find($id);

        $url = $request->file('url_gambar')->store(
            'tugasan', 'public'
        );

        $tugasan->update([
            'catatan_petugas' => $request->catatan_petugas,
            'status' => 'siap',
            'url_gambar' => $url,

        ]);

        return response()->json($tugasan);
    }

    public function sah_tugasan($id, Request $request)
    {
        $tugasan = Tugasan::find($id);

        $tugasan->update([
            'status' => 'sah',
            'catatan_pengesah' => $request->catatan_pengesah,
            'pengesah_id' => $request->pengesah_id,
        ]);

        return response()->json($tugasan);
    }

    public function rosak($id)
    {
        $tugasan = Tugasan::find($id);

        $tugasan->update([
            'status' => 'rosak',
        ]);

        return response()->json($tugasan);

    }

    public function satu_tandan(Tandan $tandan)
    {
        return $tandan;
    }

}
