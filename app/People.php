<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    public function trades()
    {
        return $this->belongsToMany('App\Trade');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
