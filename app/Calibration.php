<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    protected $table = 'calibration';
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

}
