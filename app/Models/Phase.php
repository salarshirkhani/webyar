<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;
    protected $table='phases';
    protected $fillable=['title','project_id','start_date','finish_date'];

    public function for() {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
    
}
