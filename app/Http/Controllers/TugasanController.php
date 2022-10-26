<?php

namespace App\Http\Controllers;

use App\Models\Pokok;
use App\Models\Tandan;
use App\Models\Tugasan;
use App\Models\User;
use Illuminate\Http\Request;

class TugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tugasan.index', [
            'tugasans' => Tugasan::with('petugas')->orderByDesc('updated_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tugasan.create', [
            'tandans' => Tandan::whereNotNull('pokok_id')->get(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tugasan::create($request->all());
        alert()->success('Berjaya', 'Tugasan berjaya disimpan');
        activity()->event('Tugasan')->log('Tugasan Ditambah');
        return redirect()->route('tugasan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function show(Tugasan $tugasan)
    {
        $tandan = Tandan::find($tugasan->tandan_id);
        $pokok = Pokok::find($tandan->pokok_id);
        $namaPetugas = User::find($tugasan->petugas_id)->nama;
        $namaPengesah = User::find($tugasan->pengesah_id)->nama;

        return view('tugasan.show', compact('tugasan', 'tandan', 'pokok', 'namaPetugas', 'namaPengesah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugasan $tugasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugasan $tugasan)
    {
        switch ($request->status) {
            case 'siap':
                $tugasan['status'] = 'siap';
                break;
            case 'sah':
                $tugasan['status'] = 'sah';
                $tugasan['pengesah_id'] = auth()->id();
                $tugasan['tarikh_pengesahan'] = now();
                break;
            case 'rosak':
                $tugasan['status'] = 'rosak';
                $tugasan['pengesah_id'] = auth()->id();
                $tugasan['tarikh_pengesahan'] = now();
                break;
            default:
                abort(500);
                break;
        }
        $tugasan->save();

        activity()->event('Tugasan')->log('Tugasan Id:' . $tugasan->id . ' kepada ' . $tugasan->petugas->nama . ' telah ' . $tugasan->status);
        alert()->success('Berjaya', 'Data dikemaskini');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugasan  $tugasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugasan $tugasan)
    {
        $tugasan->delete();
        activity()->event('Tugasan')->log('Tugasan Id:' . $tugasan->id . ' kepada ' . $tugasan->petugas->nama . ' telah dibuang');
        alert()->success('Berjaya', 'Data tugasan dibuang');
        return back();
    }
}
