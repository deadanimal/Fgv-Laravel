<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
        ]);

        $user = User::create([
            'nama' => 'Admin',
            'no_kakitangan' => '123',
            'no_kad_pengenalan' => '123',
            'kategori_petugas' => 'ayam',
            'tugasan' => 'tugasansa',
            'email' => 'a@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}
