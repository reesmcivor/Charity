<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    public function people()
    {
        return $this->belongsToMany('App\People');
    }
}
