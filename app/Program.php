<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
