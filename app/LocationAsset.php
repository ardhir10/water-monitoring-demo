<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationAsset extends Model
{
    protected $table = 'location_asset';

    public function asset(){
        return $this->hasMany(Asset::class);

    }
}
