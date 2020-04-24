<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $guarded =[];
    public $timestamps = false;

    public function kasets()
    {
        return $this->hasMany('App\Model\Kaset', 'rak_id', 'id');
    }
}
