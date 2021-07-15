<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productDetails()
    {
        return $this->belongsTo(ProductDetail::class, 'product_attr_id', 'id')->with('photo');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'product_attr_id', 'product_attr_id')
            ->where('user_id', auth()->id());
    }
}
