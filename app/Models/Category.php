<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category')->withDefault([
            'name' => 'Not available',
        ]);
    }

    public function parentCategoryWithOutDefault()
    {
        return $this->belongsTo(Category::class, 'parent_category');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_category', 'id')
            ->where('status', 1)->has('products');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->has("onSaleAttributes");
    }

    public function photo()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', Category::class)
            ->withDefault(['url' => null]);
    }
}
