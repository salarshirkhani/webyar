<?php

namespace App\Models;

use App\Traits\DateTrait;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;
    use DateTrait;

    protected $table='absences';
    protected $fillable=['employee_id','start','finish','date','hours'];

    public function for() {
        return $this->belongsTo('App\User', 'employee_id');
    }

    public function getDateAttribute($value){

        return Jalalian::forge($value)->format('Y-m-d');
    }

//    public function setDateAttribute($value)
//    {
//        $this->attributes['date']=DateTrait::convert_to_georgian($value);
//    }

    public function scopeSetFinish($query,$id,$date)
    {
        return $query->where('employee_id',$id)->where('date',$date);
    }
}

