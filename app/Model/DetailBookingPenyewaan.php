<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailBookingPenyewaan extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function kaset()
    {
        return $this->belongsTo('App\Model\Kaset', 'kaset_id', 'id');
    }

    public function booking_penyewaan()
    {
        return $this->belongsTo('App\Model\BookingPenyewaan', 'booking_penyewaan_id', 'id');
    }

    public function booking_penyewaan_tersedia()
    {
        return $this->hasOne('App\Model\BookingPenyewaanTersedia', 'detail_booking_penyewaan_id', 'id');
    }
}
