<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    protected $table = 'bom';
    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }
    public function assets(){
        return $this->hasMany(Asset::class);

    }
}
