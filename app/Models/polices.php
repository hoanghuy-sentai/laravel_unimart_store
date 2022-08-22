<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class polices extends Model
{
    use HasFactory;
    protected $fillable = [
        'moduleName',
        'user_id',
        'list',
        'add',
        'edit',
        'delete',
        'right_id',
    ];
    function right()
    {
       return  $this->belongsTo('App\Models\right');
    }
}
