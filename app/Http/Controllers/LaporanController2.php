<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\Pokok;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController2 extends Controller
{
    public function bagging($bulan, $tahun)
    {
        $list = Bagging::with(['petugas', 'pokok'])
        ->whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->orderBy('pokok_id', 'asc')
        ->orderBy('created_at', 'asc')
        ->get()
        ->transform(function ($item) {
            return [
                'id' => $item->id,
                'id_sv_balut' => $item->id_sv_balut,
                'sv_name' => data_get($item->petugas, 'nama'),
                'pokok_id' => $item->pokok_id,
                'blok_baka' => data_get($item->pokok, 'blok') . "|" . data_get($item->pokok, 'baka'),
                'blok' => data_get($item->pokok, 'blok'),
                'baka' => data_get($item->pokok, 'baka'),
                'date'  => date('d', strtotime($item->created_at))
            ];
        })
        ->groupBy('sv_name')
        ->transform(function ($item) {
            return $item->groupBy('blok_baka')
                ->transform(function ($item2) {
                    return $item2->countBy('date');
                });
        });

            $bulan = Carbon::createFromFormat('n', $bulan)->locale('ms')->monthName;
            // dd($list);
        return view('laporan.motherpalm.bagging', compact('list', 'tahun', 'bulan'));
    }

    public function fatherpalm()
    {
        $laporan = [
            1 => 'Master Record',
            2 => 'Rumusan 1P1F',
            3 => 'Rekod Progress Membalut sub QC dan Tuai bagi Bunga Pisifera Ladang Benih',
            4 => 'Laporan Kerosakan Membalut Bunga Pisifera dan Kerosakan Sebelum dan Selepas Bunga di Tuai',
            5 => 'Data Penggunaan Pollen Mengikut Blok',
            6 => 'Rekod Penggunaan Harian Pollen ke Ladang Benih'
        ];
        return view('laporan.fatherpalm.main', compact('laporan'));
    }
}
