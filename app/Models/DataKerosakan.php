<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKerosakan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kerosakan()
    {
        return $this->belongsTo(Kerosakan::class);
    }
}
