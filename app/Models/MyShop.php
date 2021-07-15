<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyShop extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function logoPrimary()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', 'logo_primary')
            ->withDefault(['url' => null]);
    }

    public function logoSecondary()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', 'logo_secondary')
            ->withDefault(['url' => null]);
    }

    public function favicon()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', 'favicon')
            ->withDefault(['url' => null]);
    }
}
