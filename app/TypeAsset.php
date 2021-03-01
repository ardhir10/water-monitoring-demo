<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeAsset extends Model
{
    protected $table = 'type_asset';

    public function asset(){
        return $this->hasMany(Asset::class);

    }

    public function material(){
        return $this->hasMany(Material::class);

    }
}
