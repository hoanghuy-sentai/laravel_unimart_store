<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productcat extends Model
{
    use HasFactory;
    protected $fillable = [
        'productcatName',
        'productQty',
        'productcatStatus',
        'productcatTime',
        'productcatCreate',
        'parent_id',
    ];
    function product()
    {
       return $this->hasMany("App\Models\product");
    }
}
