<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'ticket_messages';
    protected $fillable = [
        'user_id',
        'ticket_id',
        'content',
        'file'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticker', 'ticket_id');
    }

}
