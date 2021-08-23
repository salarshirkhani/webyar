<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='employees';
    protected $fillable=['first_name','last_name','ssn','birthdate','phone','rate','role'];
    protected $casts = [
        'birthdate' => 'date',
    ];

}
