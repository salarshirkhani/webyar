<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class message extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='messages';
    protected $fillable=['sender_id','user_id','answer_id','title','content','file'];

    public function as() {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function for() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function answer() {
        return $this->belongsTo('App\Models\message', 'answer_id');
    }

}
