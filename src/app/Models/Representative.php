<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Representative extends Authenticatable
{
    protected $fillable = ['representativename', 'email', 'password'];

    public function shops() {
        return $this->hasMany(Shop::class);
    }

    public function reservations() {
        return $this->hasManyThrough(Reservation::class, Shop::class);
    }
}
