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

    public const TASK_DELAY = [-1, 'تاخیر در انجام مسئولیت (%d روز)'];
    public const PROJECT_DELAY = [-5, 'تاخیر در اتمام پروژه (%d روز)'];

}
