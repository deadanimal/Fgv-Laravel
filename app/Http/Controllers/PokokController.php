<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\Tandan;
use Barryvdh\DomPDF\Facade\Pdf;
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
        QrCode::size(264.56692913)->generate($url, public_path('qr/qrcode_pokok.svg'));

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'pokok' => $pokok,
            'type' => 1,
        ]);

        return $pdf->download('qrcode.pdf');
        // $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
        // QrCode::size(500)->generate($url, public_path('qrcode_pokok.svg'));
        // return response()->download('qrcode_pokok.svg');

    }

    public function search(Request $request)
    {
        $pokok = Pokok::whereNotNull('id');

        if ($request->blok != null) {
            $pokok->where('blok', $request->blok);
        }
        if ($request->baka != null) {
            $pokok->where('baka', $request->baka);
        }
        if ($request->progeny != null) {
            $pokok->where('progeny', $request->progeny);
        }
        if ($request->no_pokok != null) {
            $pokok->where('no_pokok', $request->no_pokok);
        }

        return view('pengurusanPokokInduk.pokok.index', [
            'pokoks' => $pokok->get(),
            'blok' => $request->blok,
            'baka' => $request->baka,
            'progeny' => $request->progeny,
            'no_pokok' => $request->no_pokok,
            // 'aktif' => Pokok::where('status_pokok', 'aktif')->count(),
            // 'tidak_aktif' => Pokok::where('status_pokok', 'tidak_aktif')->count(),
        ]);

    }

    public function bulkqr()
    {
        $pokoks = Pokok::all();
        foreach ($pokoks as $pokok) {
            $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
            $name = "bulkpokok/pokok" . $pokok->id . ".svg";
            QrCode::size(264.56692913)->generate($url, public_path($name));
            $temp = $pokok->progeny . $pokok->no_pokok;
            $p['no_pokok'][$pokok->id] = str_replace(' ', '', $temp);
            $p['name'][$pokok->id] = $name;
        }

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'type' => 2,
            'pokoks' => $pokoks,
            'no_pokoks' => $p,
        ]);
        // return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));

        return $pdf->download('qrcode.pdf');

    }

}
