<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function photo()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', Brand::class)
            ->withDefault(['url' => null]);
    }
}
