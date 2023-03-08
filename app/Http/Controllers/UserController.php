<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\KategoriPetugas;
use App\Models\Role;
use App\Models\Stesen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function php()
    {
        return phpinfo();
    }
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
            'bloks' => Blok::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            "nama" => "required|string",
            "no_kakitangan" => "required|string|unique:users",
            "peranan" => "required|string",
            "no_kad_pengenalan" => "required|unique:users|digits:12",
            "no_telefon" => "required",
            "email" => "required|string",
            "stesen" => "required|string",
            "kategori_petugas" => "required|string",
            "luput_pwd" => "required|integer",
            'blok' => "required",
        ]);

        $role = Role::where('name', $request->peranan)->first();

        $validated['peranan'] = $role->display_name;
        $validated['password'] = Hash::make('INIT123');

        $user = User::create($request->except('blok'));

        $newB = 'first';
        foreach ($request->blok as $blok) {
            if ($newB == 'first') {
                $newB = $blok;
            } else {
                $newB = $newB . ',' . $blok;
            }
        }

        $user->update([
            'blok' => $newB,
        ]);

        $user->attachRole($request->peranan);

        activity()->event('CIPTA')->log('User No Kakitangan:' . $user->no_kakitangan . ' telah dicipta');
        alert()->success('Berjaya', 'Pendaftaran Berjaya');

        return redirect()->route('pp.index');

    }

    public function edit(User $user)
    {
        $userBlok = explode(',', $user->blok);
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'stesens' => Stesen::all(),
            'kategoris' => KategoriPetugas::all(),
            'bloks' => Blok::orderBy('nama', 'asc')->get(),
            'userBlok' => $userBlok,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "nama" => "required|string",
            "no_kakitangan" => "required|string",
            "peranan" => "required|string",
            "no_kad_pengenalan" => "required|digits:12",
            "no_telefon" => "required",
            "email" => "required|string",
            "stesen" => "required|string",
            "kategori_petugas" => "required|string",
            "blok" => "required",
            "luput_pwd" => "required|integer",
        ]);

        $user->update($request->except(['peranan', 'blok']));
        $role = Role::where('name', $request->peranan)->first();

        $newB = 'first';
        foreach ($request->blok as $blok) {
            if ($newB == 'first') {
                $newB = $blok;
            } else {
                $newB = $newB . ',' . $blok;
            }
        }

        $user->update([
            'peranan' => $role->display_name,
            'blok' => $newB,
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

    public function password_baru(User $user, Request $request)
    {
        $user->update([
            'password' => Hash::make($request->password1),
            'first_login' => false,
        ]);

        alert()->success('Berjaya', 'Password berjaya diubah');
        activity()->event('KEMASKINI')->log('Password User No Kakitangan:' . $user->no_kakitangan . ' telah di diubah');
        return redirect()->route('pp.index');
    }
}
