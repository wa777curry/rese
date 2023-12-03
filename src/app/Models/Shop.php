<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['shop_name', 'area', 'genre', 'shop_summary', 'image_url'];

    public function mypages() {
        return $this->hasMany(Mypage::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
