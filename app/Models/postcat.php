<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postcat extends Model
{
    use HasFactory;
    protected $fillable=[
        'catName',
        'catStatus',
        'catCreate',
        'catTime',
        'parent_id',
    ];
    function post()
    {
       return  $this->hasMany("App\Models\post");
    }
}
