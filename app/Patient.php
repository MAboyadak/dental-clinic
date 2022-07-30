<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'name', 'age', 'number', 'city', 'image','job'
    ];

    // protected $attributes = [
    //     'gender' => 'male',
    // ];

    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }
    public function teeth()
    {
        return $this->hasMany('App\Tooth');
    }
    public function files()
    {
        return $this->hasMany('App\File');
    }
    public function prescriptions()
    {
        return $this->hasMany('App\Prescription');
    }
    public function medicalInfo()
    {
        return $this->hasOne('App\MedicalInfo');
    }
    public function payments()
    {
        return $this->hasMany('App\payment');
    }
    public function notes()
    {
        return $this->hasMany('App\Note');
    }
    public function programs()
    {
        return $this->hasMany('App\Program');
    }
    
    
}
