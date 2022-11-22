<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\ControlPollination;
use App\Models\Harvest;
use App\Models\QualityControl;
use App\Models\Tandan;
use App\Models\Tugasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baggings = Bagging::with('petugas')->get();
        $cp = ControlPollination::with('petugas')->get();
        $qc = QualityControl::with('petugas')->get();
        $harvest = Harvest::with('petugas')->get();

        $merged = $baggings->merge($qc)->merge($cp)->merge($harvest)->sortByDesc('created_at')->all();

        return view('tugasan.index', [
            'tugasans' => $merged,
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

        $tugasan = Tugasan::create($request->except('url_gambar'));

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
    public function show($id, $jenis)
    {
        switch ($jenis) {
            case 'Balut':
                $tugasan = Bagging::with(['pokok', 'tandan', 'petugas'])->where('id', $id)->first();
                $type = 1;
                break;
            case 'Pendebungaan Terkawal':
                $tugasan = ControlPollination::with(['pokok', 'tandan', 'petugas'])->where('id', $id)->first();
                $type = 2;
                break;
            case 'Kawalan Kualiti':
                $type = 3;
                $tugasan = QualityControl::with(['pokok', 'tandan', 'petugas'])->where('id', $id)->first();
                break;
            case 'Penuaian':
                $type = 4;
                $tugasan = Harvest::with(['pokok', 'tandan', 'petugas'])->where('id', $id)->first();
                break;
        }

        return view('tugasan.show', compact('tugasan', 'type'));
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
                $url = $request->file('url_gambar')->store(
                    'tugasan', 'public'
                );
                $tugasan['url_gambar'] = $url;
                $tugasan['status'] = 'siap';
                $tugasan['catatan_petugas'] = $request->catatan_petugas;
                break;
            case 'sah':
                $tugasan['status'] = 'sah';
                $tugasan['pengesah_id'] = auth()->id();
                $tugasan['tarikh_pengesahan'] = now();
                $tugasan['catatan_pengesah'] = $request->catatan_pengesah;
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
        if (File::exists(public_path('/storage/' . $tugasan->url_gambar))) {
            File::delete(public_path('/storage/' . $tugasan->url_gambar));
        } else {
            // dd('File does not exists.', $tugasan->url_gambar);
        }

        activity()->event('Tugasan')->log('Tugasan Id:' . $tugasan->id . ' kepada ' . $tugasan->petugas->nama . ' telah dibuang');
        // alert()->success('Berjaya', 'Data tugasan dibuang');
        return back();
    }

    public function tugasan_user()
    {
        $tugasans = Tugasan::where('petugas_id', auth()->id())->orderByDesc('created_at')->get();
        return view('tugasan.user', compact('tugasans'));
    }

    public function search(Request $request)
    {
        if ($request->tarikh_mula == null || $request->tarikh_tamat == null) {
            alert()->error('Gagal', 'Pilih Tarikh Mula dan Tarikh Tamat');
            return back();
        }

        $petugas = User::where('no_kakitangan', $request->no_kakitangan)->first();
        if ($petugas == null) {
            alert()->warning('Gagal', 'Tiada laporan untuk no kakitangan ' . $request->no_kakitangan);
            return back();
        }

        $tugasans = Tugasan::with('petugas')->where('petugas_id', $petugas->id)->orderByDesc('updated_at')->get();

        $mula = date($request->tarikh_mula);
        $akhir = date($request->tarikh_tamat);

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
            alert()->warning('Gagal', 'Tiada laporan dalam jangka tersebut');
            return back();
        }

        return view('tugasan.index', [
            'tugasans' => $result,
            'no_kakitangan' => $request->no_kakitangan,
            'tarikh_mula' => $request->tarikh_mula,
            'tarikh_tamat' => $request->tarikh_tamat,
        ]);

    }

}
