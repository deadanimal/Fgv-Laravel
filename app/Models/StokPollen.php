<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokPollen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pollen()
    {
        return $this->belongsTo(Pollen::class);
    }

}
