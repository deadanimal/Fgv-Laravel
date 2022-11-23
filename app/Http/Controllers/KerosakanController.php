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
        $kerosakan = Kerosakan::create([
            'faktor' => $request->faktor,
            'nama' => $request->nama,
        ]);

        activity()->event('CIPTA')->log('Kerosakan Faktor:' . $kerosakan->faktor . ' telah dicipta');
        alert()->success('Berjaya', 'Data telah disimpan');

        return back();
    }

    public function update(Kerosakan $kerosakan, Request $request)
    {
        $kerosakan->update($request->all());

        activity()->event('KEMASKINI')->log('Kerosakan Faktor:' . $kerosakan->faktor . ' telah dikemaskini');
        alert()->success('Berjaya', 'Data telah dikemaskini');

        return back();

    }
    public function delete(Kerosakan $kerosakan, Request $request)
    {
        $kerosakan->delete($request->all());

        activity()->event('HAPUS')->log('Kerosakan Faktor:' . $kerosakan->faktor . ' telah dihapus');
        alert()->success('Berjaya', 'Data telah dihapus');

        return back();

    }
}
