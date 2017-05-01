<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;

    public function equipment() {
        return $this->hasMany('App\Equipment');
    }

    public function reservation() {
        return $this->hasMany('App\Reservation');
    }
}
