<?php

namespace App\Http\Controllers;

class TandanController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.tandan.index');
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
