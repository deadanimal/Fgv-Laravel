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
            "no_telefon" => "required",
            "email" => "required|string",
            "stesen" => "required|string",
            "kategori_petugas" => "required|string",
            "blok" => "required|string",
            "luput_pwd" => "required|integer",
        ]);
        $role = Role::where('name', $request->peranan)->first();

        $validated['peranan'] = $role->display_name;
        $validated['password'] = Hash::make('123');
        $user = User::create($validated);

        $user->attachRole($request->peranan);

        activity()->event('CIPTA')->log('User No Kakitangan:' . $user->no_kakitangan . ' telah dicipta');
        alert()->success('Berjaya', 'Pendaftaran Berjaya');

        return redirect()->route('pp.index');

    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'stesens' => Stesen::all(),
            'kategoris' => KategoriPetugas::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "nama" => "required|string",
            "no_kakitangan" => "required|string",
            "peranan" => "required|string",
            "no_kad_pengenalan" => "required|integer|digits:12",
            "no_telefon" => "required",
            "email" => "required|string",
            "stesen" => "required|string",
            "kategori_petugas" => "required|string",
            "blok" => "required|string",
            "luput_pwd" => "required|integer",
        ]);

        $user->update($request->except('peranan'));
        $role = Role::where('name', $request->peranan)->first();
        $user->update([
            'peranan' => $role->display_name,
        ]);

        activity()->event('KEMASKINI')->log('User No Kakitangan:' . $user->no_kakitangan . ' telah dikemaskini');
        alert()->success('Berjaya', 'Data Telah dikemaskini');

        return redirect()->route('pp.index');
    }

    public function delete(User $user)
    {
        activity()->event('HAPUS')->log('User No Kakitangan:' . $user->no_kakitangan . ' telah dihapus');
        alert()->success('Berjaya', 'Data Telah dihapuskan');
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

    public function kemaskini_password(User $user)
    {
        $user->update([
            'password' => Hash::make('INIT123'),
        ]);

        alert()->success('Berjaya', 'Password berjaya di set semula kepada INIT123');
        activity()->event('KEMASKINI')->log('Password User No Kakitangan:' . $user->no_kakitangan . ' telah di set semula');
        return redirect()->route('pp.index');
    }
}
