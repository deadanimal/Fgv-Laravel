<?php

namespace App\Http\Controllers;

use App\Models\Bagging;
use App\Models\ControlPollination;
use App\Models\Harvest;
use App\Models\Pollen;
use App\Models\Role;
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
        $motherpalm['balut']['hariini'] = Bagging::whereDate('created_at', Carbon::today())->count();
        $motherpalm['balut']['hinggakini'] = Bagging::count();

        $motherpalm['debung']['hariini'] = Pollen::whereDate('created_at', Carbon::today())->count();
        $motherpalm['debung']['hinggakini'] = Pollen::count();

        $motherpalm['kawal']['hariini'] = ControlPollination::whereDate('created_at', Carbon::today())->count();
        $motherpalm['kawal']['hinggakini'] = ControlPollination::count();

        $motherpalm['tuai']['hariini'] = Harvest::whereDate('created_at', Carbon::today())->count();
        $motherpalm['tuai']['hinggakini'] = Harvest::count();

        $fatherpalm['balut']['hariini'] = Bagging::whereDate('created_at', Carbon::today())->count();
        $fatherpalm['balut']['hinggakini'] = Bagging::count();
        $fatherpalm['tuai']['hariini'] = Harvest::whereDate('created_at', Carbon::today())->count();
        $fatherpalm['tuai']['hinggakini'] = Harvest::count();

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
