<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;

    public function room() {
        return $this->belongsTo('App\Room','room_id');
    }

    public function equipment() {
    	return $this->hasmany(ReservationEquipment::class);
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
}
