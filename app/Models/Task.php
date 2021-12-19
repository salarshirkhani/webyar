<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='tasks';
    protected $fillable=['project_id','employee_id','phase_id','title','description','status','start_date','finish_date','continuity','start_time','finish_time','done_at'];
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
        'done_at' => 'date',
        'start_time' => 'date:H:i',
        'finish_time' => 'date:H:i',
    ];

public function for() {
    return $this->belongsTo('App\Models\User', 'employee_id');
}

public function phase() {
    return $this->belongsTo('App\Models\Phase', 'phase_id');
}

public function project() {
    return $this->belongsTo('App\Models\Project', 'project_id');
}

    public function getIsDoneAttribute() {
        if (empty($this->continuity))
            return $this->status == 'done';
        else {
            return $this->status == 'done' && (
                empty($this->done_at) ||
                (
                    now()->lte($this->finish_date) &&
                    $this->done_at->isSameDay(now()))
                );
        }
    }

    public function getIsDueOrOverdueAttribute() {
        $now = now()->startOfDay();
        $finish_date = $this->finish_date;
        $start_date = $this->start_date;
        return !$this->is_done && (
            $now->diffInDays($finish_date, false)<=0 ||
            (
                $start_date->lte($now) &&
                $finish_date->gte($now) &&
                (
                    $this->continuity == '1d' ||
                    ($this->continuity == '2d' && ($now->diffInDays($start_date) % 2) == 0)
                )
            )
        );
    }

    public function getIsOverdueAttribute() {
        $now = now()->startOfDay();
        $finish_date = $this->finish_date;
        return !$this->is_done && (
            $now->diffInDays($finish_date, false)<0 ||
            ($now->diffInDays($finish_date, false)==0 && !empty($finish_time) && $finish_time->lte($now))
        );
    }

    public function getIsForTomorrowAttribute() {
        $now = now()->startOfDay();
        $tomorrow = now()->startOfDay()->addDay();
        $finish_date = $this->finish_date;
        $start_date = $this->start_date;
        return (
            !$this->is_done &&
            (
                ($now->diffInDays($finish_date, false) <= 1 && $now->diffInDays($finish_date, false)>0) ||
                ($start_date->lte($now) && $finish_date->gte($tomorrow) && (
                        ($this->continuity == '1d') ||
                        ($this->continuity == '2d' && ($now->diffInDays($start_date) % 2) == 1)
                    )
                )
            )
        ) || (
            $this->status == 'done' &&
            $this->continuity == '1d' &&
            !empty($this->done_at) &&
            $this->done_at->isSameDay($now)
        );
    }

    public function scopeManagePage($query)
    {
        return $query->where(function($q) {
            $q
                ->where('status', 'notwork')
                ->orWhereNull('done_at')
                ->orWhere(function($q) {
                    $q
                        ->whereNotNull('continuity')
                        ->where('finish_date', '>=', now());
                });
        });
    }

    public function applyEmployeeScore($user) {
        $delay_in_days = $this->finish_date->startOfDay()->diffInDays(now()->startOfDay(), false);
        if ($this->status == 'done' && $delay_in_days > 0) {
            Score::create([
                'user_id' => $user->id,
                'value' => Score::TASK_DELAY[0] * $delay_in_days,
                'description' => sprintf(Score::TASK_DELAY[1], $delay_in_days, empty($this->project) ? 'نامشخص' : $this->project->title, $this->title),
            ]);
        }
    }

}
