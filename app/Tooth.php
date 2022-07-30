<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tooth extends Model
{
    protected $guarded = [];
    // public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    
}
