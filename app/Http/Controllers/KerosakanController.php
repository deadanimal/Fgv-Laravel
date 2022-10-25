<?php

namespace App\Http\Controllers;

use App\Models\Kerosakan;
use Illuminate\Http\Request;

class KerosakanController extends Controller
{
    public function index()
    {
        return view('kerosakan.index', [
            'kerosakans' => Kerosakan::all(),
        ]);
    }

    public function store(Request $request)
    {
        Kerosakan::create([
            'faktor' => $request->faktor,
            'nama' => $request->nama,
        ]);

        alert()->success('Berjaya Ditambah', 'Kerosakan Berjaya Ditambah');
        activity()->event('Kerosakan')->log('Tambah Data Kerosakan');
        return back();
    }

    public function update(Kerosakan $kerosakan, Request $request)
    {
        $kerosakan->update($request->all());

        alert()->success('Berjaya Dikemaskini', 'Kerosakan Berjaya Dikemaskini');
        activity()->event('Kerosakan')->log('Kemaskini Data Kerosakan');
        return back();

    }
    public function delete(Kerosakan $kerosakan, Request $request)
    {
        $kerosakan->delete($request->all());

        alert()->success('Berjaya Dibuang', 'Kerosakan Berjaya Dibuang');
        activity()->event('Kerosakan')->log('Buang Data Kerosakan');
        return back();

    }
}
