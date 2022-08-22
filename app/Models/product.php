<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'productThumb',
        'productDetailThumb',
        'productName',
        'productShortDesc',
        'productDesc',
        'productPrice',
        'productOldPrice',
        'productQty',
        'productDiscount',
        'productcat_id',
        'productCreate',
        'productTime',
        'productStatus',
        'user_id',
        'productFeature',
    ];
    function productcat()
    {
        return $this->belongsTo("App\Models\productcat");
    }
    function User()
    {
        return $this->belongsTo("App\Models\User");
    }
}
