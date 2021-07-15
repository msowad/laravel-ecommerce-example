<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class)
            ->with(['product', 'productDetails', 'review']);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class)
            ->with(['product', 'productDetails']);
    }

    public function userStatus()
    {
        return $this->hasOne(User::class)->get("email_verified_at");
    }
}
