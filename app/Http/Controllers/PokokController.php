<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\Tandan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PokokController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.pokok.index', [
            'pokoks' => Pokok::orderByDesc('created_at')->get(['id', 'blok', 'baka', 'progeny', 'no_pokok']),
            'aktif' => Pokok::where('status_pokok', 'aktif')->count(),
            'tidak_aktif' => Pokok::where('status_pokok', 'tak aktif')->count(),
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
        $pokok = Pokok::create($request->all());

        activity()->event('CIPTA')->log('Pokok No Pokok:' . $pokok->no_pokok . ' telah dicipta');
        alert()->success('Berjaya', 'Data telah disimpan');

        return redirect()->route('pi.p.index');
    }

    public function update(Request $request, Pokok $pokok)
    {
        $pokok->update($request->all());
        activity()->event('KEMASKINI')->log('Pokok No Pokok:' . $pokok->no_pokok . ' telah dikemaskini');
        alert()->success('Berjaya', 'Data telah dikemaskini');

        return redirect()->route('pi.p.index');
    }

    public function delete(Pokok $pokok)
    {
        Tandan::where('pokok_id', $pokok->id)->delete();
        $pokok->delete();

        activity()->event('HAPUS')->log('Pokok No Pokok:' . $pokok->no_pokok . ' telah dihapus');
        alert()->success('Berjaya', 'Data telah dihapus');

        return redirect()->route('pi.p.index');
    }

    public function downloadqr(Pokok $pokok)
    {

        $file = public_path('bulkpokok/pokok' . $pokok->id . '.svg');
        if (!file_exists($file)) {
            $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
            QrCode::size(264)->generate($url, public_path('bulkpokok/pokok' . $pokok->id . ".svg"));
        }

        $pokok = DB::table('pokoks')->select(DB::raw("id,CONCAT(progeny,no_pokok) AS name"))->where('id', $pokok->id)->first();

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'pokok' => $pokok,
            'type' => 1,
        ]);

        return $pdf->download('qrcode.pdf');

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
            'aktif' => Pokok::where('status_pokok', 'aktif')->count(),
            'tidak_aktif' => Pokok::where('status_pokok', 'tak aktif')->count(),
        ]);

    }

    public function bulkqr()
    {
        set_time_limit(300);
        // $pokoks = Pokok::all();
        // foreach ($pokoks as $key => $value) {
        //     $new = str_replace(' ', '', $value->progeny);
        //     $value->update([
        //         'progeny' => $new,
        //     ]);
        // }
        // dd('end');

        // $pokoks = Pokok::all(['id', 'progeny', 'no_pokok']);
        // foreach ($pokoks as $pokok) {
        //     $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
        //     $name = "bulkpokok/pokok" . $pokok->id . ".svg";
        // QrCode::size(264.56692913)->generate($url, public_path($name));
        //     $temp = $pokok->progeny . $pokok->no_pokok;
        //     $p['no_pokok'][$pokok->id] = str_replace(' ', '', $temp);
        //     $p['name'][$pokok->id] = $name;
        // }

        // $pokoks = Pokok::all();

        $pokoks = DB::table('pokoks')->select(DB::raw("id,CONCAT(progeny,no_pokok) AS Name"))->get();

        foreach ($pokoks as $pokok) {
            // $qrcode = base64_encode(QrCode::size(264)->generate($url));
            $file = public_path('bulkpokok/pokok' . $pokok->id . '.svg');

            if (!file_exists($file)) {
                $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
                QrCode::size(264)->generate($url, public_path('bulkpokok/pokok' . $pokok->id . ".svg"));
            }

            // $pokok->qr = $qrcode;
        }
        alert()->success('QR CODE', 'Semua pokok QR berjaya dijana');
        return back();
        // $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
        //     'type' => 2,
        //     'pokoks' => $pokoks,
        // ]);
        // return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));

        // return $pdf->download('qrcode.pdf');

    }

    public function dbulkqr()
    {
        set_time_limit(300);

        $pokoks = DB::table('pokoks')->select(DB::raw("id,CONCAT(progeny,no_pokok) AS name"))->get();

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'type' => 2,
            'pokoks' => $pokoks,
        ]);

        return $pdf->download('qrcode.pdf');

    }

    public function selbulkqr(Request $request)
    {
        foreach ($request->pokoks as $pokok_id) {
            // $pokok = Pokok::find($pokok_id);
            // $pokok['url'] = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id);
            // $name = "bulkpokok/pokok" . $pokok->id . ".svg";
            // $qrcode = base64_encode(QrCode::format('svg')->size(264.56692913)->errorCorrection('H')->generate('string'));
            // $temp = $pokok->progeny . $pokok->no_pokok;
            // $p['no_pokok'][$pokok->id] = str_replace(' ', '', $temp);
            // $p['name'][$pokok->id] = $name;
            // $p['qr'][$pokok->id] = $qrcode;

            // $pokoks[] = $pokok;

            $file = public_path('bulkpokok/pokok' . $pokok_id . '.svg');
            if (!file_exists($file)) {
                $url = URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok_id);
                QrCode::size(264)->generate($url, public_path('bulkpokok/pokok' . $pokok_id . ".svg"));
            }

            $pokok = DB::table('pokoks')->select(DB::raw("id,CONCAT(progeny,no_pokok) AS name"))->where('id', $pokok_id)->first();

            $pokoks[] = $pokok;

        }

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'type' => 2,
            'pokoks' => $pokoks,
        ]);
        return $pdf->download('qrcode.pdf');

    }

}
