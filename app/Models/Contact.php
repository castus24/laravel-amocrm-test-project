<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'deal_id',
        'name',
        'phone',
        'comment'
    ];
}
