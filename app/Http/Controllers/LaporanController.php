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
use Illuminate\Support\Facades\DB;


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
        if ($request->hb == "h")
        {
            $tarikh_mula = date($request->tarikh_mula);
            $tarikh_akhir = date($request->tarikh_akhir);
        }

        $type = $request->kategori;

        if ($type == "master")
        {
            $result = $this->MotherMaster($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
            return view('laporan.motherpalm.master_harian', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'hb' => $request->hb,
                    ]);
        }

        if ($type == "balut")
        {
            switch ($request->laporan)
            {
                case '1':
                switch ($request->hb)
                {
                    case 'h':
                    $result = $this->BalutLaporan1($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.balut1_harian', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'tarikh_mula' => $tarikh_mula,
                        'tarikh_akhir' => $tarikh_akhir,
                        'hb' => $request->hb,
                    ]);
                    break;

                    case 'b':
                    $result = $this->BalutLaporan1($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.balut1_bulanan', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'hb' => $request->hb,
                    ]);
                    break;

                    default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
                }

                case '2':
                switch ($request->hb)
                {
                    case 'h':
                    $result = $this->BalutLaporan2($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.balut2_harian', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'tarikh_mula' => $tarikh_mula,
                        'tarikh_akhir' => $tarikh_akhir,
                        'hb' => $request->hb,
                    ]);
                    break;

                    case 'b':
                    $result = $this->BalutLaporan2($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.balut2_bulanan', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'hb' => $request->hb,
                    ]);
                    break;

                    default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
                }

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
                switch ($request->hb)
                {
                    case 'h':
                    $result = $this->BalutLaporan4($request->bulan, $request->tahun);
                    return view('laporan.motherpalm.balut4_harian', compact('result'));
                    break;

                    case 'b':
                    $result = $this->BalutLaporan4($request->bulan, $request->tahun);
                    return view('laporan.motherpalm.balut4_bulanan', compact('result'));
                    break;

                    default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
                }
            }
        }

        if ($type == 'debung')
        {
             switch ($request->hb)
             {
                    case 'h':
                        $results = $this->CpLaporan1($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir);
                        return view('laporan.motherpalm.cp1_harian', compact('results'));
                    break;

                    case 'b':
                        $results = $this->CpLaporan1($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir);
                        return view('laporan.motherpalm.cp1_bulanan', compact('results'));
                    break;

                    default:
                        alert()->error('Gagal', 'Belum Mula');
                        return back();
                        break;
             }
        }

        if ($type == "kawal")
        {
            switch ($request->laporan) {
                case '1':
                    $result = $this->KawalLaporan1($request->hb, $request->bulan, $request->tahun);
                return view('laporan.motherpalm.kawalan_1_bulanan', [
                    'result' => $result,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'hb' => $request->hb,
                ]);
                break;

                case '2':
                $result = $this->KawalLaporan2($request->bulan, $request->tahun);
                return view('laporan.motherpalm.kawalan_2_bulanan', [
                    'result' => $result,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'hb' => $request->hb,
                ]);
                break;

                case '3':
                $result = $this->KawalLaporan3($request->bulan, $request->tahun);
                return view('laporan.motherpalm.kawalan_3_bulanan', [
                    'result' => $result,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'hb' => $request->hb,
                ]);
                break;

                case '4':
                $result = $this->KawalLaporan4($request->hb, $request->bulan, $request->tahun);
                return view('laporan.motherpalm.kawalan_4_bulanan', [
                    'result' => $result,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'hb' => $request->hb,
                ]);
                break;

                case '10':
                $result = $this->KawalLaporan10($request->bulan, $request->tahun);
                return view('laporan.motherpalm.kawalan_10_harian', compact('result'));
                break;

                case '11':
                $result = $this->KawalLaporan11($request->bulan, $request->tahun);
                return view('laporan.motherpalm.kawalan_11_harian', compact('result'));
                break;

                default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
            }
        }

        if ($type == "tuai")
        {
            switch ($request->laporan)
            {
                case '2':
                switch ($request->hb)
                {
                    case 'h':
                    $result = $this->PenuaianLaporan2($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.penuaian_2_harian', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'tarikh_mula' => $tarikh_mula,
                        'tarikh_akhir' => $tarikh_akhir,
                        'hb' => $request->hb,
                    ]);
                    break;

                    case 'b':
                    $result = $this->PenuaianLaporan2($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.penuaian_2_bulanan', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'hb' => $request->hb,
                    ]);
                    break;

                    default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
                }

                case '8':
                switch ($request->hb)
                {
                    case 'b':
                    $result = $this->PenuaianLaporan8($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                    return view('laporan.motherpalm.penuaian_8_bulanan', [
                        'result' => $result,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'hb' => $request->hb,
                    ]);
                    break;

                    default:
                    alert()->error('Gagal', 'Belum Mula');
                    return back();
                    break;
                }

                case '9':
                switch ($request->hb)
                {
                    case 'h':
                        $results = $this->PenuaianLaporan9($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir);
                        return view('laporan.motherpalm.penuaian_9_harian', compact('results'));
                    break;

                    case 'b':
                        $results = $this->PenuaianLaporan9($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir);
                        return view('laporan.motherpalm.penuaian_9_bulanan', compact('results'));
                    break;

                    default:
                        alert()->error('Gagal', 'Belum Mula');
                        return back();
                        break;
                }
            }
        }

        alert()->error('Fail', "In Development");
        return back();
    }

    public function MotherMaster($tarikh_mula, $tarikh_akhir)
    {
        $result = [];
        return $result;
    }

    public function BalutLaporan1($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function BalutLaporan2($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

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

    public function KawalLaporan1($hb, $bulan, $tahun)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
            else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }

        $result = [];

        $resultsCountPatahAllMonth = DB::table('kerosakans')->
        where('nama', 'Patah')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountTikusAllMonth = DB::table('kerosakans')->
        where('nama', 'Tikus')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBegPecahAllMonth = DB::table('kerosakans')->
        where('nama', 'Beg Pecah')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountKembangTidakSekataAllMonth = DB::table('kerosakans')->
        where('nama', 'Kembang Tidak Sekata')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountAnaiAllMonth = DB::table('kerosakans')->
        where('nama', 'Anai - anai')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBungaMatiAllMonth = DB::table('kerosakans')->
        where('nama', 'Bunga Mati')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountMatiBanjirAllMonth = DB::table('kerosakans')->
        where('nama', 'Mati Banjir')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBungaMatiAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Bunga Mati')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountMasukMasaCPAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Masuk Masa CP')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountIBawahTKemasAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'I.Bawah T.Kemas')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBungaTakCPAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Bunga Tak CP')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountSeranganHaiwanAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Serangan Haiwan')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountSambangAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Sambang')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountIAtasTKemasAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'I.Atas T.Kemas')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountJumlahPeriksaAllMonth = DB::table('quality_controls')->
        whereNotNull('jum_bagging')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountJumlahRosakAllMonth = DB::table('quality_controls')->
        whereNotNull('jum_bagging_rosak')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountJumlahLulusAllMonth = DB::table('quality_controls')->
        whereNotNull('jum_bagging_lulus')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountPeratusRosakAllMonth = DB::table('quality_controls')->
        whereNotNull('peratus_rosak')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountFaktorAllAllMonth = DB::table('kerosakans')->
        count();

        $resultsCountFaktorManusiaAllMonth = DB::table('kerosakans')->
        where('faktor', 'Manusia')->
        count();
        

        $resultsCountFaktorAlamAllMonth = DB::table('kerosakans')->
        where('faktor', 'Alam')->
        count();

        $resultsPeratusFaktorManusiaAllMonth = $resultsCountFaktorManusiaAllMonth/$resultsCountFaktorAllAllMonth * 100;
        $resultsPeratusFaktorAlamAllMonth = $resultsCountFaktorAlamAllMonth/$resultsCountFaktorAllAllMonth * 100;

        if ($bulan == "all")
        {
            $bulan_list = ['01','02','03','04','05','06','07','08','09','10','11','12'];

            foreach ($bulan_list as $bulanan)
            {
                $tahun_bulan = $tahun."-".$bulanan;

                $resultsCountPatah = DB::table('kerosakans')->
                where('nama', 'Patah')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountTikus = DB::table('kerosakans')->
                where('nama', 'Tikus')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBegPecah = DB::table('kerosakans')->
                where('nama', 'Beg Pecah')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountKembangTidakSekata = DB::table('kerosakans')->
                where('nama', 'Kembang Tidak Sekata')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountAnai = DB::table('kerosakans')->
                where('nama', 'Anai - anai')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBungaMati = DB::table('kerosakans')->
                where('nama', 'Bunga Mati')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountMatiBanjir = DB::table('kerosakans')->
                where('nama', 'Tenggelam Banjir')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBungaMatiAlam = DB::table('kerosakans')->
                where('nama', 'Bunga Mati')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountMasukMasaCPAlam = DB::table('kerosakans')->
                where('nama', 'Masuk Masa CP')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountIBawahTKemasAlam = DB::table('kerosakans')->
                where('nama', 'I.Bawah T.Kemas')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBungaTakCPAlam = DB::table('kerosakans')->
                where('nama', 'Bunga Tak CP')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountSeranganHaiwanAlam = DB::table('kerosakans')->
                where('nama', 'Serangan Haiwan')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountSambangAlam = DB::table('kerosakans')->
                where('nama', 'Sambang')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountIAtasTKemasAlam = DB::table('kerosakans')->
                where('nama', 'I.Atas T.Kemas')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountJumlahPeriksa = DB::table('quality_controls')->
                whereNotNull('jum_bagging')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountJumlahRosak = DB::table('quality_controls')->
                whereNotNull('jum_bagging_rosak')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountJumlahLulus = DB::table('quality_controls')->
                whereNotNull('jum_bagging_lulus')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountPeratusRosak = DB::table('quality_controls')->
                whereNotNull('peratus_rosak')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountFaktorAll = DB::table('kerosakans')->
                where('created_at', 'LIKE', $tahun.'%')->
                count();

                $resultsCountFaktorManusia = DB::table('kerosakans')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();
        

                $resultsCountFaktorAlam = DB::table('kerosakans')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsPeratusFaktorManusia = $resultsCountFaktorManusia/$resultsCountFaktorAll * 100;
                $resultsPeratusFaktorAlam = $resultsCountFaktorAlam/$resultsCountFaktorAll * 100;

              if ($bulanan == "01")
              {
                    $result[1] = $resultsCountPatah;
                    $result[2] = $resultsCountTikus;
                    $result[3] = $resultsCountBegPecah;
                    $result[4] = $resultsCountKembangTidakSekata;
		            $result[5] = $resultsCountAnai;
		            $result[6] = $resultsCountBungaMati;
		            $result[7] = $resultsCountMatiBanjir;
		            $result[8] = $resultsCountBungaMatiAlam;
		            $result[9] = $resultsCountMasukMasaCPAlam;
		            $result[10] = $resultsCountIBawahTKemasAlam;
		            $result[11] = $resultsCountBungaTakCPAlam;
		            $result[12] = $resultsCountSeranganHaiwanAlam;
		            $result[13] = $resultsCountSambangAlam;
		            $result[14] = $resultsCountIAtasTKemasAlam;
                    $result[15] = $resultsCountJumlahPeriksa;
                    $result[16] = $resultsCountJumlahRosak;
                    $result[17] = $resultsCountJumlahLulus;
                    $result[18] = $resultsCountPeratusRosak;
                    $result[19] = $resultsCountFaktorManusia;
                    $result[20] = number_format($resultsPeratusFaktorManusia,2);
                    $result[21] = $resultsCountFaktorAlam;
                    $result[22] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "02")
              {
                    $result[23] = $resultsCountPatah;
                    $result[24] = $resultsCountTikus;
                    $result[25] = $resultsCountBegPecah;
                    $result[26] = $resultsCountKembangTidakSekata;
		            $result[27] = $resultsCountAnai;
		            $result[28] = $resultsCountBungaMati;
		            $result[29] = $resultsCountMatiBanjir;
		            $result[30] = $resultsCountBungaMatiAlam;
		            $result[31] = $resultsCountMasukMasaCPAlam;
		            $result[32] = $resultsCountIBawahTKemasAlam;
		            $result[33] = $resultsCountBungaTakCPAlam;
		            $result[34] = $resultsCountSeranganHaiwanAlam;
		            $result[35] = $resultsCountSambangAlam;
		            $result[36] = $resultsCountIAtasTKemasAlam;
                    $result[37] = $resultsCountJumlahPeriksa;
                    $result[38] = $resultsCountJumlahRosak;
                    $result[39] = $resultsCountJumlahLulus;
                    $result[40] = $resultsCountPeratusRosak;
                    $result[41] = $resultsCountFaktorManusia;
                    $result[42] = number_format($resultsPeratusFaktorManusia,2);
                    $result[43] = $resultsCountFaktorAlam;
                    $result[44] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "03")
              {
                    $result[45] = $resultsCountPatah;
                    $result[46] = $resultsCountTikus;
                    $result[47] = $resultsCountBegPecah;
                    $result[48] = $resultsCountKembangTidakSekata;
		            $result[49] = $resultsCountAnai;
		            $result[50] = $resultsCountBungaMati;
		            $result[51] = $resultsCountMatiBanjir;
		            $result[52] = $resultsCountBungaMatiAlam;
		            $result[53] = $resultsCountMasukMasaCPAlam;
		            $result[54] = $resultsCountIBawahTKemasAlam;
		            $result[55] = $resultsCountBungaTakCPAlam;
		            $result[56] = $resultsCountSeranganHaiwanAlam;
		            $result[57] = $resultsCountSambangAlam;
		            $result[58] = $resultsCountIAtasTKemasAlam;
                    $result[59] = $resultsCountJumlahPeriksa;
                    $result[60] = $resultsCountJumlahRosak;
                    $result[61] = $resultsCountJumlahLulus;
                    $result[62] = $resultsCountPeratusRosak;
                    $result[63] = $resultsCountFaktorManusia;
                    $result[64] = number_format($resultsPeratusFaktorManusia,2);
                    $result[65] = $resultsCountFaktorAlam;
                    $result[66] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "04")
              {
                    $result[67] = $resultsCountPatah;
                    $result[68] = $resultsCountTikus;
                    $result[69] = $resultsCountBegPecah;
                    $result[70] = $resultsCountKembangTidakSekata;
		            $result[71] = $resultsCountAnai;
		            $result[72] = $resultsCountBungaMati;
		            $result[73] = $resultsCountMatiBanjir;
		            $result[74] = $resultsCountBungaMatiAlam;
		            $result[75] = $resultsCountMasukMasaCPAlam;
		            $result[76] = $resultsCountIBawahTKemasAlam;
		            $result[77] = $resultsCountBungaTakCPAlam;
		            $result[78] = $resultsCountSeranganHaiwanAlam;
		            $result[79] = $resultsCountSambangAlam;
		            $result[80] = $resultsCountIAtasTKemasAlam;
                    $result[81] = $resultsCountJumlahPeriksa;
                    $result[82] = $resultsCountJumlahRosak;
                    $result[83] = $resultsCountJumlahLulus;
                    $result[84] = $resultsCountPeratusRosak;
                    $result[85] = $resultsCountFaktorManusia;
                    $result[86] = number_format($resultsPeratusFaktorManusia,2);
                    $result[87] = $resultsCountFaktorAlam;
                    $result[88] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "05")
              {
                    $result[89] = $resultsCountPatah;
                    $result[90] = $resultsCountTikus;
                    $result[91] = $resultsCountBegPecah;
                    $result[92] = $resultsCountKembangTidakSekata;
		            $result[93] = $resultsCountAnai;
		            $result[94] = $resultsCountBungaMati;
		            $result[95] = $resultsCountMatiBanjir;
		            $result[96] = $resultsCountBungaMatiAlam;
		            $result[97] = $resultsCountMasukMasaCPAlam;
		            $result[98] = $resultsCountIBawahTKemasAlam;
		            $result[99] = $resultsCountBungaTakCPAlam;
		            $result[100] = $resultsCountSeranganHaiwanAlam;
		            $result[101] = $resultsCountSambangAlam;
		            $result[102] = $resultsCountIAtasTKemasAlam;
                    $result[103] = $resultsCountJumlahPeriksa;
                    $result[104] = $resultsCountJumlahRosak;
                    $result[105] = $resultsCountJumlahLulus;
                    $result[106] = $resultsCountPeratusRosak;
                    $result[107] = $resultsCountFaktorManusia;
                    $result[108] = number_format($resultsPeratusFaktorManusia,2);
                    $result[109] = $resultsCountFaktorAlam;
                    $result[110] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "06")
              {
                    $result[111] = $resultsCountPatah;
                    $result[112] = $resultsCountTikus;
                    $result[113] = $resultsCountBegPecah;
                    $result[114] = $resultsCountKembangTidakSekata;
		            $result[115] = $resultsCountAnai;
		            $result[116] = $resultsCountBungaMati;
		            $result[117] = $resultsCountMatiBanjir;
		            $result[118] = $resultsCountBungaMatiAlam;
		            $result[119] = $resultsCountMasukMasaCPAlam;
		            $result[120] = $resultsCountIBawahTKemasAlam;
		            $result[121] = $resultsCountBungaTakCPAlam;
		            $result[122] = $resultsCountSeranganHaiwanAlam;
		            $result[123] = $resultsCountSambangAlam;
		            $result[124] = $resultsCountIAtasTKemasAlam;
                    $result[125] = $resultsCountJumlahPeriksa;
                    $result[126] = $resultsCountJumlahRosak;
                    $result[127] = $resultsCountJumlahLulus;
                    $result[128] = $resultsCountPeratusRosak;
                    $result[129] = $resultsCountFaktorManusia;
                    $result[130] = number_format($resultsPeratusFaktorManusia,2);
                    $result[131] = $resultsCountFaktorAlam;
                    $result[132] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "07")
              {
                    $result[133] = $resultsCountPatah;
                    $result[134] = $resultsCountTikus;
                    $result[135] = $resultsCountBegPecah;
                    $result[136] = $resultsCountKembangTidakSekata;
		            $result[137] = $resultsCountAnai;
		            $result[138] = $resultsCountBungaMati;
		            $result[139] = $resultsCountMatiBanjir;
		            $result[140] = $resultsCountBungaMatiAlam;
		            $result[141] = $resultsCountMasukMasaCPAlam;
		            $result[142] = $resultsCountIBawahTKemasAlam;
		            $result[143] = $resultsCountBungaTakCPAlam;
		            $result[144] = $resultsCountSeranganHaiwanAlam;
		            $result[145] = $resultsCountSambangAlam;
		            $result[146] = $resultsCountIAtasTKemasAlam;
                    $result[147] = $resultsCountJumlahPeriksa;
                    $result[148] = $resultsCountJumlahRosak;
                    $result[149] = $resultsCountJumlahLulus;
                    $result[150] = $resultsCountPeratusRosak;
                    $result[151] = $resultsCountFaktorManusia;
                    $result[152] = number_format($resultsPeratusFaktorManusia,2);
                    $result[153] = $resultsCountFaktorAlam;
                    $result[154] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "08")
              {
                    $result[155] = $resultsCountPatah;
                    $result[156] = $resultsCountTikus;
                    $result[157] = $resultsCountBegPecah;
                    $result[158] = $resultsCountKembangTidakSekata;
		            $result[159] = $resultsCountAnai;
		            $result[160] = $resultsCountBungaMati;
		            $result[161] = $resultsCountMatiBanjir;
		            $result[162] = $resultsCountBungaMatiAlam;
		            $result[163] = $resultsCountMasukMasaCPAlam;
		            $result[164] = $resultsCountIBawahTKemasAlam;
		            $result[165] = $resultsCountBungaTakCPAlam;
		            $result[166] = $resultsCountSeranganHaiwanAlam;
		            $result[167] = $resultsCountSambangAlam;
		            $result[168] = $resultsCountIAtasTKemasAlam;
                    $result[169] = $resultsCountJumlahPeriksa;
                    $result[170] = $resultsCountJumlahRosak;
                    $result[171] = $resultsCountJumlahLulus;
                    $result[172] = $resultsCountPeratusRosak;
                    $result[173] = $resultsCountFaktorManusia;
                    $result[174] = number_format($resultsPeratusFaktorManusia,2);
                    $result[175] = $resultsCountFaktorAlam;
                    $result[176] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "09")
              {
                    $result[177] = $resultsCountPatah;
                    $result[178] = $resultsCountTikus;
                    $result[179] = $resultsCountBegPecah;
                    $result[180] = $resultsCountKembangTidakSekata;
		            $result[181] = $resultsCountAnai;
		            $result[182] = $resultsCountBungaMati;
		            $result[183] = $resultsCountMatiBanjir;
		            $result[184] = $resultsCountBungaMatiAlam;
		            $result[185] = $resultsCountMasukMasaCPAlam;
		            $result[186] = $resultsCountIBawahTKemasAlam;
		            $result[187] = $resultsCountBungaTakCPAlam;
		            $result[188] = $resultsCountSeranganHaiwanAlam;
		            $result[189] = $resultsCountSambangAlam;
		            $result[190] = $resultsCountIAtasTKemasAlam;
                    $result[191] = $resultsCountJumlahPeriksa;
                    $result[192] = $resultsCountJumlahRosak;
                    $result[193] = $resultsCountJumlahLulus;
                    $result[194] = $resultsCountPeratusRosak;
                    $result[195] = $resultsCountFaktorManusia;
                    $result[196] = number_format($resultsPeratusFaktorManusia,2);
                    $result[197] = $resultsCountFaktorAlam;
                    $result[198] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "10")
              {
                    $result[199] = $resultsCountPatah;
                    $result[200] = $resultsCountTikus;
                    $result[201] = $resultsCountBegPecah;
                    $result[202] = $resultsCountKembangTidakSekata;
		            $result[203] = $resultsCountAnai;
		            $result[204] = $resultsCountBungaMati;
		            $result[205] = $resultsCountMatiBanjir;
		            $result[206] = $resultsCountBungaMatiAlam;
		            $result[207] = $resultsCountMasukMasaCPAlam;
		            $result[208] = $resultsCountIBawahTKemasAlam;
		            $result[209] = $resultsCountBungaTakCPAlam;
		            $result[210] = $resultsCountSeranganHaiwanAlam;
		            $result[211] = $resultsCountSambangAlam;
		            $result[212] = $resultsCountIAtasTKemasAlam;
                    $result[213] = $resultsCountJumlahPeriksa;
                    $result[214] = $resultsCountJumlahRosak;
                    $result[215] = $resultsCountJumlahLulus;
                    $result[216] = $resultsCountPeratusRosak;
                    $result[217] = $resultsCountFaktorManusia;
                    $result[218] = number_format($resultsPeratusFaktorManusia,2);
                    $result[219] = $resultsCountFaktorAlam;
                    $result[220] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "11")
              {
                    $result[221] = $resultsCountPatah;
                    $result[222] = $resultsCountTikus;
                    $result[223] = $resultsCountBegPecah;
                    $result[224] = $resultsCountKembangTidakSekata;
		            $result[225] = $resultsCountAnai;
		            $result[226] = $resultsCountBungaMati;
		            $result[227] = $resultsCountMatiBanjir;
		            $result[228] = $resultsCountBungaMatiAlam;
		            $result[229] = $resultsCountMasukMasaCPAlam;
		            $result[230] = $resultsCountIBawahTKemasAlam;
		            $result[231] = $resultsCountBungaTakCPAlam;
		            $result[232] = $resultsCountSeranganHaiwanAlam;
		            $result[233] = $resultsCountSambangAlam;
		            $result[234] = $resultsCountIAtasTKemasAlam;
                    $result[235] = $resultsCountJumlahPeriksa;
                    $result[236] = $resultsCountJumlahRosak;
                    $result[237] = $resultsCountJumlahLulus;
                    $result[238] = $resultsCountPeratusRosak;
                    $result[239] = $resultsCountFaktorManusia;
                    $result[240] = number_format($resultsPeratusFaktorManusia,2);
                    $result[241] = $resultsCountFaktorAlam;
                    $result[242] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "12")
              {
                    $result[243] = $resultsCountPatah;
                    $result[244] = $resultsCountTikus;
                    $result[245] = $resultsCountBegPecah;
                    $result[246] = $resultsCountKembangTidakSekata;
		            $result[247] = $resultsCountAnai;
		            $result[248] = $resultsCountBungaMati;
		            $result[249] = $resultsCountMatiBanjir;
		            $result[250] = $resultsCountBungaMatiAlam;
		            $result[251] = $resultsCountMasukMasaCPAlam;
		            $result[252] = $resultsCountIBawahTKemasAlam;
		            $result[253] = $resultsCountBungaTakCPAlam;
		            $result[254] = $resultsCountSeranganHaiwanAlam;
		            $result[255] = $resultsCountSambangAlam;
		            $result[256] = $resultsCountIAtasTKemasAlam;
                    $result[257] = $resultsCountJumlahPeriksa;
                    $result[258] = $resultsCountJumlahRosak;
                    $result[259] = $resultsCountJumlahLulus;
                    $result[260] = $resultsCountPeratusRosak;
                    $result[261] = $resultsCountFaktorManusia;
                    $result[262] = number_format($resultsPeratusFaktorManusia,2);
                    $result[263] = $resultsCountFaktorAlam;
                    $result[264] = number_format($resultsPeratusFaktorAlam,2);
              }
            }
        }
        else
        {
            $tahun_bulan = $tahun."-".$bulan;

            $resultsCountPatah = DB::table('kerosakans')->
            where('nama', 'Patah')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountTikus = DB::table('kerosakans')->
            where('nama', 'Tikus')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBegPecah = DB::table('kerosakans')->
            where('nama', 'Beg Pecah')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountKembangTidakSekata = DB::table('kerosakans')->
            where('nama', 'Kembang Tidak Sekata')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountAnai = DB::table('kerosakans')->
            where('nama', 'Anai - anai')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBungaMati = DB::table('kerosakans')->
            where('nama', 'Bunga Mati')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountMatiBanjir = DB::table('kerosakans')->
            where('nama', 'Tenggelam Banjir')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBungaMatiAlam = DB::table('kerosakans')->
            where('nama', 'Bunga Mati')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountMasukMasaCPAlam = DB::table('kerosakans')->
            where('nama', 'Masuk Masa CP')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountIBawahTKemasAlam = DB::table('kerosakans')->
            where('nama', 'I.Bawah T.Kemas')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBungaTakCPAlam = DB::table('kerosakans')->
            where('nama', 'Bunga Tak CP')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountSeranganHaiwanAlam = DB::table('kerosakans')->
            where('nama', 'Serangan Haiwan')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountSambangAlam = DB::table('kerosakans')->
            where('nama', 'Sambang')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountIAtasTKemasAlam = DB::table('kerosakans')->
            where('nama', 'I.Atas T.Kemas')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountJumlahPeriksa = DB::table('quality_controls')->
            whereNotNull('jum_bagging')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountJumlahRosak = DB::table('quality_controls')->
            whereNotNull('jum_bagging_rosak')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountJumlahLulus = DB::table('quality_controls')->
            whereNotNull('jum_bagging_lulus')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountPeratusRosak = DB::table('quality_controls')->
            whereNotNull('peratus_rosak')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountFaktorAll = DB::table('kerosakans')->
             where('created_at', 'LIKE', $tahun.'%')->
            count();

            $resultsCountFaktorManusia = DB::table('kerosakans')->
            where('faktor', 'Manusia')->
             where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();
        

            $resultsCountFaktorAlam = DB::table('kerosakans')->
            where('faktor', 'Alam')->
             where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsPeratusFaktorManusia = $resultsCountFaktorManusia/$resultsCountFaktorAll * 100;
            $resultsPeratusFaktorAlam = $resultsCountFaktorAlam/$resultsCountFaktorAll * 100;

            $result[1] = $resultsCountPatah;
            $result[2] = $resultsCountTikus;
            $result[3] = $resultsCountBegPecah;
            $result[4] = $resultsCountKembangTidakSekata;
		    $result[5] = $resultsCountAnai;
		    $result[6] = $resultsCountBungaMati;
		    $result[7] = $resultsCountMatiBanjir;
		    $result[8] = $resultsCountBungaMatiAlam;
		    $result[9] = $resultsCountMasukMasaCPAlam;
		    $result[10] = $resultsCountIBawahTKemasAlam;
		    $result[11] = $resultsCountBungaTakCPAlam;
		    $result[12] = $resultsCountSeranganHaiwanAlam;
		    $result[13] = $resultsCountSambangAlam;
		    $result[14] = $resultsCountIAtasTKemasAlam;
            $result[15] = $resultsCountJumlahPeriksa;
            $result[16] = $resultsCountJumlahRosak;
            $result[17] = $resultsCountJumlahLulus;
            $result[18] = $resultsCountPeratusRosak;
            $result[19] = $resultsCountFaktorManusia;
            $result[20] = number_format($resultsPeratusFaktorManusia,2);
            $result[21] = $resultsCountFaktorAlam;
            $result[22] = number_format($resultsPeratusFaktorAlam,2);
        }

        if ($bulan == "all")
        {
            $result[265] = $resultsCountPatahAllMonth;
            $result[266] = $resultsCountTikusAllMonth;
            $result[267] = $resultsCountBegPecahAllMonth;
            $result[268] = $resultsCountKembangTidakSekataAllMonth;
            $result[269] = $resultsCountAnaiAllMonth;
            $result[270] = $resultsCountBungaMatiAllMonth;
            $result[271] = $resultsCountMatiBanjirAllMonth;
            $result[272] = $resultsCountBungaMatiAlamAllMonth;
            $result[273] = $resultsCountMasukMasaCPAlamAllMonth;
            $result[274] = $resultsCountIBawahTKemasAlamAllMonth;
            $result[275] = $resultsCountBungaTakCPAlamAllMonth;
            $result[276] = $resultsCountSeranganHaiwanAlamAllMonth;
            $result[277] = $resultsCountSambangAlamAllMonth;
            $result[278] = $resultsCountIAtasTKemasAlamAllMonth;
            $result[279] = $resultsCountJumlahPeriksaAllMonth;
            $result[280] = $resultsCountJumlahRosakAllMonth;
            $result[281] = $resultsCountJumlahLulusAllMonth;
            $result[282] = $resultsCountPeratusRosakAllMonth;
            $result[283] = $resultsCountFaktorAlamAllMonth;
            $result[284] = number_format($resultsPeratusFaktorManusiaAllMonth,2);
            $result[285] = $resultsCountFaktorManusiaAllMonth;
            $result[286] = number_format($resultsPeratusFaktorAlamAllMonth,2);

            $result[287] = 0.00;
            $result[288] = 0.00;
            $result[289] = 0.00;
            $result[290] = 0.00;
            $result[291] = 0.00;
            $result[292] = 0.00;
            $result[293] = 0.00;
            $result[294] = 0.00;
            $result[295] = 0.00;
            $result[296] = 0.00;
            $result[297] = 0.00;
            $result[298] = 0.00;
            $result[299] = 0.00;
            $result[300] = 0.00;
        }
        else
        {
            $result[265] = $result[1];
            $result[266] = $result[2];
            $result[267] = $result[3];
            $result[268] = $result[4];
            $result[269] = $result[5];
            $result[270] = $result[6];
            $result[271] = $result[7];
            $result[272] = $result[8];
            $result[273] = $result[9];
            $result[274] = $result[10];
            $result[275] = $result[11];
            $result[276] = $result[12];
            $result[277] = $result[13];
            $result[278] = $result[14];
            $result[279] = $result[15];
            $result[280] = $result[16];
            $result[281] = $result[17];
            $result[282] = $result[18];
            $result[283] = $result[19];
            $result[284] = $result[20];
            $result[285] = $result[21];
            $result[286] = $result[22];

            $result[287] = 0.00;
            $result[288] = 0.00;
            $result[289] = 0.00;
            $result[290] = 0.00;
            $result[291] = 0.00;
            $result[292] = 0.00;
            $result[293] = 0.00;
            $result[294] = 0.00;
            $result[295] = 0.00;
            $result[296] = 0.00;
            $result[297] = 0.00;
            $result[298] = 0.00;
            $result[299] = 0.00;
            $result[300] = 0.00;
        }
            
        return $result;
    }

    public function KawalLaporan2($bulan, $tahun)
    {
        if ($bulan == "all")
        {
            $bulan = "01";
        }

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

    public function KawalLaporan3($bulan, $tahun)
    {
        if ($bulan == "all")
        {
            $bulan = "01";
        }

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

    public function KawalLaporan4($hb, $bulan, $tahun)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
            else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }

        $result = [];

        $resultsCountPatahAllMonth = DB::table('kerosakans')->
        where('nama', 'Patah')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountTikusAllMonth = DB::table('kerosakans')->
        where('nama', 'Tikus')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBegPecahAllMonth = DB::table('kerosakans')->
        where('nama', 'Beg Pecah')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountKembangTidakSekataAllMonth = DB::table('kerosakans')->
        where('nama', 'Kembang Tidak Sekata')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountAnaiAllMonth = DB::table('kerosakans')->
        where('nama', 'Anai - anai')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBungaMatiAllMonth = DB::table('kerosakans')->
        where('nama', 'Bunga Mati')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountTenggelamBanjirAllMonth = DB::table('kerosakans')->
        where('nama', 'Tenggelam Banjir')->
        where('faktor', 'Manusia')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBungaMatiAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Bunga Mati')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountMasukMasaCPAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Masuk Masa CP')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountIBawahTKemasAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'I.Bawah T.Kemas')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountBungaTakCPAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Bunga Tak CP')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountSeranganHaiwanAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Serangan Haiwan')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountSambangAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'Sambang')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountIAtasTKemasAlamAllMonth = DB::table('kerosakans')->
        where('nama', 'I.Atas T.Kemas')->
        where('faktor', 'Alam')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountJumlahPeriksaAllMonth = DB::table('quality_controls')->
        whereNotNull('jum_bagging')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountJumlahRosakAllMonth = DB::table('quality_controls')->
        whereNotNull('jum_bagging_rosak')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountJumlahLulusAllMonth = DB::table('quality_controls')->
        whereNotNull('jum_bagging_lulus')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountPeratusRosakAllMonth = DB::table('quality_controls')->
        whereNotNull('peratus_rosak')->
        where('created_at', 'LIKE', $tahun.'%')->
        count();

        $resultsCountFaktorAllAllMonth = DB::table('kerosakans')->
        count();

        $resultsCountFaktorManusiaAllMonth = DB::table('kerosakans')->
        where('faktor', 'Manusia')->
        count();
        

        $resultsCountFaktorAlamAllMonth = DB::table('kerosakans')->
        where('faktor', 'Alam')->
        count();

        $resultsPeratusFaktorManusiaAllMonth = $resultsCountFaktorManusiaAllMonth/$resultsCountFaktorAllAllMonth * 100;
        $resultsPeratusFaktorAlamAllMonth = $resultsCountFaktorAlamAllMonth/$resultsCountFaktorAllAllMonth * 100;

        if ($bulan == "all")
        {
            $bulan_list = ['01','02','03','04','05','06','07','08','09','10','11','12'];

            foreach ($bulan_list as $bulanan)
            {
                $tahun_bulan = $tahun."-".$bulanan;

                $resultsCountPatah = DB::table('kerosakans')->
                where('nama', 'Patah')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountTikus = DB::table('kerosakans')->
                where('nama', 'Tikus')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBegPecah = DB::table('kerosakans')->
                where('nama', 'Beg Pecah')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountKembangTidakSekata = DB::table('kerosakans')->
                where('nama', 'Kembang Tidak Sekata')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountAnai = DB::table('kerosakans')->
                where('nama', 'Anai - anai')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBungaMati = DB::table('kerosakans')->
                where('nama', 'Bunga Mati')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountTenggelamBanjir = DB::table('kerosakans')->
                where('nama', 'Tenggelam Banjir')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBungaMatiAlam = DB::table('kerosakans')->
                where('nama', 'Bunga Mati')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountMasukMasaCPAlam = DB::table('kerosakans')->
                where('nama', 'Masuk Masa CP')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountIBawahTKemasAlam = DB::table('kerosakans')->
                where('nama', 'I.Bawah T.Kemas')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountBungaTakCPAlam = DB::table('kerosakans')->
                where('nama', 'Bunga Tak CP')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountSeranganHaiwanAlam = DB::table('kerosakans')->
                where('nama', 'Serangan Haiwan')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountSambangAlam = DB::table('kerosakans')->
                where('nama', 'Sambang')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountIAtasTKemasAlam = DB::table('kerosakans')->
                where('nama', 'I.Atas T.Kemas')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountJumlahPeriksa = DB::table('quality_controls')->
                whereNotNull('jum_bagging')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountJumlahRosak = DB::table('quality_controls')->
                whereNotNull('jum_bagging')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountJumlahLulus = DB::table('quality_controls')->
                whereNotNull('jum_bagging_lulus')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountPeratusRosak = DB::table('quality_controls')->
                whereNotNull('peratus_rosak')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsCountFaktorAll = DB::table('kerosakans')->
                where('created_at', 'LIKE', $tahun.'%')->
                count();

                $resultsCountFaktorManusia = DB::table('kerosakans')->
                where('faktor', 'Manusia')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();
        

                $resultsCountFaktorAlam = DB::table('kerosakans')->
                where('faktor', 'Alam')->
                where('created_at', 'LIKE', $tahun_bulan.'%')->
                count();

                $resultsPeratusFaktorManusia = $resultsCountFaktorManusia/$resultsCountFaktorAll * 100;
                $resultsPeratusFaktorAlam = $resultsCountFaktorAlam/$resultsCountFaktorAll * 100;

              if ($bulanan == "01")
              {
                    $result[1] = $resultsCountPatah;
                    $result[2] = $resultsCountTikus;
                    $result[3] = $resultsCountBegPecah;
                    $result[4] = $resultsCountKembangTidakSekata;
		            $result[5] = $resultsCountAnai;
		            $result[6] = $resultsCountBungaMati;
		            $result[7] = $resultsCountTenggelamBanjir;
		            $result[8] = $resultsCountBungaMatiAlam;
		            $result[9] = $resultsCountMasukMasaCPAlam;
		            $result[10] = $resultsCountIBawahTKemasAlam;
		            $result[11] = $resultsCountBungaTakCPAlam;
		            $result[12] = $resultsCountSeranganHaiwanAlam;
		            $result[13] = $resultsCountSambangAlam;
		            $result[14] = $resultsCountIAtasTKemasAlam;
                    $result[15] = $resultsCountJumlahPeriksa;
                    $result[16] = $resultsCountJumlahRosak;
                    $result[17] = $resultsCountJumlahLulus;
                    $result[18] = $resultsCountPeratusRosak;
                    $result[19] = $resultsCountFaktorManusia;
                    $result[20] = number_format($resultsPeratusFaktorManusia,2);
                    $result[21] = $resultsCountFaktorAlam;
                    $result[22] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "02")
              {
                    $result[23] = $resultsCountPatah;
                    $result[24] = $resultsCountTikus;
                    $result[25] = $resultsCountBegPecah;
                    $result[26] = $resultsCountKembangTidakSekata;
		            $result[27] = $resultsCountAnai;
		            $result[28] = $resultsCountBungaMati;
		            $result[29] = $resultsCountTenggelamBanjir;
		            $result[30] = $resultsCountBungaMatiAlam;
		            $result[31] = $resultsCountMasukMasaCPAlam;
		            $result[32] = $resultsCountIBawahTKemasAlam;
		            $result[33] = $resultsCountBungaTakCPAlam;
		            $result[34] = $resultsCountSeranganHaiwanAlam;
		            $result[35] = $resultsCountSambangAlam;
		            $result[36] = $resultsCountIAtasTKemasAlam;
                    $result[37] = $resultsCountJumlahPeriksa;
                    $result[38] = $resultsCountJumlahRosak;
                    $result[39] = $resultsCountJumlahLulus;
                    $result[40] = $resultsCountPeratusRosak;
                    $result[41] = $resultsCountFaktorManusia;
                    $result[42] = number_format($resultsPeratusFaktorManusia,2);
                    $result[43] = $resultsCountFaktorAlam;
                    $result[44] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "03")
              {
                    $result[45] = $resultsCountPatah;
                    $result[46] = $resultsCountTikus;
                    $result[47] = $resultsCountBegPecah;
                    $result[48] = $resultsCountKembangTidakSekata;
		            $result[49] = $resultsCountAnai;
		            $result[50] = $resultsCountBungaMati;
		            $result[51] = $resultsCountTenggelamBanjir;
		            $result[52] = $resultsCountBungaMatiAlam;
		            $result[53] = $resultsCountMasukMasaCPAlam;
		            $result[54] = $resultsCountIBawahTKemasAlam;
		            $result[55] = $resultsCountBungaTakCPAlam;
		            $result[56] = $resultsCountSeranganHaiwanAlam;
		            $result[57] = $resultsCountSambangAlam;
		            $result[58] = $resultsCountIAtasTKemasAlam;
                    $result[59] = $resultsCountJumlahPeriksa;
                    $result[60] = $resultsCountJumlahRosak;
                    $result[61] = $resultsCountJumlahLulus;
                    $result[62] = $resultsCountPeratusRosak;
                    $result[63] = $resultsCountFaktorManusia;
                    $result[64] = number_format($resultsPeratusFaktorManusia,2);
                    $result[65] = $resultsCountFaktorAlam;
                    $result[66] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "04")
              {
                    $result[67] = $resultsCountPatah;
                    $result[68] = $resultsCountTikus;
                    $result[69] = $resultsCountBegPecah;
                    $result[70] = $resultsCountKembangTidakSekata;
		            $result[71] = $resultsCountAnai;
		            $result[72] = $resultsCountBungaMati;
		            $result[73] = $resultsCountTenggelamBanjir;
		            $result[74] = $resultsCountBungaMatiAlam;
		            $result[75] = $resultsCountMasukMasaCPAlam;
		            $result[76] = $resultsCountIBawahTKemasAlam;
		            $result[77] = $resultsCountBungaTakCPAlam;
		            $result[78] = $resultsCountSeranganHaiwanAlam;
		            $result[79] = $resultsCountSambangAlam;
		            $result[80] = $resultsCountIAtasTKemasAlam;
                    $result[81] = $resultsCountJumlahPeriksa;
                    $result[82] = $resultsCountJumlahRosak;
                    $result[83] = $resultsCountJumlahLulus;
                    $result[84] = $resultsCountPeratusRosak;
                    $result[85] = $resultsCountFaktorManusia;
                    $result[86] = number_format($resultsPeratusFaktorManusia,2);
                    $result[87] = $resultsCountFaktorAlam;
                    $result[88] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "05")
              {
                    $result[89] = $resultsCountPatah;
                    $result[90] = $resultsCountTikus;
                    $result[91] = $resultsCountBegPecah;
                    $result[92] = $resultsCountKembangTidakSekata;
		            $result[93] = $resultsCountAnai;
		            $result[94] = $resultsCountBungaMati;
		            $result[95] = $resultsCountTenggelamBanjir;
		            $result[96] = $resultsCountBungaMatiAlam;
		            $result[97] = $resultsCountMasukMasaCPAlam;
		            $result[98] = $resultsCountIBawahTKemasAlam;
		            $result[99] = $resultsCountBungaTakCPAlam;
		            $result[100] = $resultsCountSeranganHaiwanAlam;
		            $result[101] = $resultsCountSambangAlam;
		            $result[102] = $resultsCountIAtasTKemasAlam;
                    $result[103] = $resultsCountJumlahPeriksa;
                    $result[104] = $resultsCountJumlahRosak;
                    $result[105] = $resultsCountJumlahLulus;
                    $result[106] = $resultsCountPeratusRosak;
                    $result[107] = $resultsCountFaktorManusia;
                    $result[108] = number_format($resultsPeratusFaktorManusia,2);
                    $result[109] = $resultsCountFaktorAlam;
                    $result[110] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "06")
              {
                    $result[111] = $resultsCountPatah;
                    $result[112] = $resultsCountTikus;
                    $result[113] = $resultsCountBegPecah;
                    $result[114] = $resultsCountKembangTidakSekata;
		            $result[115] = $resultsCountAnai;
		            $result[116] = $resultsCountBungaMati;
		            $result[117] = $resultsCountTenggelamBanjir;
		            $result[118] = $resultsCountBungaMatiAlam;
		            $result[119] = $resultsCountMasukMasaCPAlam;
		            $result[120] = $resultsCountIBawahTKemasAlam;
		            $result[121] = $resultsCountBungaTakCPAlam;
		            $result[122] = $resultsCountSeranganHaiwanAlam;
		            $result[123] = $resultsCountSambangAlam;
		            $result[124] = $resultsCountIAtasTKemasAlam;
                    $result[125] = $resultsCountJumlahPeriksa;
                    $result[126] = $resultsCountJumlahRosak;
                    $result[127] = $resultsCountJumlahLulus;
                    $result[128] = $resultsCountPeratusRosak;
                    $result[129] = $resultsCountFaktorManusia;
                    $result[130] = number_format($resultsPeratusFaktorManusia,2);
                    $result[131] = $resultsCountFaktorAlam;
                    $result[132] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "07")
              {
                    $result[133] = $resultsCountPatah;
                    $result[134] = $resultsCountTikus;
                    $result[135] = $resultsCountBegPecah;
                    $result[136] = $resultsCountKembangTidakSekata;
		            $result[137] = $resultsCountAnai;
		            $result[138] = $resultsCountBungaMati;
		            $result[139] = $resultsCountTenggelamBanjir;
		            $result[140] = $resultsCountBungaMatiAlam;
		            $result[141] = $resultsCountMasukMasaCPAlam;
		            $result[142] = $resultsCountIBawahTKemasAlam;
		            $result[143] = $resultsCountBungaTakCPAlam;
		            $result[144] = $resultsCountSeranganHaiwanAlam;
		            $result[145] = $resultsCountSambangAlam;
		            $result[146] = $resultsCountIAtasTKemasAlam;
                    $result[147] = $resultsCountJumlahPeriksa;
                    $result[148] = $resultsCountJumlahRosak;
                    $result[149] = $resultsCountJumlahLulus;
                    $result[150] = $resultsCountPeratusRosak;
                    $result[151] = $resultsCountFaktorManusia;
                    $result[152] = number_format($resultsPeratusFaktorManusia,2);
                    $result[153] = $resultsCountFaktorAlam;
                    $result[154] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "08")
              {
                    $result[155] = $resultsCountPatah;
                    $result[156] = $resultsCountTikus;
                    $result[157] = $resultsCountBegPecah;
                    $result[158] = $resultsCountKembangTidakSekata;
		            $result[159] = $resultsCountAnai;
		            $result[160] = $resultsCountBungaMati;
		            $result[161] = $resultsCountTenggelamBanjir;
		            $result[162] = $resultsCountBungaMatiAlam;
		            $result[163] = $resultsCountMasukMasaCPAlam;
		            $result[164] = $resultsCountIBawahTKemasAlam;
		            $result[165] = $resultsCountBungaTakCPAlam;
		            $result[166] = $resultsCountSeranganHaiwanAlam;
		            $result[167] = $resultsCountSambangAlam;
		            $result[168] = $resultsCountIAtasTKemasAlam;
                    $result[169] = $resultsCountJumlahPeriksa;
                    $result[170] = $resultsCountJumlahRosak;
                    $result[171] = $resultsCountJumlahLulus;
                    $result[172] = $resultsCountPeratusRosak;
                    $result[173] = $resultsCountFaktorManusia;
                    $result[174] = number_format($resultsPeratusFaktorManusia,2);
                    $result[175] = $resultsCountFaktorAlam;
                    $result[176] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "09")
              {
                    $result[177] = $resultsCountPatah;
                    $result[178] = $resultsCountTikus;
                    $result[179] = $resultsCountBegPecah;
                    $result[180] = $resultsCountKembangTidakSekata;
		            $result[181] = $resultsCountAnai;
		            $result[182] = $resultsCountBungaMati;
		            $result[183] = $resultsCountTenggelamBanjir;
		            $result[184] = $resultsCountBungaMatiAlam;
		            $result[185] = $resultsCountMasukMasaCPAlam;
		            $result[186] = $resultsCountIBawahTKemasAlam;
		            $result[187] = $resultsCountBungaTakCPAlam;
		            $result[188] = $resultsCountSeranganHaiwanAlam;
		            $result[189] = $resultsCountSambangAlam;
		            $result[190] = $resultsCountIAtasTKemasAlam;
                    $result[191] = $resultsCountJumlahPeriksa;
                    $result[192] = $resultsCountJumlahRosak;
                    $result[193] = $resultsCountJumlahLulus;
                    $result[194] = $resultsCountPeratusRosak;
                    $result[195] = $resultsCountFaktorManusia;
                    $result[196] = number_format($resultsPeratusFaktorManusia,2);
                    $result[197] = $resultsCountFaktorAlam;
                    $result[198] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "10")
              {
                    $result[199] = $resultsCountPatah;
                    $result[200] = $resultsCountTikus;
                    $result[201] = $resultsCountBegPecah;
                    $result[202] = $resultsCountKembangTidakSekata;
		            $result[203] = $resultsCountAnai;
		            $result[204] = $resultsCountBungaMati;
		            $result[205] = $resultsCountTenggelamBanjir;
		            $result[206] = $resultsCountBungaMatiAlam;
		            $result[207] = $resultsCountMasukMasaCPAlam;
		            $result[208] = $resultsCountIBawahTKemasAlam;
		            $result[209] = $resultsCountBungaTakCPAlam;
		            $result[210] = $resultsCountSeranganHaiwanAlam;
		            $result[211] = $resultsCountSambangAlam;
		            $result[212] = $resultsCountIAtasTKemasAlam;
                    $result[213] = $resultsCountJumlahPeriksa;
                    $result[214] = $resultsCountJumlahRosak;
                    $result[215] = $resultsCountJumlahLulus;
                    $result[216] = $resultsCountPeratusRosak;
                    $result[217] = $resultsCountFaktorManusia;
                    $result[218] = number_format($resultsPeratusFaktorManusia,2);
                    $result[219] = $resultsCountFaktorAlam;
                    $result[220] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "11")
              {
                    $result[221] = $resultsCountPatah;
                    $result[222] = $resultsCountTikus;
                    $result[223] = $resultsCountBegPecah;
                    $result[224] = $resultsCountKembangTidakSekata;
		            $result[225] = $resultsCountAnai;
		            $result[226] = $resultsCountBungaMati;
		            $result[227] = $resultsCountTenggelamBanjir;
		            $result[228] = $resultsCountBungaMatiAlam;
		            $result[229] = $resultsCountMasukMasaCPAlam;
		            $result[230] = $resultsCountIBawahTKemasAlam;
		            $result[231] = $resultsCountBungaTakCPAlam;
		            $result[232] = $resultsCountSeranganHaiwanAlam;
		            $result[233] = $resultsCountSambangAlam;
		            $result[234] = $resultsCountIAtasTKemasAlam;
                    $result[235] = $resultsCountJumlahPeriksa;
                    $result[236] = $resultsCountJumlahRosak;
                    $result[237] = $resultsCountJumlahLulus;
                    $result[238] = $resultsCountPeratusRosak;
                    $result[239] = $resultsCountFaktorManusia;
                    $result[240] = number_format($resultsPeratusFaktorManusia,2);
                    $result[241] = $resultsCountFaktorAlam;
                    $result[242] = number_format($resultsPeratusFaktorAlam,2);
              }

              if ($bulanan == "12")
              {
                    $result[243] = $resultsCountPatah;
                    $result[244] = $resultsCountTikus;
                    $result[245] = $resultsCountBegPecah;
                    $result[246] = $resultsCountKembangTidakSekata;
		            $result[247] = $resultsCountAnai;
		            $result[248] = $resultsCountBungaMati;
		            $result[249] = $resultsCountTenggelamBanjir;
		            $result[250] = $resultsCountBungaMatiAlam;
		            $result[251] = $resultsCountMasukMasaCPAlam;
		            $result[252] = $resultsCountIBawahTKemasAlam;
		            $result[253] = $resultsCountBungaTakCPAlam;
		            $result[254] = $resultsCountSeranganHaiwanAlam;
		            $result[255] = $resultsCountSambangAlam;
		            $result[256] = $resultsCountIAtasTKemasAlam;
                    $result[257] = $resultsCountJumlahPeriksa;
                    $result[258] = $resultsCountJumlahRosak;
                    $result[259] = $resultsCountJumlahLulus;
                    $result[260] = $resultsCountPeratusRosak;
                    $result[261] = $resultsCountFaktorManusia;
                    $result[262] = number_format($resultsPeratusFaktorManusia,2);
                    $result[263] = $resultsCountFaktorAlam;
                    $result[264] = number_format($resultsPeratusFaktorAlam,2);
              }
            }
        }
        else
        {
            $tahun_bulan = $tahun."-".$bulan;

            $resultsCountPatah = DB::table('kerosakans')->
            where('nama', 'Patah')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountTikus = DB::table('kerosakans')->
            where('nama', 'Tikus')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBegPecah = DB::table('kerosakans')->
            where('nama', 'Beg Pecah')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountKembangTidakSekata = DB::table('kerosakans')->
            where('nama', 'Kembang Tidak Sekata')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountAnai = DB::table('kerosakans')->
            where('nama', 'Anai - anai')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBungaMati = DB::table('kerosakans')->
            where('nama', 'Bunga Mati')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountTenggelamBanjir = DB::table('kerosakans')->
            where('nama', 'Tenggelam Banjir')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBungaMatiAlam = DB::table('kerosakans')->
            where('nama', 'Bunga Mati')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountMasukMasaCPAlam = DB::table('kerosakans')->
            where('nama', 'Masuk Masa CP')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountIBawahTKemasAlam = DB::table('kerosakans')->
            where('nama', 'I.Bawah T.Kemas')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountBungaTakCPAlam = DB::table('kerosakans')->
            where('nama', 'Bunga Tak CP')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountSeranganHaiwanAlam = DB::table('kerosakans')->
            where('nama', 'Serangan Haiwan')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountSambangAlam = DB::table('kerosakans')->
            where('nama', 'Sambang')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountIAtasTKemasAlam = DB::table('kerosakans')->
            where('nama', 'I.Atas T.Kemas')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountJumlahPeriksa = DB::table('quality_controls')->
            whereNotNull('jum_bagging')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountJumlahRosak = DB::table('quality_controls')->
            whereNotNull('jum_bagging')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountJumlahLulus = DB::table('quality_controls')->
            whereNotNull('jum_bagging_lulus')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountPeratusRosak = DB::table('quality_controls')->
            whereNotNull('peratus_rosak')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsCountFaktorAll = DB::table('kerosakans')->
            where('created_at', 'LIKE', $tahun.'%')->
            count();

            $resultsCountFaktorManusia = DB::table('kerosakans')->
            where('faktor', 'Manusia')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();
        

            $resultsCountFaktorAlam = DB::table('kerosakans')->
            where('faktor', 'Alam')->
            where('created_at', 'LIKE', $tahun_bulan.'%')->
            count();

            $resultsPeratusFaktorManusia = $resultsCountFaktorManusia/$resultsCountFaktorAll * 100;
            $resultsPeratusFaktorAlam = $resultsCountFaktorAlam/$resultsCountFaktorAll * 100;

            $result[1] = $resultsCountPatah;
            $result[2] = $resultsCountTikus;
            $result[3] = $resultsCountBegPecah;
            $result[4] = $resultsCountKembangTidakSekata;
		    $result[5] = $resultsCountAnai;
		    $result[6] = $resultsCountBungaMati;
		    $result[7] = $resultsCountTenggelamBanjir;
		    $result[8] = $resultsCountBungaMatiAlam;
		    $result[9] = $resultsCountMasukMasaCPAlam;
		    $result[10] = $resultsCountIBawahTKemasAlam;
		    $result[11] = $resultsCountBungaTakCPAlam;
		    $result[12] = $resultsCountSeranganHaiwanAlam;
		    $result[13] = $resultsCountSambangAlam;
		    $result[14] = $resultsCountIAtasTKemasAlam;
            $result[15] = $resultsCountJumlahPeriksa;
            $result[16] = $resultsCountJumlahRosak;
            $result[17] = $resultsCountJumlahLulus;
            $result[18] = $resultsCountPeratusRosak;
            $result[19] = $resultsCountFaktorManusia;
            $result[20] = number_format($resultsPeratusFaktorManusia,2);
            $result[21] = $resultsCountFaktorAlam;
            $result[22] = number_format($resultsPeratusFaktorAlam,2);
        }

        if ($bulan == "all")
        {
            $result[265] = $resultsCountPatahAllMonth;
            $result[266] = $resultsCountTikusAllMonth;
            $result[267] = $resultsCountBegPecahAllMonth;
            $result[268] = $resultsCountKembangTidakSekataAllMonth;
            $result[269] = $resultsCountAnaiAllMonth;
            $result[270] = $resultsCountBungaMatiAllMonth;
            $result[271] = $resultsCountTenggelamBanjirAllMonth;
            $result[272] = $resultsCountBungaMatiAlamAllMonth;
            $result[273] = $resultsCountMasukMasaCPAlamAllMonth;
            $result[274] = $resultsCountIBawahTKemasAlamAllMonth;
            $result[275] = $resultsCountBungaTakCPAlamAllMonth;
            $result[276] = $resultsCountSeranganHaiwanAlamAllMonth;
            $result[277] = $resultsCountSambangAlamAllMonth;
            $result[278] = $resultsCountIAtasTKemasAlamAllMonth;
            $result[279] = $resultsCountJumlahPeriksaAllMonth;
            $result[280] = $resultsCountJumlahRosakAllMonth;
            $result[281] = $resultsCountJumlahLulusAllMonth;
            $result[282] = $resultsCountPeratusRosakAllMonth;
            $result[283] = $resultsCountFaktorAlamAllMonth;
            $result[284] = number_format($resultsPeratusFaktorManusiaAllMonth,2);
            $result[285] = $resultsCountFaktorManusiaAllMonth;
            $result[286] = number_format($resultsPeratusFaktorAlamAllMonth,2);

            $result[287] = 0.00;
            $result[288] = 0.00;
            $result[289] = 0.00;
            $result[290] = 0.00;
            $result[291] = 0.00;
            $result[292] = 0.00;
            $result[293] = 0.00;
            $result[294] = 0.00;
            $result[295] = 0.00;
            $result[296] = 0.00;
            $result[297] = 0.00;
            $result[298] = 0.00;
            $result[299] = 0.00;
            $result[300] = 0.00;
        }
        else
        {
            $result[265] = $result[1];
            $result[266] = $result[2];
            $result[267] = $result[3];
            $result[268] = $result[4];
            $result[269] = $result[5];
            $result[270] = $result[6];
            $result[271] = $result[7];
            $result[272] = $result[8];
            $result[273] = $result[9];
            $result[274] = $result[10];
            $result[275] = $result[11];
            $result[276] = $result[12];
            $result[277] = $result[13];
            $result[278] = $result[14];
            $result[279] = $result[15];
            $result[280] = $result[16];
            $result[281] = $result[17];
            $result[282] = $result[18];
            $result[283] = $result[19];
            $result[284] = $result[20];
            $result[285] = $result[21];
            $result[286] = $result[22];

            $result[287] = 0.00;
            $result[288] = 0.00;
            $result[289] = 0.00;
            $result[290] = 0.00;
            $result[291] = 0.00;
            $result[292] = 0.00;
            $result[293] = 0.00;
            $result[294] = 0.00;
            $result[295] = 0.00;
            $result[296] = 0.00;
            $result[297] = 0.00;
            $result[298] = 0.00;
            $result[299] = 0.00;
            $result[300] = 0.00;
        }
            
        return $result;
    }

    public function KawalLaporan10($bulan, $tahun)
    {
        if ($bulan == "all")
        {
            $bulan = "01";
        }

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

    public function KawalLaporan11($bulan, $tahun)
    {
        if ($bulan == "all")
        {
            $bulan = "01";
        }

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

    public function PenuaianLaporan2($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function PenuaianLaporan8($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function PenuaianLaporan9($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
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
        $currentYear = Carbon::now()->year;
        $pastYears = 5;
        $years = [];

        for ($i = $currentYear; $i >= $currentYear - $pastYears; $i--) {
            $years[$i] = $i;
        }

        return view('laporan.fatherpalm.index', compact('years'));
    }

    public function fatherpalmStore(Request $request)
    {
         if ($request->hb == "h")
        {
            $tarikh_mula = date($request->tarikh_mula);
            $tarikh_akhir = date($request->tarikh_akhir);
        }

        $type = $request->laporan;

        switch ($request->laporan)
        {
            case '1':
            $result = $this->FatherMaster( $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
            return view('laporan.fatherpalm.master_bulanan', compact('result'));
        
            case '2':
            switch ($request->hb)
            {
                case 'h':
                $result = $this->RumusanLaporan2($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                return view('laporan.fatherpalm.rumusan2_harian', [
                    'result' => $result,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'tarikh_mula' => $tarikh_mula,
                    'tarikh_akhir' => $tarikh_akhir,
                    'hb' => $request->hb,
                ]);
                break;

                case 'b':
                $result = $this->RumusanLaporan2($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
                return view('laporan.fatherpalm.rumusan2_bulanan', [
                    'result' => $result,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'hb' => $request->hb,
                ]);
                break;

                default:
                alert()->error('Gagal', 'Belum Mula');
                return back();
                break;
            }

            case '3':
            $result = $this->ProgresLaporan3($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
            return view('laporan.fatherpalm.progres3_harian', [
                'result' => $result,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'tarikh_mula' => $tarikh_mula,
                'tarikh_akhir' => $tarikh_akhir,
                'hb' => $request->hb,
            ]);
            break;

            case '4':
            $result = $this->KerosakanLaporan4($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
            return view('laporan.fatherpalm.kerosakan4_bulanan', [
                'result' => $result,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'hb' => $request->hb,
            ]);
            break;

            case '5':
            $result = $this->PenggunaanLaporan5($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
            return view('laporan.fatherpalm.penggunaan5_bulanan', [
                'result' => $result,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'hb' => $request->hb,
            ]);
            break;

            case '6':
            $result = $this->PenggunaanLaporan6($request->hb, $request->bulan, $request->tahun, $tarikh_mula ?? $request->tarikh_mula, $tarikh_akhir ?? $request->tarikh_akhir);
            return view('laporan.fatherpalm.penggunaan6_harian', [
                'result' => $result,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'tarikh_mula' => $tarikh_mula,
                'tarikh_akhir' => $tarikh_akhir,
                'hb' => $request->hb,
            ]);
            break;

        }
    }

    public function FatherMaster($tarikh_mula, $tarikh_akhir)
    {
        $result = [];
        return $result;
    }

    public function RumusanLaporan2($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function ProgresLaporan3($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function KerosakanLaporan4($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function PenggunaanLaporan5($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }

    public function PenggunaanLaporan6($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        if ($hb == 'b')
        {
            if ($bulan == "all")
            {
                $Qcs = QualityControl::whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else
            {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        }
        else if ($hb == 'h')
        {
            
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

        if ($bulan == "all")
        {
            $bulan = "01";
        }

        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $result['daysInMonth'] = $daysInMonth;

        return $result;
    }
}
