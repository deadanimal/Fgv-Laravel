<?php

namespace App\Http\Controllers;

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
}
