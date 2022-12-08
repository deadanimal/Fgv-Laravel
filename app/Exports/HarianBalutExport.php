<?php

namespace App\Exports;

use App\Models\Bagging;
use App\Models\Pokok;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HarianBalutExport implements FromView
{

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $baluts = Bagging::with(['pengesah', 'pokok'])->whereHas('pengesah')->whereMonth('created_at', '=', $this->bulan)->get()->groupBy(['pengesah.nama', 'pokok.blok', 'pokok.baka']);
        $days = cal_days_in_month(CAL_GREGORIAN, $this->bulan, now()->year);

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

        return view('laporan.motherpalm.table.harian', compact('baluts', 'days', 'day', 'row', 'total'));
    }
}
