<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable as FortifyUser;

class User extends Authenticatable
{
    use HasFactory;
    // Notifiable, TwoFactorAuthenticatable; // 二段階認証

    protected $fillable = ['username', 'email', 'password'];

    // protected $hidden = [
    //    'password',
    //    'remember_token',
    //    'two_factor_recovery_codes',
    //    'two_factor_secret',
    //];

    /*
    public function attendances() {
        return $this->hasMany(Attendance::class);
    }
    */
}