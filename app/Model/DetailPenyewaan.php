<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function penyewaan()
    {
        return $this->belongsTo('App\Model\Penyewaan', 'penyewaan_id', 'id');
    }

    public function kaset()
    {
        return $this->belongsTo('App\Model\Kaset', 'kaset_id', 'id');
    }
}
