<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\ControlPollination;
use App\Models\Harvest;
use App\Models\Pokok;
use App\Models\QualityControl;
use App\Models\Tugasan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function motherpalm()
    {
        return view('laporan.motherpalm.index');
    }
    public function motherpalmStore(Request $request)
    {
        switch ($request->laporan) {

            case 1:

                // $edit_mula = explode('/', $request->tarikh_mula);
                // $edit_akhir = explode('/', $request->tarikh_akhir);
                // $new_mula = $edit_mula[2] . '-' . $edit_mula[1] . '-' . $edit_mula[0];
                // $new_akhir = $edit_akhir[2] . '-' . $edit_akhir[1] . '-' . $edit_akhir[0];

                // $mula = date('Y-m-d', strtotime($new_mula));
                // $akhir = date('Y-m-d', strtotime($new_akhir));
                // $mula = $request->tarikh_mula;
                // $akhir = $request->tarikh_akhir;
                $mula = Carbon::createFromFormat('Y-m-d', $request->tarikh_mula);
                $akhir = Carbon::createFromFormat('Y-m-d', $request->tarikh_akhir);

                switch ($request->kategori) {
                    case 'balut':
                        $tugasan = Bagging::with('tandan')->whereBetween('created_at', [$mula, $akhir])->get();
                        break;
                    case 'debung':
                        $tugasan = ControlPollination::with('tandan')->whereBetween('created_at', [$mula, $akhir])->get();
                        break;
                    case 'tuai':
                        $tugasan = Harvest::with('tandan')->whereBetween('created_at', [$mula, $akhir])->get();
                        break;
                    case 'kawal':
                        $tugasan = QualityControl::with('tandan')->whereBetween('created_at', [$mula, $akhir])->get();
                        break;
                    default:
                        return 'kategori salah';
                        break;
                }

                if ($tugasan == null) {
                    alert()->error('Gagal', 'Tiada Tugasan');
                    return back();
                }

                $period = new DatePeriod(
                    new DateTime($mula),
                    new DateInterval('P1D'),
                    new DateTime(date('Y-m-d', strtotime($akhir . ' +1 day')))
                );
                foreach ($period as $value) {
                    $date[] = $value->format('d/m/Y');
                }

                return view('laporan.motherpalm.show1', [
                    'laporans' => $tugasan,
                    'dates' => $date,
                ]);

                break;
            case 3:
                $result = $this->third($request);
                return view('laporan.motherpalm.show3', compact('result'));

            default:
                alert()->error('Gagal', 'Belum Mula');
                return back();
                break;
        }

    }

    public function first($request)
    {
        $mula = date($request->tarikh_mula);
        $akhir = date($request->tarikh_akhir);
        $tugasans = Tugasan::where('jenis', $request->kategori)
        // ->whereBetween('tarikh', [$mula, $akhir])
            ->get();
        $result = null;
        foreach ($tugasans as $tugasan) {
            $str = explode('/', $tugasan->tarikh);
            $new_tarikh = $str[2] . "-" . $str[1] . "-" . $str[0];
            $f_tarikh = date('Y-m-d', strtotime($new_tarikh));

            if (($f_tarikh >= $mula) && ($f_tarikh <= $akhir)) {
                $result[] = $tugasan;
            }
        }

        if ($result == null) {
            alert()->error('Gagal', 'Tiada Tugasan');
            return back();
        }

        $period = new DatePeriod(
            new DateTime($mula),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d', strtotime($akhir . ' +1 day')))
        );
        foreach ($period as $value) {
            $date[] = $value->format('d/m/Y');
        }

        return view('laporan.motherpalm.show1', [
            'laporans' => $result,
            'dates' => $date,
        ]);

    }

    public function third(Request $request)
    {
        $list = Pokok::select('blok', 'baka')->distinct()->get();
        foreach ($list as $key => $l) {
            $pokoks = Pokok::with('tandan')->where('blok', $l->blok)->where('baka', $l->baka)->where('jantina', 'Motherpalm')->get();

            $temp = 0;
            $result[$key]['jan'] = 0;
            $result[$key]['feb'] = 0;
            $result[$key]['mar'] = 0;
            $result[$key]['apr'] = 0;
            $result[$key]['may'] = 0;
            $result[$key]['jun'] = 0;
            $result[$key]['jul'] = 0;
            $result[$key]['aug'] = 0;
            $result[$key]['sep'] = 0;
            $result[$key]['oct'] = 0;
            $result[$key]['nov'] = 0;
            $result[$key]['dec'] = 0;
            foreach ($pokoks as $p) {
                $temp += $p->tandan->count();
                foreach ($p->tandan as $tandan) {
                    switch ($tandan->created_at->month) {
                        case 1:
                            $result[$key]['jan']++;
                            break;
                        case 2:
                            $result[$key]['feb']++;
                            break;
                        case 3:
                            $result[$key]['mar']++;
                            break;
                        case 4:
                            $result[$key]['apr']++;
                            break;
                        case 5:
                            $result[$key]['may']++;
                            break;
                        case 6:
                            $result[$key]['jun']++;
                            break;
                        case 7:
                            $result[$key]['jul']++;
                            break;
                        case 8:
                            $result[$key]['aug']++;
                            break;
                        case 9:
                            $result[$key]['sep']++;
                            break;
                        case 10:
                            $result[$key]['oct']++;
                            break;
                        case 11:
                            $result[$key]['nov']++;
                            break;
                        case 12:
                            $result[$key]['dec']++;
                            break;
                    }
                }
            }

            if (count($pokoks) == 0) {
                $result[$key]['j_motherpalm'] = 0;
                $result[$key]['average'] = 0;
            } else {
                $result[$key]['j_motherpalm'] = count($pokoks);
                $result[$key]['average'] = $temp / count($pokoks);
            }

            $result[$key]['blok'] = $l->blok;
            $result[$key]['baka'] = $l->baka;
            $result[$key]['j_bunga'] = $temp;

        }
        if ($request->pdf == 1) {

            $pdf = Pdf::loadView('laporan.motherpalm.table.table3', [
                'result' => $result,
                'pdf' => 1,
            ]);
            return $pdf->download('1P1F Motherpalm.pdf');
        }

        return $result;

    }

    public function fatherpalm()
    {
        return view('laporan.fatherpalm.index');
    }

}
