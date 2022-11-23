<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatlamatTahunan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bulan()
    {
        return $this->hasMany(MatlamatBulanan::class);
    }
}
