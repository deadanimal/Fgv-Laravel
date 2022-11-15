<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\Tandan;
use App\Models\Tugasan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TandanController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.tandan.index', [
            'tandans' => Tandan::with('pokok')->orderByDesc('created_at')->get(),
        ]);
    }

    public function create()
    {
        return view('pengurusanPokokInduk.tandan.create');
    }

    public function edit(Tandan $tandan)
    {
        $pokoks = Pokok::all();
        $tugasans = Tugasan::where('tandan_id', $tandan->id)->get();
        return view('pengurusanPokokInduk.tandan.edit', compact('tandan', 'pokoks', 'tugasans'));
    }

    public function store(Request $request)
    {
        $tandan = Tandan::where('no_daftar', $request->no_daftar)->first();

        if ($tandan != null) {
            alert()->error('Gagal', 'No daftar telah didaftar');
            return back();
        }
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

        alert()->success('Berjaya Dikemaskini', 'Data telah disimpan');
        return back();
    }

    public function delete(Tandan $tandan)
    {
        // alert()->success('Berjaya Dibuang', 'Tandan ' . $tandan->no_daftar . ' telah dibuang');
        $tandan->delete();

        return back();
    }

    public function MuatNaikDokumenTandan()
    {
        return view('pengurusanPokokInduk.tandan.muatNaikDokumen');
    }

    public function downloadqr(Tandan $tandan)
    {
        $url = URL::to('/pengurusan-pokok-induk/tandan/edit/' . $tandan->id);

        QrCode::size(113.38582677)->generate($url, public_path('qr/qrcode_tandan.svg'));

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'tandan' => $tandan,
            'type' => 3,
        ]);

        return $pdf->download('qrcode.pdf');

    }

    public function generateQR(Request $requests)
    {
        $bulan = now()->monthName;
        switch ($bulan) {
            case 'January':
                $code = "A";
                break;
            case 'February':
                $code = "B";
                break;
            case 'March':
                $code = "C";
                break;
            case 'April':
                $code = "D";
                break;
            case 'May':
                $code = "E";
                break;
            case 'June':
                $code = "F";
                break;
            case 'July':
                $code = "G";
                break;
            case 'August':
                $code = "H";
                break;
            case 'September':
                $code = "I";
                break;
            case 'October':
                $code = "J";
                break;
            case 'November':
                $code = "K";
                break;
            case 'December':
                $code = "L";
                break;
        }

        $bilqr = $requests->bilqr;
        for ($i = 0; $i < $bilqr; $i++) {
            $tandan = Tandan::create([
            ]);
            $url = URL::to('/pengurusan-pokok-induk/tandan/edit/' . $tandan->id);
            $name = "bulktandan/tandan" . $tandan->id . ".svg";
            QrCode::size(113.38582677)->generate($url, public_path($name));
            $temp = $code . $tandan->id;
            $t['no_tandan'][$tandan->id] = str_replace(' ', '', $temp);
            $t['name'][$tandan->id] = $name;
            $tandans[] = $tandan;
            $tandan->update([
                'tempid' => str_replace(' ', '', $temp),
            ]);
        }

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'type' => 4,
            'tandans' => $tandans,
            'no_tandans' => $t,
        ]);

        return $pdf->download('QR.pdf');

    }

    public function downloadmanyQR(Request $request)
    {
        $pokoks = $request->pokok;

    }

    public function search(Request $request)
    {
        $tandan = Tandan::with('pokok:id,no_pokok')->where('no_daftar', $request->no_daftar)->orderByDesc('updated_at')->get();
        return view('pengurusanPokokInduk.tandan.index', [
            'tandans' => $tandan,
            'no_daftar' => $request->no_daftar,
        ]);

    }
}
