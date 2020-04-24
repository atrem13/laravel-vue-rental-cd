<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookingPenyewaan extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo('App\Model\Member', 'member_id', 'id');
    }

    public function detail_booking_penyewaans()
    {
        return $this->hasMany('App\Model\DetailModelPenyewaan', 'booking_penyewaan_id', 'id');
    }
}
