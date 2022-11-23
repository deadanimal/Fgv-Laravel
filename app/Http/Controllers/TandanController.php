<?php

namespace App\Http\Controllers;

use App\Models\Kerosakan;
use App\Models\Pokok;
use App\Models\RunningNo;
use App\Models\Tandan;
use App\Models\User;
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

    public function edit($tandan)
    {
        $tandan = Tandan::with(['bagging', 'cp', 'qc', 'harvest'])->where('id', $tandan)->first();
        $pokoks = Pokok::all();

        $kerosakan = Kerosakan::find($tandan->kerosakans_id);
        $nama = [];
        if ($tandan->bagging != null) {
            $nama['bagging']['petugas'] = User::find($tandan->bagging->id_sv_balut)->nama ?? '';
            $nama['bagging']['pengesah'] = User::find($tandan->bagging->pengesah_id)->nama ?? '';
            $nama['bagging']['tarikh'] = $tandan->bagging->created_at->format('d/m/Y');
        }
        if ($tandan->cp != null) {
            $nama['cp']['petugas'] = User::find($tandan->cp->id_sv_cp)->nama ?? '';
            $nama['cp']['pengesah'] = User::find($tandan->cp->pengesah_id)->nama ?? '';
            $nama['cp']['tarikh'] = $tandan->cp->created_at->format('d/m/Y');

            // if ($tandan->cp->kerosakans_id != null) {
            //     $rosakCP = Kerosakan::find($tandan->cp->kerosakans_id);
            //     $nama['cp']['tarikh_rosak'] = $tandan->cp->updated_at->format('d/m/Y');
            // }
        }
        if ($tandan->qc != null) {
            $nama['qc']['petugas'] = User::find($tandan->qc->id_sv_qc)->nama ?? '';
            $nama['qc']['pengesah'] = User::find($tandan->qc->pengesah_id)->nama ?? '';
            $nama['qc']['tarikh'] = $tandan->qc->created_at->format('d/m/Y');

        }
        if ($tandan->harvest != null) {
            $nama['harvest']['petugas'] = User::find($tandan->harvest->id_sv_harvest)->nama ?? '';
            $nama['harvest']['pengesah'] = User::find($tandan->harvest->pengesah_id)->nama ?? '';
            $nama['harvest']['tarikh'] = $tandan->harvest->created_at->format('d/m/Y');

            // if ($tandan->harvest->kerosakans_id != null) {
            //     $rosakHarvest = Kerosakan::find($tandan->harvest->kerosakans_id);
            //     $nama['harvest']['tarikh_rosak'] = $tandan->harvest->updated_at->format('d/m/Y');

            // }
        }

        return view('pengurusanPokokInduk.tandan.edit', [
            'tandan' => $tandan,
            'pokoks' => $pokoks,
            'nama' => $nama,
            'kerosakan' => $kerosakan,
            // 'rosakCP' => $rosakCP ?? '',
            // 'rosakHarvest' => $rosakHarvest ?? '',
        ]);
    }

    public function store(Request $request)
    {
        $tandan = Tandan::where('no_daftar', $request->no_daftar)->first();

        if ($tandan != null) {
            alert()->error('Gagal', 'No daftar telah didaftar');
            return back();
        }
        $tandan = Tandan::create($request->only('no_daftar'));

        activity()->event('CIPTA')->log('Tandan No Daftar:' . $tandan->no_daftar . ' telah dicipta');
        alert()->success('Berjaya', 'Data telah disimpan');

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
            activity()->event('KEMASKINI')->log('Tandan No Daftar:' . $tandan->no_daftar . ' telah dikemaskini');
            alert()->success('Berjaya', 'Data telah dikemaskini');
            return redirect()->route('pi.t.index');
        }

        $tandan->update([
            'pokok_id' => $request->pokok_id,
            'tarikh_daftar' => $request->tarikh_daftar,
            'no_pokok' => $request->no_pokok,
            'umur' => $request->umur,
        ]);
        activity()->event('KEMASKINI')->log('Tandan No Daftar:' . $tandan->no_daftar . ' telah dikemaskini');
        alert()->success('Berjaya', 'Data telah dikemaskini');
        return back();
    }

    public function delete(Tandan $tandan)
    {
        activity()->event('HAPUS')->log('Tandan No Daftar:' . $tandan->no_daftar . ' telah dihapus');
        alert()->success('Berjaya', 'Data telah dihapus');
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
        $tahunRaw = (string) now()->year;
        $tahun = $tahunRaw[2] . $tahunRaw[3];

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

        $RN = RunningNo::where('name', $requests->induk)->first();

        if ($bulan != $RN->month) {
            $RN->update([
                'month' => $bulan,
                'current_no' => 0,
            ]);
        }

        $cRN = $RN->current_no;
        for ($i = 0; $i < $bilqr; $i++) {
            $tandan = Tandan::create([]);
            $url = URL::to('/pengurusan-pokok-induk/tandan/edit/' . $tandan->id);
            $name = "bulktandan/tandan" . $tandan->id . ".svg";
            QrCode::size(113.38582677)->generate($url, public_path($name));

            if ($requests->induk == "F") {
                $temp = $tahun . $code . "P" . sprintf('%04d', $cRN);
            } else {
                $temp = $tahun . $code . sprintf('%04d', $cRN);
            }

            $t['no_tandan'][$tandan->id] = str_replace(' ', '', $temp);
            $t['name'][$tandan->id] = $name;
            $tandans[] = $tandan;
            $tandan->update([
                'no_daftar' => str_replace(' ', '', $temp),
            ]);
            $cRN++;
        }

        $RN->update([
            'current_no' => $cRN,
        ]);

        $pdf = Pdf::loadView('pengurusanPokokInduk.downloadQR', [
            'type' => 4,
            'tandans' => $tandans,
            'no_tandans' => $t,
        ]);

        return $pdf->download('QR.pdf');

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
