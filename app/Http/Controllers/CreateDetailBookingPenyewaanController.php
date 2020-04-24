<?php

namespace App\Http\Controllers;

use App\Model\Kaset;
use Illuminate\Http\Request;

class CreateDetailBookingPenyewaanController extends Controller
{
    public function index($id)
    {
        $kasets = Kaset::whereDoesntHave('detail_booking_penyewaans', function($query) use ($id){
            $query->where('booking_penyewaan_id', '=',  $id);
        })->get();
        return response()->json([
            'success'=>true,
            'message'=>'list kaset',
            'data'=>$kasets
        ], 200);
    }
}
