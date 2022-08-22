<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *s
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'right_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    function page()
    {
        $this->hasMany('App\Models\Page');
    }
    function post()
    {
        return $this->hasMany('App\Models\post');
    }
    function product()
    {
        return $this->hasMany('App\Models\User');
    }
    function slide()
    {
        return $this->hasMany('App\Models\slide');
    }
    function right()
    {
        $str=str_replace(' ','',"App\Models\ right");
        return $this->belongsTo($str);
    }
}
