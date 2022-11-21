<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Tugasan;
use App\Models\User;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $motherpalm['balut']['hariini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'balut'])->whereDate('created_at', Carbon::today())->count();
        $motherpalm['balut']['hinggakini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'balut'])->count();
        $motherpalm['debung']['hariini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'debung'])->whereDate('created_at', Carbon::today())->count();
        $motherpalm['debung']['hinggakini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'debung'])->count();
        $motherpalm['kawal']['hariini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'kawal'])->whereDate('created_at', Carbon::today())->count();
        $motherpalm['kawal']['hinggakini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'kawal'])->count();
        $motherpalm['tuai']['hariini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'tuai'])->whereDate('created_at', Carbon::today())->count();
        $motherpalm['tuai']['hinggakini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'tual'])->count();

        $fatherpalm['balut']['hariini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'balut'])->whereDate('created_at', Carbon::today())->count();
        $fatherpalm['balut']['hinggakini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'balut'])->count();
        $fatherpalm['tuai']['hariini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'tuai'])->whereDate('created_at', Carbon::today())->count();
        $fatherpalm['tuai']['hinggakini'] = Tugasan::where(['status' => 'sah', 'jenis' => 'tual'])->count();

        return view('dashboard', compact('motherpalm', 'fatherpalm'));
    }

    public function test()
    {
        $u1 = User::find(14);
        $u1->attachRole('worker');
        $u1 = User::find(15);
        $u1->attachRole('supervisor');

    }

    public function temp()
    {
        $user = User::all();

        foreach ($user as $u) {
            $peranan = Role::where('display_name', $u->peranan)->first();
            $u->attachRole($peranan);
        }

    }
}
