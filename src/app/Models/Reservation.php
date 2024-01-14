<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'shop_id', 'reservation_date', 'reservation_time', 'reservation_number'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function rating() {
        return $this->hasOne(Rating::class);
    }
}