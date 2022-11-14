<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditController extends Controller
{
    public function index()
    {
        $logs = Activity::with('causer')->orderByDesc('updated_at')->get();

        return view('audit.index', [
            'logs' => $logs,
        ]);
    }

    public function search(Request $request)
    {
        $logs = Activity::with('causer:id,no_kakitangan');

        if ($request->no_kakitangan != null) {
            $user = User::where('no_kakitangan', '=', $request->no_kakitangan)->first();
            $logs->where('causer_id', $user->id);
        }
        if ($request->aktiviti != null) {
            $logs->where('event', $request->aktiviti);
        }
        if ($request->tarikh_daftar != null) {
            $logs->whereDate('created_at', $request->tarikh_daftar);
        }

        return view('audit.index', [
            'logs' => $logs->orderByDesc('updated_at')->get(),
            'no_kakitangan' => $request->no_kakitangan,
            'aktiviti' => $request->aktiviti,
            'tarikh_daftar' => $request->tarikh_daftar,
        ]);

    }
}
