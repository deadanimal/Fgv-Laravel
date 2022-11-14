<?php

namespace App\Http\Controllers;

use App\Models\Tugasan;
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

        return view('laporan.motherpalm.show', [
            'laporans' => $result,
            'dates' => $date,
        ]);

    }

    public function fatherpalm()
    {
        return view('laporan.fatherpalm.index');
    }

}
