<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['shop_name', 'area', 'genre', 'shop_summary', 'image_url'];

    public function users() {
        return $this->belongsToMany(User::class, 'reservations')
        ->as('reservation')
        ->withPivot('reservation_date', 'reservation_time', 'reservation_number');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
