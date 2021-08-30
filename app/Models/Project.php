<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='projects';
    protected $fillable=['title','description','start_date','finish_date', 'status'];
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
    ];

    public function Phase() {
        return $this->hasOne('App\Models\Phase', 'project_id');
    }

    public function employees(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
