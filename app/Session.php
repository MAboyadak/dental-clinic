<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'title', 'work', 'cost',
    ];
    // public function patient()
    // {
    //     return $this->belongsTo('App\Patient');
    // }
    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Appointment');
    }

    public function teeth()
    {
        return $this->hasMany('App\Tooth');
    }

    public function file()
    {
        return $this->hasOne('App\File');
    }

    public function payment()
    {
        return $this->hasOne('App\payment');
    }

    public function prescriptions()
    {
        return $this->hasOne('App\Prescription');
    }

    public function note()
    {
        return $this->hasOne('App\Note');
    }
}
