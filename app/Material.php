<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';

    public function type()
    {
        return $this->belongsTo(TypeAsset::class);
    }
    public function boms(){
        return $this->hasMany(Bom::class);

    }
}
 