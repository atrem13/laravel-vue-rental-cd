<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];
    public $timestamps =false;

    public function penyewaans()
    {
        return $this->hasMany('App\Model\Penyewaan', 'member_id', 'id');
    }

    public function booking_penyewaans()
    {
        return $this->hasMany('App\Model\BookingPenyewaan', 'member_id', 'id');
    }
}
