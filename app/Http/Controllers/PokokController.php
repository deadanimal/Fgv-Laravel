<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokokController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.pokok.index');
    }

    public function create()
    {
        return view('pengurusanPokokInduk.pokok.create');
    }

    public function edit()
    {
        return view('pengurusanPokokInduk.pokok.edit');
    }

    public function update(Request $request)
    {
        # code...
    }

    public function delete(Request $request)
    {
        # code...
    }

}
