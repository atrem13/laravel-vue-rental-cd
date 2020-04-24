<?php

namespace App\Http\Controllers;

use App\Model\Distributor;
use App\Model\KategoriKaset;
use App\Model\Rak;
use App\Model\KategoriFilm;

use Illuminate\Http\Request;

class CreateKasetApiController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        $kategori_kasets = KategoriKaset::all();
        $kategori_films = KategoriFilm::all();
        $raks = Rak::all();

        return response()->json([
            'success'=>true,
            'message'=>'list keperluan kaset',
            'data'=>[
                'distributors'=>$distributors,
                'kategori_kasets'=>$kategori_kasets,
                'kategori_films'=>$kategori_films,
                'raks'=>$raks
            ]
        ]);
    }
}
