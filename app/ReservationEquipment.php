<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationEquipment extends Model
{
    public $timestamps = false;

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }

    public function equipment() {
        return $this->hasone(Equipment::class);
    }
}