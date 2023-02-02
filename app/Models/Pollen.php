<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_sv_pollen');
    }

    public function pokok()
    {
        return $this->belongsTo(Pokok::class);
    }
}
