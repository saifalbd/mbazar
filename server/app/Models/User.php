<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable,Media,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 'first_name',
      *  'last_name',
     */
    protected $fillable = [
        'name',
        'has',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
