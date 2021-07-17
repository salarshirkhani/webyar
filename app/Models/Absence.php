<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;
    protected $table='absences';
    protected $fillable=['enter','exit','date','hours'];

    public function for() {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }
}
    
