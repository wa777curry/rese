<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['area_name',];

    public function shops() {
        return $this->hasMany(Shop::class);
    }
}