<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class right extends Model
{
    use HasFactory;
    protected $fillable=[
        'nameOfRight',
        'descriptionOfRight',
        'dateOfCreating',
    ];
    function User()
    {
        $this->hasMany("App\Models\User");
    }
    function polices()
    {
       return $this->hasMany('App\Models\polices');
    }
}
