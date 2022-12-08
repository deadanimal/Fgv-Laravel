<?php

namespace App\Http\Controllers;

use App\Exports\HarianBalutExport;
use App\Exports\PFExport;
use App\Models\Bagging;
use App\Models\Pokok;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanDownloadController extends Controller
{
    public function PF($type)
    {
        switch ($type) {
            case 'pdf':
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

                $pdf = Pdf::loadView('laporan.motherpalm.table.pf', [
                    'result' => $result,
                    'pdf' => 1,
                ]);
                return $pdf->download('1P1F Motherpalm.pdf');

                break;
            case 'excel':
                return Excel::download(new PFExport, '1P1F.xlsx');
                break;
            case 'csv':
                return Excel::download(new PFExport, '1P1F.csv');
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
