<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absence extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='absences';
    protected $fillable=['employee_id','enter','exit','date','hours'];

    public function for() {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }
}
    
