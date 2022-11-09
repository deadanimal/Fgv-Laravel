<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\Tandan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PokokController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.pokok.index', [
            'pokoks' => Pokok::all(),
            'aktif' => Pokok::where('status_pokok', 'aktif')->count(),
            'tidak_aktif' => Pokok::where('status_pokok', 'tidak_aktif')->count(),
        ]);
    }

    public function create()
    {
        return view('pengurusanPokokInduk.pokok.create');
    }

    public function edit(Pokok $pokok)
    {
        return view('pengurusanPokokInduk.pokok.edit', compact('pokok'));
    }

    public function store(Request $request)
    {
        Pokok::create($request->all());

        return redirect()->route('pi.p.index');
    }

    public function update(Request $request, Pokok $pokok)
    {
        $pokok->update($request->all());

        return redirect()->route('pi.p.index');
    }

    public function delete(Pokok $pokok)
    {
        Tandan::where('pokok_id', $pokok->id)->delete();
        $pokok->delete();

        return redirect()->route('pi.p.index');
    }

    public function downloadqr(Pokok $pokok)
    {
        $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
        QrCode::generate($url, public_path('qrcode_pokok.svg'));
        return response()->download('qrcode_pokok.svg');
    }

}
