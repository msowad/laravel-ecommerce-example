<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $date    = ['deleted_at'];

    public function photo()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', Slider::class)
            ->withDefault(['url' => null]);
    }
}
