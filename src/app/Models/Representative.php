<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Representative extends Authenticatable
{
    protected $fillable = ['representativename', 'email', 'password'];
}
