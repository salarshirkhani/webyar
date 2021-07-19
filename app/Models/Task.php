<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable=['project_id','employee_id','title','description','required_time','start_date','finish_date'];


public function for() {
    return $this->belongsTo('App\Models\User', 'employee_id');
}

public function project() {
    return $this->belongsTo('App\Models\Project', 'project_id');
}

}