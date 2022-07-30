<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function medicines()
    {
        return $this->hasMany('App\Medicine');
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session');
    }
}
