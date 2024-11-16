<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    protected $fillable = [
        'title',
        'created_at_amocrm'
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
