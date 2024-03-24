<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    protected $fillable = ['genre_name', 'image_url'];

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}