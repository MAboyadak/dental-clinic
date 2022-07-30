<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function session()
    {
        return $this->belongsTo('App\Session');
    }
    
}
