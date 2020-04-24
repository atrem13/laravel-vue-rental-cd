<?php

namespace App\Http\Controllers;

use App\Model\DetailBookingPenyewaan;
use App\Model\DetailPenyewaan;
use App\Model\Penyewaan;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index($id)
    {
        $pengembalians = DetailPenyewaan::where('penyewaan_id', $id)->with(['kaset', 'penyewaan'])->get();

        if($pengembalians){
            return response()->json([
                'success'=>true,
                'message'=>'list barang yang harus dikembalikan',
                'pengembalians'=>$pengembalians,
                'penyewaan'=>$pengembalians[0]->penyewaan,
                'member'=>$pengembalians[0]->penyewaan->member
            ], 200);
        }else{
            return response()->json([
                'success'=>true,
                'message'=>'list barang yang harus dikembalikan',
                'pengembalians'=>'',
                'penyewaan'=>'',
                'member'=>''
            ], 500);
        }
    }
    public function konfirm(Request $request)
    {
        $penyewaan = Penyewaan::findOrfail($request->id)->update([
            'status'=>1,
            'denda'=>$request->denda
        ]);
        if($penyewaan){
            $detail_penyewaans = DetailPenyewaan::where('penyewaan_id', $request->id)->get();
            foreach($detail_penyewaans as $item){
                $detail_booking_penyewaan = DetailBookingPenyewaan::where('kaset_id', $item->kaset_id)->first();
                if($detail_booking_penyewaan){
                    $detail_booking_penyewaan->update(['status'=>1]);
                    $detail_booking_penyewaan->booking_penyewaan()->update(['status'=>1]);
                }
            }
            return response()->json([
                'success'=>true,
                'message'=>'kaset berhasil dikembalikan'
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'kaset gagal dikembalikan',
            ], 500);
        }
    }

}
