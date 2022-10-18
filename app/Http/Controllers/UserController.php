<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->search);
            $result = User::where('no_kakitangan', $request->search)->where('peranan', 'Pengguna')->get();
            return response()->json([$result]);
        }

        return view('user.index', [
            'users' => User::where('peranan', 'Pengguna')->get(),
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            "nama" => "required|string",
            "no_kakitangan" => "required|string",
            "no_kad_pengenalan" => "required|integer",
            "no_telefon" => "required|integer",
            "email" => "required|string",
            "stesen" => "required|string",
            "kategori_petugas" => "required|string",
            "tugasan" => "required|string",
            "blok" => "required|string",
            "luput_pwd" => "required|integer",
            'peranan' => "required|string",
        ]);
        if (strlen($request->no_kad_pengenalan) != 12) {
            alert()->error('No kad pengenalan mesti mempunya 12 angka');
            return back()->withErrors(['no_kad_pengenalan' => 'The Message']);
        }
        $validated['password'] = Hash::make('123');
        User::create($validated);

        alert()->success('Pendaftaran Berjaya');
        return redirect()->route('pp.index');

    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('pp.index');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('pp.index');
    }

    public function laporan()
    {
        return view('user.laporan');
    }

    public function maklumat()
    {
        return view('user.maklumat');
    }
}
