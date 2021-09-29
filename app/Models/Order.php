<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('amount')->withTimestamps();
    }

    function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    function invoice(): BelongsTo
    {
        return $this->belongsTo('App\Models\Invoice');
    }
}
