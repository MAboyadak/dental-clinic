<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function session()
    {
        return $this->hasOne('App\Session');
    }
}
