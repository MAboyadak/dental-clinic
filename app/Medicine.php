<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = [];

    public function prescription()
    {
        return $this->belongsTo('App\Prescription');
    }
}
