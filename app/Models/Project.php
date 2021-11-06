<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use CascadeSoftDeletes;
    use HasFactory;
    protected $table='projects';
    protected $fillable=['title','description','start_date','finish_date', 'status'];
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
    ];
    protected $cascadeDeletes = ['employeeProjects', 'Phase', 'tasks'];

    public function Phase() {
        return $this->hasOne('App\Models\Phase', 'project_id');
    }

    public function employees(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

    public function employeeProjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmployeeProject::class);
    }

    public function tasks() {
        return $this->hasMany('App\Models\Task');
    }

    public function applyEmployeesScore() {
        $delay_in_days = $this->finish_date->startOfDay()->diffInDays(now()->startOfDay(), false);
        if ($this->status == 'done' && $delay_in_days > 0) {
            foreach ($this->employees as $user) {
                Score::create([
                    'user_id' => $user->id,
                    'value' => Score::PROJECT_DELAY[0] * $delay_in_days,
                    'description' => sprintf(Score::PROJECT_DELAY[1], $delay_in_days, $this->title),
                ]);
            }
        }
    }
}
