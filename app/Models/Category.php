<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'description', ];


    public function parent() {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function allParent()
    {
        return $this->parent()->with('allParent');
    }


    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }


    public static function hierarchy($type = null)
    {
        $query = self::whereRaw('1=1');
        if ($type != null)
            $query = $query->whereIn('type', \Arr::wrap($type));

        return $query
            ->with('allParent')
            ->get()
            ->sortBy(function (Category $category, $key) {
                $sort = $category->id;
                $level = 1;
                $upCategory = $category;
                while (true) {
                    $upCategory = $upCategory->allParent;
                    if (empty($upCategory))
                        break;
                    $sort += $upCategory->id * (1000 ** $level);
                    $level ++;
                }
                $sort *= 1000 ** (3 - $level); // 3 Levels - Change 3 to another number to change deepness
                $category->level = $level;
                return $sort;
            });
    }
}
