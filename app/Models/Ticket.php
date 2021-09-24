<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'tickets';
    protected $fillable = [
        'title',
        'user_id',
        'agent_id',
        'department',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id');
    }

    public function messages() {
        return $this->hasMany('App\Models\TicketMessage')->orderBy('created_at', 'desc');
    }

}
