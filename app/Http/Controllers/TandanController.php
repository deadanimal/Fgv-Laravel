<?php

namespace App\Http\Controllers;

use App\Models\Tandan;

class TandanController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.tandan.index', [
            'tandan' => Tandan::all(),
        ]);
    }

    public function create()
    {
        return view('pengurusanPokokInduk.tandan.create');

    }

    public function update()
    {
        # code...
    }
    public function delete()
    {

    }

    public function MuatNaikDokumenTandan()
    {
        return view('pengurusanPokokInduk.tandan.muatNaikDokumen');
    }
}
