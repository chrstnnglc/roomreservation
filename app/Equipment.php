<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public $timestamps = false;

    public function room() {
        return $this->belongsTo('App\Room', 'room_id');
    }
}
