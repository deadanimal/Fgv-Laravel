<?php

namespace App\Http\Controllers;

use App\Models\QualityControl;
use Illuminate\Http\Request;

class QualityControlApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(QualityControl::all());
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = QualityControl::create($request->all());
        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'qc', 'public'
            );
            $info->update([
                'url_gambar' => $url,
            ]);
        }

        return response()->json($info);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function show(QualityControl $qualityControl)
    {
        return response()->json($qualityControl);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QualityControl $qualityControl)
    {
        $qualityControl->update($request->except('url_gambar'));

        if ($request->hasFile('url_gambar')) {
            $url = $request->file('url_gambar')->store(
                'qc', 'public'
            );
            $qualityControl->update([
                'url_gambar' => $url,
            ]);
        }

        return response()->json($qualityControl);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualityControl $qualityControl)
    {
        $qualityControl->delete();
        return [
            'Delete' => 'Successful',
        ];

    }
}
