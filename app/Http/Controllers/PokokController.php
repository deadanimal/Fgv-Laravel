<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use Illuminate\Http\Request;

class PokokController extends Controller
{
    public function index()
    {
        return view('pengurusanPokokInduk.pokok.index', [
            'pokoks' => Pokok::with('user')->get(),
        ]);
    }

    public function create()
    {
        return view('pengurusanPokokInduk.pokok.create');
    }

    public function edit(Pokok $pokok)
    {
        return view('pengurusanPokokInduk.pokok.edit', compact('pokok'));
    }

    public function store(Request $request)
    {
        Pokok::create($request->all());

        return redirect()->route('pi.p.index');
    }

    public function update(Request $request, Pokok $pokok)
    {
        $pokok->update($request->all());

        return redirect()->route('pi.p.index');
    }

    public function delete(Pokok $pokok)
    {
        $pokok->delete();
        return redirect()->route('pi.p.index');
    }

}
