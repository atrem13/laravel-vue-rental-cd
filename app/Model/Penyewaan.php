<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $guarded =[];
    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo('App\Model\Member', 'member_id','id');
    }

    public function detail_penyewaans()
    {
        return $this->hasMany('App\Model\DetailPenyewaan', 'penyewaan_id', 'id');
    }
}
