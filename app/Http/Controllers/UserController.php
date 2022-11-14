<?php

namespace App\Http\Controllers;

use App\Models\KategoriPetugas;
use App\Models\Role;
use App\Models\Stesen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = User::where('no_kakitangan', $request->search)->orderByDesc('updated_at')->get();
            return response()->json([$result]);
        }

        return view('user.index', [
            'users' => User::orderByDesc('updated_at')->get(),
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'roles' => Role::all(),
            'stesens' => Stesen::all(),
            'kategoris' => KategoriPetugas::all(),
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            "nama" => "required|string",
            "no_kakitangan" => "required|string|unique:users",
            "peranan" => "required|string",
            "no_kad_pengenalan" => "required|integer|unique:users|digits:12",
            "no_telefon" => "required|integer",
            "email" => "required|string",
            "stesen" => "required|string",
            "kategori_petugas" => "required|string",
            "blok" => "required|string",
            "luput_pwd" => "required|integer",
            'peranan' => "required|string",
        ]);

        $validated['password'] = Hash::make('123');
        $user = User::create($validated);

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

    public function kemaskini_password(Request $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        alert()->success('Berjaya', 'Password berjaya diubah');

        activity()->event('Kemaskini Data')->log('Password ' . $user->nama . ' telah diubah');

        return redirect()->route('pp.index');
    }
}
