<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable=['project_id','employee_id','phase_id','title','description','status','start_date','finish_date'];


public function for() {
    return $this->belongsTo('App\Models\User', 'employee_id');
}

public function phase() {
    return $this->belongsTo('App\Models\Phase', 'phase_id');
}

public function project() {
    return $this->belongsTo('App\Models\Project', 'project_id');
}

}