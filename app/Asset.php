<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

    protected $table = 'asset';
    protected $fillable = [
        'code',
        'name',
        'purchase_at',
        'purchase_price',
        'description',
        'image',
        'status',
        'model',
        'brand',
        'category_id',
        'asset_part_of',
        'location_id',
        'type_id',
    ];
    public function category()
    {
        return $this->belongsTo(CategoryAsset::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function calibration()
    {
        return $this->hasMany(Calibration::class);
    }

    public function parent()
    {
        return $this->belongsTo(Asset::class, 'asset_part_of');
    }

    public function location()
    {
        return $this->belongsTo(LocationAsset::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeAsset::class);
    }
    public function boms()
    {
        return $this->belongsToMany(Bom::class);
    }

}
