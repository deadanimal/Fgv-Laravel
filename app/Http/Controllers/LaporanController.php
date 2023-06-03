<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\ControlPollination;
use App\Models\Harvest;
use App\Models\Pokok;
use App\Models\QualityControl;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function motherpalm()
    {
        $currentYear = Carbon::now()->year;
        $pastYears = 5;
        $years = [];

        for ($i = $currentYear; $i >= $currentYear - $pastYears; $i--) {
            $years[$i] = $i;
        }

        return view('laporan.motherpalm.index', compact('years'));
    }

    public function motherpalmStore(Request $request)
    {
        if ($request->hb == "h") {
            $tarikh_mula = date($request->tarikh_mula);
            $tarikh_akhir = date($request->tarikh_akhir);
        }
        $type = $request->kategori;
        if ($type == "balut") {
            switch ($request->laporan) {
                case '1':
                    $result = $this->BalutLaporan1($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.balut1', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'tarikh_mula' => $tarikh_mula,
                        'tarikh_akhir' => $tarikh_akhir,
                        'hb' => $request->hb,
                    ]);
                    break;
                case '2':
                    // $result = $this->BalutLaporan2();

                    break;
                case '3':
                    $result = $this->BalutLaporan3($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    if ($request->tarikh_mula) {
                        $nTarikhMula = DateTime::createFromFormat('Y-m-d', $tarikh_mula)->format('d-m-Y');
                        $nTarikhAkhir = DateTime::createFromFormat('Y-m-d', $tarikh_akhir)->format('d-m-Y');
                    }
                    return view('laporan.motherpalm.balut3', [
                        'result' => $result,
                        'hb' => $request->hb,
                        'bulan' => $request->bulan,
                        'tm' => $nTarikhMula ?? null,
                        'ta' => $nTarikhAkhir  ?? null,
                    ]);
                    break;
                case '4':
                    $result = $this->BalutLaporan4($request->bulan, $request->tahun);
                    return view('laporan.motherpalm.balut4', compact('result'));
                    break;
                default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
            }
        }

        if ($type == 'debung') {
            $results = $this->CpLaporan1($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir);
            return view('laporan.motherpalm.cp1', compact('results'));
        }


        if ($type == "master") {
            return view('laporan.motherpalm.master');
        }

        alert()->error('Fail', "In Development");
        return back();
    }

    public function BalutLaporan1($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b') {
            if ($bulan == "all") {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        } else if ($hb == 'h') {
            $Qcs = QualityControl::with('pokok')->whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])
                ->whereHas('pokok', function ($pokok) {
                    $pokok->where('status_pokok', 'aktif')
                        ->where('jantina', 'motherpalm');
                })
                ->get();
        }

        $listBlokBaka = Pokok::select('blok', 'baka')
            ->where('status_pokok', 'aktif')
            ->where('jantina', 'Motherpalm')
            ->distinct()
            ->get();

        $result = [];
        $result['T'] = array_fill(0, 12, 0);
        foreach ($listBlokBaka as $key => $lbb) {
            $result[$key]['01'] = 0;
            $result[$key]['02'] = 0;
            $result[$key]['03'] = 0;
            $result[$key]['04'] = 0;
            $result[$key]['05'] = 0;
            $result[$key]['06'] = 0;
            $result[$key]['07'] = 0;
            $result[$key]['08'] = 0;
            $result[$key]['09'] = 0;
            $result[$key]['10'] = 0;
            $result[$key]['11'] = 0;
            $result[$key]['12'] = 0;
            $result[$key]['takRosak'] = 0;
            foreach ($Qcs as $qc) {

                if ($qc->pokok->blok == $lbb->blok && $qc->pokok->baka == $lbb->baka) {
                    $month = $qc->created_at->format('m');
                    switch ($month) {
                        case '01':
                            $result[$key]['01']++;
                            break;
                        case '02':
                            $result[$key]['02']++;
                            break;
                        case '03':
                            $result[$key]['03']++;
                            break;
                        case '04':
                            $result[$key]['04']++;
                            break;
                        case '05':
                            $result[$key]['05']++;
                            break;
                        case '06':
                            $result[$key]['06']++;
                            break;
                        case '07':
                            $result[$key]['07']++;
                            break;
                        case '08':
                            $result[$key]['08']++;
                            break;
                        case '09':
                            $result[$key]['09']++;
                            break;
                        case '10':
                            $result[$key]['10']++;
                            break;
                        case '11':
                            $result[$key]['11']++;
                            break;
                        case '12':
                            $result[$key]['12']++;
                            break;
                    }
                    $result[$key]['jumlah'] = $result[$key]['01'] + $result[$key]['02'] + $result[$key]['03'] + $result[$key]['04'] + $result[$key]['05'] + $result[$key]['06'] + $result[$key]['07'] + $result[$key]['08'] + $result[$key]['09'] + $result[$key]['10'] + $result[$key]['11'] + $result[$key]['12'];
                    if (is_null($qc->kerosakan_id)) {
                        $result[$key]['takRosak']++;
                    }
                    $result['T'][$month - 1]++;
                }
            }
            $result[$key]['j_motherpalm'] = Pokok::where('status_pokok', 'aktif')
                ->where('jantina', 'Motherpalm')
                ->where('blok', $lbb->blok)
                ->where('baka', $lbb->baka)->count();
        }
        $result['listBlokBaka'] = $listBlokBaka;
        return $result;
    }

    public function BalutLaporan3($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b') {
            for ($i = 1; $i <= 12; $i++) {
                $M = sprintf('%02d', $i);
                $from1 = date('2023-' . $M . '-01');
                $to1 = date('2023-' . $M . '-10');
                $from2 = date('2023-' . $M . '-11');
                $to2 = date('2023-' . $M . '-20');
                $from3 = date('2023-' . $M . '-21');
                $day = Carbon::now()->month($M)->daysInMonth;
                $dayT = "2023-' . $M . '-" . $day;
                $to3 = date($dayT);
                $shortMonthName = Carbon::createFromFormat('m', $M)->format('M');
                $result[$shortMonthName]['bagging'][1] =  Bagging::whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['bagging'][2] =  Bagging::whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['bagging'][3] =  Bagging::whereBetween('created_at', [$from3, $to3])->count();

                $result[$shortMonthName]['bagging'][4] =  $result[$shortMonthName]['bagging'][1] + $result[$shortMonthName]['bagging'][2] + $result[$shortMonthName]['bagging'][3];

                $result[$shortMonthName]['kcp'][1] =  ControlPollination::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['kcp'][2] =  ControlPollination::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['kcp'][3] =  ControlPollination::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from3, $to3])->count();
                $result[$shortMonthName]['kcp'][4] =  $result[$shortMonthName]['kcp'][1] + $result[$shortMonthName]['kcp'][2] + $result[$shortMonthName]['kcp'][3];


                $result[$shortMonthName]['cp'][1] =  ControlPollination::whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['cp'][2] =  ControlPollination::whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['cp'][3] =  ControlPollination::whereBetween('created_at', [$from3, $to3])->count();
                $result[$shortMonthName]['cp'][4] =  $result[$shortMonthName]['cp'][1] + $result[$shortMonthName]['cp'][2] + $result[$shortMonthName]['cp'][3];


                $result[$shortMonthName]['qc'][1] =  QualityControl::whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['qc'][2] =  QualityControl::whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['qc'][3] =  QualityControl::whereBetween('created_at', [$from3, $to3])->count();
                $result[$shortMonthName]['qc'][4] =  $result[$shortMonthName]['qc'][1] + $result[$shortMonthName]['qc'][2] + $result[$shortMonthName]['qc'][3];


                $result[$shortMonthName]['kqc'][1] =  QualityControl::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['kqc'][2] =  QualityControl::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['kqc'][3] =  QualityControl::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from3, $to3])->count();
                $result[$shortMonthName]['kqc'][4] =  $result[$shortMonthName]['kqc'][1] + $result[$shortMonthName]['kqc'][2] + $result[$shortMonthName]['kqc'][3];


                $result[$shortMonthName]['h'][1] =  Harvest::whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['h'][2] =  Harvest::whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['h'][3] =  Harvest::whereBetween('created_at', [$from3, $to3])->count();
                $result[$shortMonthName]['h'][4] =  $result[$shortMonthName]['h'][1] + $result[$shortMonthName]['h'][2] + $result[$shortMonthName]['h'][3];;

                $result[$shortMonthName]['kh'][1] =  Harvest::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from1, $to1])->count();
                $result[$shortMonthName]['kh'][2] =  Harvest::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from2, $to2])->count();
                $result[$shortMonthName]['kh'][3] =  Harvest::whereNotNull('kerosakan_id')->whereBetween('created_at', [$from3, $to3])->count();
                $result[$shortMonthName]['kh'][4] =  $result[$shortMonthName]['kh'][1] + $result[$shortMonthName]['kh'][2] + $result[$shortMonthName]['kh'][3];


                $result[$shortMonthName]['monthEndDay'] =  $day;
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $result['bagging'] =  Bagging::whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
                $result['kcp'] =  ControlPollination::whereNotNull('kerosakan_id')->whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
                $result['cp'] =  ControlPollination::whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
                $result['qc'] =  QualityControl::whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
                $result['kqc'] =  QualityControl::whereNotNull('kerosakan_id')->whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
                $result['h'] =  Harvest::whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
                $result['kh'] =  Harvest::whereNotNull('kerosakan_id')->whereBetween('created_at', [$tarikh_mula, $tarikh_akhir])->count();
            }
        }
        return $result;
    }

    public function BalutLaporan4($bulan, $tahun)
    {
        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result = ControlPollination::join('users', 'users.id', 'control_pollinations.id_sv_cp')
            ->join('pokoks', 'pokoks.id', 'control_pollinations.pokok_id')
            ->select('users.nama', 'pokoks.blok', 'pokoks.baka', 'control_pollinations.id_sv_cp')
            ->whereMonth('control_pollinations.created_at', '=', $bulan)
            ->whereNotNull('control_pollinations.kerosakan_id')
            ->orderBy('control_pollinations.id_sv_cp')
            ->distinct()
            ->get();

        foreach ($result as $key => $value) {
            $jumlah = 0;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = date($tahun . '-' . $bulan . '-' . $i);
                $a[$key][$i] = ControlPollination::join('users', 'users.id', 'control_pollinations.id_sv_cp')
                    ->join('pokoks', 'pokoks.id', 'control_pollinations.pokok_id')
                    ->where('pokoks.blok', $value['blok'])
                    ->where('pokoks.baka', $value['baka'])
                    ->where('control_pollinations.id_sv_cp', $value['id_sv_cp'])
                    ->whereDate('control_pollinations.created_at', '=', $date)
                    ->whereNotNull('control_pollinations.kerosakan_id')
                    ->count();

                $jumlah += $a[$key][$i];
            }

            $value['data']  = $a[$key];
            $value['jumlah']  = $jumlah;
        }
        $result['daysInMonth']  = $daysInMonth;

        return $result;
    }

    public function CpLaporan1($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        $daysInMonth = Carbon::createFromDate($tahun, 2)->daysInMonth;

        $results['daysInMonth'] = $daysInMonth;
        $listPenyeliaCP = ControlPollination::join('pokoks', 'pokoks.id', 'control_pollinations.pokok_id')
            ->join('users', 'users.id', 'control_pollinations.id_sv_cp')
            ->select(['users.nama', 'control_pollinations.id_sv_cp', 'pokoks.blok', 'pokoks.baka'])
            ->whereNotNull('control_pollinations.id_sv_cp')
            ->distinct()
            ->orderBy('control_pollinations.id_sv_cp')
            ->get();

        $countCp = array();
        foreach ($listPenyeliaCP as $penyelia) {
            $jumlah = 0;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = date($tahun . '-' . $bulan . '-' . $i);
                $countCp[$i] = ControlPollination::join('users', 'users.id', 'control_pollinations.id_sv_cp')
                    ->join('pokoks', 'pokoks.id', 'control_pollinations.pokok_id')
                    ->where('pokoks.blok', $penyelia['blok'])
                    ->where('pokoks.baka', $penyelia['baka'])
                    ->where('control_pollinations.id_sv_cp', $penyelia['id_sv_cp'])
                    ->whereDate('control_pollinations.created_at', '=', $date)
                    ->whereNull('control_pollinations.kerosakan_id')
                    ->count();

                $jumlah += $countCp[$i];
            }
            $penyelia['data'] = $countCp;
            $penyelia['jumlah'] = $jumlah;
        }

        $results['listPenyeliaCP'] = $listPenyeliaCP;
        return $results;
    }


    public function fatherpalm()
    {
        return view('laporan.fatherpalm.index');
    }

    public function fatherpalmStore(Request $request)
    {
        alert('Gagal', 'Belum Sedia', 'error');
        return back();
    }
}
