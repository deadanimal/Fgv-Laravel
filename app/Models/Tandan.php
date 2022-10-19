<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tandan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function balut()
    {
        return $this->hasOne(Balut::class);
    }
    public function pendebungaan()
    {
        return $this->hasOne(Pendebungaan::class);
    }
    public function kualiti()
    {
        return $this->hasOne(Kualiti::class);
    }
    public function tuai()
    {
        return $this->hasOne(Tuai::class);
    }

    public function pokok()
    {
        return $this->belongsTo(Pokok::class);
    }
}
