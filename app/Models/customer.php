<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable=['code','fullname','email','address','phone','time','note'];
    function order()
    {
        return $this->hasMany("App\Models\order");
    }
    // function user()
    // {
    //     return $this->belongsTo("App\Models\User");
    // }
}
