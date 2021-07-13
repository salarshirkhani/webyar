<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string $type
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $alt_name
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereAltName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
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
