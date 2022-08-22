<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'postThumb',
        'postTitle',
        'postDes',
        'postContent',
        'postcat_id',
        'postCreate',
        'user_id',
        'postTime',
    ];
    function postcat()
    {
        return $this->belongsTo("App\Models\postcat");
    }
    function User()
    {
        return $this->belongsTo("App\Models\User");
    }
}
