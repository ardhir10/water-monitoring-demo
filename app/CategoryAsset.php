<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAsset extends Model
{
    protected $table = 'category_asset';
    public function asset(){
        return $this->hasMany(Asset::class);

    }
}
