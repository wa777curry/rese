<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'shop_name', 'area_id', 'genre_id', 'shop_summary', 'image_url'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'reservations')
        ->as('reservation')
        ->withPivot('reservation_date', 'reservation_time', 'reservation_number');
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function favorites() {
        return $this->belongsToMany(Favorite::class, 'favorites');
    }
}