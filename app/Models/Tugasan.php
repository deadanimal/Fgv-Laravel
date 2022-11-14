<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugasan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $dates = ['tarikh'];
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

}
