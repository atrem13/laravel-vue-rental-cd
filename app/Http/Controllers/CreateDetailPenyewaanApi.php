<?php

namespace App\Http\Controllers;
use App\Model\Kaset;
use Illuminate\Http\Request;

class CreateDetailPenyewaanApi extends Controller
{
    public function index($id)
    {
        $kasets = Kaset::WhereDoesntHave('detail_penyewaans', function($query) use ($id){
            $query->where('penyewaan_id', '=', $id);
        })->get();
        return response()->json([
            'success'=>true,
            'message'=>'list kaset',
            'data'=>$kasets
        ], 200);
    }
}
