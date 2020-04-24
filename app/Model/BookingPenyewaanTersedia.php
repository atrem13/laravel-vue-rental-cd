<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookingPenyewaanTersedia extends Model
{
    protected $guarded = [];
    public $timestamps =false;

    public function detail_booking_penyewaan()
    {
        return $this->belongsTo('App\Model\DetailBookingPenyewaan', 'detail_booking_penyewaan_id', 'id');
    }
}
