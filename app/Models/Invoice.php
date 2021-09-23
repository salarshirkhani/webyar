<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public const STATE_UNPAID = 'unpaid';
    public const STATE_PAYING = 'paying';
    public const STATE_PAID = 'paid';
    public const STATE_FAILED = 'failed';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'status',
        'via',
        'transaction_id',
        'reference_id',
        'user_id',
        'project_id',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
