<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    protected $guarded = [];
    protected $table = 'medical_information';

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
