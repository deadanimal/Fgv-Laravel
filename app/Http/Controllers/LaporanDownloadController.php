<?php

namespace App\Http\Controllers;

use App\Exports\Balut1Export;
use App\Exports\HarianBalutExport;
use App\Models\Bagging;
use App\Models\Pokok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanDownloadController extends Controller
{
    public function balut1($type, Request $request)
    {
        $laporanController = new LaporanController();
        switch ($type) {
            case 'pdf':
                $result = $laporanController->BalutLaporan1($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir);
                $pdf = Pdf::loadView('laporan.motherpalm.table.balut1', [
                    'result' => $result,
                    'pdf' => 1,
                ]);
                return $pdf->download('1P1F Motherpalm.pdf');
                break;
            case 'excel':
                return Excel::download(new Balut1Export($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir), '1P1F.xlsx');
                break;
            case 'csv':
                return Excel::download(new Balut1Export($request->hb, $request->bulan, $request->tahun, $request->tarikh_mula, $request->tarikh_akhir), '1P1F.csv');
                break;
            default:
                return 'invalid type';
                break;
        }
    }

    public function harianBalut($type, $bulan)
    {
        switch ($type) {
            case 'pdf':
                $baluts = Bagging::with(['pengesah', 'pokok'])->whereHas('pengesah')->whereMonth('created_at', '=', $bulan)->get()->groupBy(['pengesah.nama', 'pokok.blok', 'pokok.baka']);
                $days = cal_days_in_month(CAL_GREGORIAN, $bulan, now()->year);

                $pokoks = Pokok::with(['bagging.pengesah'])->whereHas('bagging')->get();

                $row = 0;
                foreach ($baluts as $k => $balut) {
                    foreach ($balut as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            $row++;
                            for ($i = 1; $i <= $days; $i++) {
                                $day[$i][$k][$key][$key2] = 0;
                                $total[$i] = 0;
                            }
                            foreach ($value2 as $theBalut) {
                                for ($i = 1; $i <= $days; $i++) {
                                    if ($theBalut->created_at->format('d') == $i) {
                                        $day[$i][$k][$key][$key2]++;
                                    }
                                }
                            }
                        }
                    }
                }
                $pdf = Pdf::loadView('laporan.motherpalm.table.harian', compact('baluts', 'days', 'day', 'row', 'total'));
                return $pdf->download('Laporan Harian Balut Motherpalm.pdf');
                break;
            case 'excel':
                return Excel::download(new HarianBalutExport($bulan), 'Laporan Harian Balut Motherpalm.xlsx');
                break;
            case 'csv':
                return Excel::download(new HarianBalutExport($bulan), 'Laporan Harian Balut Motherpalm.csv');
                break;
            default:
                return 'invalid type';
                break;
        }
    }
}
