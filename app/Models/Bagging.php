<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagging extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pokok()
    {
        return $this->belongsTo(Pokok::class);
    }

    public function tandan()
    {
        return $this->belongsTo(Tandan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_sv_balut');
    }

    public function pengesah()
    {
        return $this->belongsTo(User::class, 'pengesah_id');
    }

}
