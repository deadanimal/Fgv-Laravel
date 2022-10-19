<?php

namespace App\Http\Controllers;

use App\Models\Balut;
use App\Models\Kualiti;
use App\Models\Pendebungaan;
use App\Models\Pokok;
use App\Models\Tandan;
use App\Models\Tuai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class TandanController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.tandan.index', [
            'tandans' => Tandan::with('pokok')->orderByDesc('updated_at')->get(),
        ]);
    }

    public function create()
    {
        return view('pengurusanPokokInduk.tandan.create');
    }

    public function edit(Tandan $tandan)
    {
        $pokoks = Pokok::all();
        return view('pengurusanPokokInduk.tandan.edit', compact('tandan', 'pokoks'));
    }

    public function store(Request $request)
    {
        Tandan::create($request->only('no_daftar'));

        return redirect()->route('pi.t.index');
    }

    public function update(Request $request, Tandan $tandan)
    {
        if ($request->create2) {
            $file = Storage::putFileAs('/public/tandan', $request->file('file'), $tandan->id);
            $tandan->update([
                'tarikh_daftar' => $request->tarikh_daftar,
                'file' => $file,
            ]);
            return redirect()->route('pi.t.index');
        }

        $tandan->update([
            'pokok_id' => $request->pokok_id,
            'tarikh_daftar' => $request->tarikh_daftar,
            'no_pokok' => $request->no_pokok,
            'umur' => $request->umur,
        ]);

        if ($tandan->balut) {
            $tandan->balut->update([
                'tarikh' => $request->b_tarikh,
                'petugas' => $request->b_petugas,
                'pengesah' => $request->b_pengesah,
            ]);
        } else {
            if ($request->b_tarikh) {
                Balut::create([
                    'tandan_id' => $tandan->id,
                    'tarikh' => $request->b_tarikh,
                    'petugas' => $request->b_petugas,
                    'pengesah' => $request->b_pengesah,
                ]);
            }
        }

        if ($tandan->pendebungaan) {
            $tandan->pendebungaan->update([
                'tarikh' => $request->p_tarikh,
                'petugas' => $request->p_petugas,
                'pengesah' => $request->p_pengesah,
            ]);
        } else {
            if ($request->p_tarikh) {
                Pendebungaan::create([
                    'tandan_id' => $tandan->id,
                    'tarikh' => $request->p_tarikh,
                    'petugas' => $request->p_petugas,
                    'pengesah' => $request->p_pengesah,
                ]);
            }
        }

        if ($tandan->kualiti) {
            $tandan->kualiti->update([
                'tarikh' => $request->k_tarikh,
                'petugas' => $request->k_petugas,
                'pengesah' => $request->k_pengesah,
            ]);
        } else {
            if ($request->k_tarikh) {
                Kualiti::create([
                    'tandan_id' => $tandan->id,
                    'tarikh' => $request->k_tarikh,
                    'petugas' => $request->k_petugas,
                    'pengesah' => $request->k_pengesah,
                ]);
            }
        }

        if ($tandan->tuai) {
            $tandan->tuai->update([
                'tarikh' => $request->t_tarikh,
                'petugas' => $request->t_petugas,
                'pengesah' => $request->t_pengesah,
            ]);
        } else {
            if ($request->t_tarikh) {
                Tuai::create([
                    'tandan_id' => $tandan->id,
                    'tarikh' => $request->t_tarikh,
                    'petugas' => $request->t_petugas,
                    'pengesah' => $request->t_pengesah,
                ]);
            }
        }

        alert()->success('Berjaya Dikemaskini', 'Data telah disimpan');
        return back();
    }

    public function delete()
    {

    }

    public function MuatNaikDokumenTandan()
    {
        return view('pengurusanPokokInduk.tandan.muatNaikDokumen');
    }
}
