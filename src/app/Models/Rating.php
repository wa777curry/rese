<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['reservation_id', 'rating', 'comment'];

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
