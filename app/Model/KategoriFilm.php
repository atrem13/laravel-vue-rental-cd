<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategoriFilm extends Model
{
    protected $guarded =[];
    public $timestamps = false;

    public function kasets(){
        return $this->belongsToMany('App\Model\Kaset', 'kaset_kategori_film', 'kaset_id', 'kategori_film_id');
    }
}
