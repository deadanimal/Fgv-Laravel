<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokok extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tandan()
    {
        return $this->hasMany(Tandan::class);
    }

    public function bagging()
    {
        return $this->hasMany(Bagging::class);
    }

    public function qc()
    {
        return $this->hasMany(QualityControl::class);
    }

}
