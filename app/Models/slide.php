<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class slide extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'slidePic',
        'slideCreate',
        'slideTime',
        'slideStatus',
    ];
    function User()
    {
        return $this->belongsTo("App\Models\User");
    }
}
