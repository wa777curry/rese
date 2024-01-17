<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['username', 'email', 'password'];

    public function shops() {
        return $this->belongsToMany(Shop::class, 'reservations')
        ->as('reservation')
        ->withPivot('reservation_date', 'reservation_time', 'reservation_number');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function favorites() {
        return $this->belongsToMany(Shop::class, 'favorites');
    }
}