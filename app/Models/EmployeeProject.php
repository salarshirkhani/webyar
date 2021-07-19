<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    use HasFactory;
    protected $table='employee_project';
    protected $fillable=['employee_id','project_id','cost','start_date','finish_date'];

    public function for() {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }

    public function project() {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

}
