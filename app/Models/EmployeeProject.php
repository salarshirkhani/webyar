<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeProject extends Model
{
    use HasFactory;
    protected $table='employee_project';
    protected $fillable=['employee_id','project_id','cost','start_date','finish_date','salary_id'];
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
    ];

    public function for() {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }

    public function project() {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    public function salary() {
        return $this->belongsTo('App\Models\Salary', 'salary_id');
    }

}
