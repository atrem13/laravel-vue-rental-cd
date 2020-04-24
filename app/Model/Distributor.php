<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $guarded = [];
    public $timestamps =false;

    public function kasets()
    {
        return $this->hasMany('App\Model\Kaset', 'distributor_id', 'id');
    }
}
