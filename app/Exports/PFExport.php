<?php

namespace App\Exports;

use App\Models\Pokok;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PFExport implements FromView
{
    public function view(): View
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

        return view('laporan.motherpalm.table.table3', [
            'result' => $result,
            'pdf' => 1,
        ]);
    }
}
