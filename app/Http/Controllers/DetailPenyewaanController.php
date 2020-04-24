<?php

namespace App\Http\Controllers;

use App\Model\DetailPenyewaan;
use App\Model\Kaset;
use App\Model\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
                'penyewaan_id'=>'required',
                'kaset_id'=>'required',
                'dp'=>'required',
                'sisa_pembayaran'=>'required'
            ],
            [
                'penyewaan_id.required'=>'penyewaan tak valid',
                'kaset_id.required'=>'pilih kaset',
                'dp.required'=>'kalkulasi dp salah',
                'sisa_pembayaran.required'=>'kalkulasi sisa pembayaran salah'
            ]
        );
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $detail_penyewaan = DetailPenyewaan::create($request->all());
            if($detail_penyewaan){
                $detail_penyewaan = $detail_penyewaan::whereId($detail_penyewaan->id)->with('kaset')->first();
                $penyewaan = Penyewaan::findOrfail($request->penyewaan_id)->increment('total_dp', $request->dp);
                $penyewaan = Penyewaan::findOrfail($request->penyewaan_id)->increment('total_sisa_pembayaran', $request->sisa_pembayaran);
                $kaset = Kaset::findOrfail($request->kaset_id)->decrement('jumlah');
                return response()->json([
                    'success'=>true,
                    'message'=>'detail penyewaan berhasil diinput',
                    'data'=>$detail_penyewaan
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'detail penyewaan gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\DetailPenyewaan  $detailPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_penyewaans = DetailPenyewaan::where('penyewaan_id', $id)->with('kaset')->get();
        return response()->json([
            'success'=>true,
            'message'=>'list detail penyewaan',
            'data'=>$detail_penyewaans
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\DetailPenyewaan  $detailPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($request->penyewaan_id)->decrement('total_dp', $request->dp);
        $penyewaan = Penyewaan::findOrFail($request->penyewaan_id)->decrement('total_sisa_pembayaran', $request->sisa_pembayaran);
        $kaset = Kaset::findOrfail($request->kaset_id)->increment('jumlah');
        $kaset = Kaset::whereId($request->kaset_id)->first();
        $detail_penyewaan = DetailPenyewaan::findOrfail($id)->delete();
            if($detail_penyewaan){
                return response()->json([
                    'success'=>true,
                    'message'=>'detail penyewaan berhasil dihapus',
                    'data'=>$kaset
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'detail penyewaan gagal dihapus'
                ], 500);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\DetailPenyewaan  $detailPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return response()->json([
            'success'=>true,
            'message'=>'detail penyewaan berhasil dihapus',
            'data'=>$request->all()
        ], 200);
        // $penyewaan = Penyewaan::findOrFail($request->penyewaan_id)->decrement('total_dp', $request->dp);
        // $penyewaan = Penyewaan::findOrFail($request->penyewaan_id)->decrement('total_sisa_pembayaran', $request->sisa_pembayaran);
        // $kaset = Kaset::whereId($request->kaset_id)->first();
        // $detail_penyewaan = DetailPenyewaan::findOrfail($id)->delete();
        //     if($detail_penyewaan){
        //         return response()->json([
        //             'success'=>true,
        //             'message'=>'detail penyewaan berhasil dihapus',
        //             'data'=>$kaset
        //         ], 200);
        //     }else{
        //         return response()->json([
        //             'success'=>false,
        //             'message'=>'detail penyewaan gagal dihapus'
        //         ], 500);
        //     }
    }
}
