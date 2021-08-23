<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phase extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='phases';
    protected $fillable=['title','project_id','start_date','finish_date'];
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
    ];

    public function for() {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    public function Phases() {
        return $this->hasMany('App\Models\Task', 'phase_id');
    }


}
