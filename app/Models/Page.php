<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'PageName',
        'pageStatus',
        'pageContent',
        'user_id',
        'pageCreate',
    ];
    function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}
