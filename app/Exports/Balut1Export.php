<?php

namespace App\Exports;

use App\Models\Pokok;
use App\Models\QualityControl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Balut1Export implements FromView
{
    public $hb;
    public $bulan;
    public $tahun;
    public $tarikh_mula;
    public $tarikh_akhir;

    public function __construct($hb, $bulan, $tahun, $tarikh_mula, $tarikh_akhir)
    {
        $this->hb = $hb;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->tarikh_mula = $tarikh_mula;
        $this->tarikh_akhir = $tarikh_akhir;
    }

    public function view(): View
    {
        $tarikh_mula = date($this->tarikh_mula);
        $tarikh_akhir = date($this->tarikh_akhir);


        if ($this->hb == 'b') {
            if ($this->bulan == "all") {
                $Qcs = QualityControl::whereYear('created_at', $this->tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            } else {
                $Qcs = QualityControl::with('pokok')->whereMonth('created_at', $this->bulan)
                    ->whereYear('created_at', $this->tahun)
                    ->whereHas('pokok', function ($pokok) {
                        $pokok->where('status_pokok', 'aktif')
                            ->where('jantina', 'motherpalm');
                    })
                    ->get();
            }
        } else if ($this->hb == 'h') {
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
                    switch ($qc->created_at->format('m')) {
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
                }
            }
            $result[$key]['j_motherpalm'] = Pokok::where('status_pokok', 'aktif')
                ->where('jantina', 'Motherpalm')
                ->where('blok', $lbb->blok)
                ->where('baka', $lbb->baka)->count();
        }
        $result['listBlokBaka'] = $listBlokBaka;

        return view('laporan.motherpalm.table.balut1', [
            'result' => $result,
            'pdf' => 1,
        ]);
    }
}
