<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table='payments';
    protected $fillable=['employee_id','cost','payment_status','payment_date','confirm_code'];
    protected $casts = [
        'payment_date' => 'date',
    ];

    public function for() {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }
}
