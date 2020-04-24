<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kaset extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function distributor()
    {
        return $this->belongsTo('App\Model\Distributor', 'distributor_id','id');
    }

    public function kategori_kaset()
    {
        return $this->belongsTo('App\Model\KategoriKaset', 'kategori_kaset_id', 'id');
    }

    public function rak(){
        return $this->belongsTo('App\Model\Rak', 'rak_id', 'id');
    }

    public function kategori_films()
    {
        return $this->belongsToMany('App\Model\KategoriFilm', 'kaset_kategori_film', 'kaset_id', 'kategori_film_id')->withPivot('kaset_id', 'kategori_film_id');
    }

    public function detail_penyewaans()
    {
        return $this->hasMany('App\Model\DetailPenyewaan', 'kaset_id', 'id');
    }

    public function detail_booking_penyewaans()
    {
        return $this->hasMany('App\Model\DetailBookingPenyewaan', 'kaset_id', 'id');
    }

}
