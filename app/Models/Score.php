<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'value',
        'description',
    ];

    public const TASK_DELAY = [-0.25, 'تاخیر در انجام مسئولیت (%d روز - پروژه %s - مسئولیت %s)'];
    public const PROJECT_DELAY = [-0.25, 'تاخیر در اتمام پروژه (%d روز - پروژه %s)'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
