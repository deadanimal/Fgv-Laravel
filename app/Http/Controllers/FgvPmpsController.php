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
        $t = Tugasan::create([
            'tandan_id' => $request->tandan_id,
            'jenis' => $request->jenis, //['balut','debung','kawal','tuai']
            'catatan' => $request->catatan, // description pelaksanaan
            'status' => 'dicipta', //['dicipta','siap','disahkan','rosak']
            'tarikh' => $request->tarikh,
            'petugas_id' => $request->petugas_id, // user yang perlu melaksanakan tugas
        ]);

        $url = $request->file('url_gambar')->store(
            'tugasan', 'public'
        );

        $t->update([
            'url_gambar' => $url,
        ]);

        return response()->json(Tugasan::find($t->id));

    }

    public function satu_tugasan($id)
    {
        $tugasan = Tugasan::findOrFail($id);
        return response()->json($tugasan);
    }

    public function siap($id, Request $request)
    {
        $tugasan = Tugasan::find($id);

        $tugasan->update([
            'catatan_petugas' => $request->catatan_petugas,
            'status' => 'siap',
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
