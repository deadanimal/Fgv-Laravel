<?php

namespace App\Http\Controllers;

use App\Exports\PFExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanDownloadController extends Controller
{
    public function PF($type)
    {
        if ($type == 'excel') {
            return Excel::download(new PFExport, '1P1F.xlsx');
        }
        if ($type == 'csv') {
            return Excel::download(new PFExport, '1P1F.csv');
        }
    }
}
