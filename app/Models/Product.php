<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class)->orderBy('order_id', 'asc')->with('photo');
    }

    public function onSaleAttributes()
    {
        return $this->hasMany(ProductDetail::class)
            ->with(['maxRate', 'photo'])
            ->where('status', 1)
            ->where('qty', '>', 0)
            ->orderBy('order_id', 'asc');
    }

    public function details()
    {
        return $this->hasMany(ProductDetail::class)
            ->with(['reviews', 'photo', 'maxRate'])
            ->where('status', 1)
            ->where('qty', '>', 0)
            ->orderBy('order_id', 'asc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class)->withDefault(['value' => 0]);
    }
}
