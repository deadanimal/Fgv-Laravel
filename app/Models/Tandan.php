<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tandan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pokok()
    {
        return $this->belongsTo(Pokok::class);
    }

    public function bagging()
    {
        return $this->hasOne(Bagging::class);
    }

    public function cp()
    {
        return $this->hasOne(ControlPollination::class);
    }

    public function qc()
    {
        return $this->hasOne(QualityControl::class);
    }

    public function harvest()
    {
        return $this->hasOne(Harvest::class);
    }
}
