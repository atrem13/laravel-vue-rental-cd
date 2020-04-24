<?php

namespace App\Http\Controllers;

use App\Model\BookingPenyewaan;
use App\Model\DetailBookingPenyewaan;
use App\Model\Kaset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailBookingPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'kaset_id'=>'required'
            ],
            [
                'kaset_id.required'=>'pilih kaset'
            ]
        );

        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $detail_booking_penyewaan = DetailBookingPenyewaan::create($request->all());
            if($detail_booking_penyewaan){
                if($request->status == 1){
                    BookingPenyewaan::findOrfail($request->booking_penyewaan_id)->update(['status'=>1]);
                }
                $detail_booking_penyewaan = DetailBookingPenyewaan::whereId($detail_booking_penyewaan->id)->with('kaset')->first();
                return response()->json([
                    'success'=>true,
                    'message'=>'detail booking penyewaan berhasil diinput',
                    'data'=>$detail_booking_penyewaan
                ],200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'detail booking penyewaan gagal diinput',
                    'data'=>''
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\DetailBookingPenyewaan  $detailBookingPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_booking_penyewaans = DetailBookingPenyewaan::where('booking_penyewaan_id', $id)->with(['kaset', 'booking_penyewaan'])->get();
        return response()->json([
            'status'=>true,
            'message'=>'list detail booking penyewaan',
            'data'=>$detail_booking_penyewaans
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\DetailBookingPenyewaan  $detailBookingPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $detail_booking_penyewaan = DetailBookingPenyewaan::findOrfail($id)->update([
        //     'status'=>1
        //     ]);
        // if($detail_booking_penyewaan){
        //     return response()->json([
        //         'success'=>true,
        //         'message'=>'detail booking penyewaan berhasil diupdate'
        //     ], 200);
        // }else{
        //     return response()->json([
        //         'success'=>false,
        //         'message'=>'detail booking penyewaan gagal diupdate'
        //     ], 500);
        // }
        $detail_booking_penyewaan = DetailBookingPenyewaan::whereId($id)->first();
        $booking_penyewaan_id = $detail_booking_penyewaan->booking_penyewaan_id;
        $detail_booking_penyewaan->delete();
        $booking_penyewaan = DetailBookingPenyewaan::where('booking_penyewaan_id', $detail_booking_penyewaan->booking_penyewaan_id)->where('status', 1)->first();
        if(!$booking_penyewaan){
            BookingPenyewaan::findOrfail($detail_booking_penyewaan->booking_penyewaan_id)->update(['status'=>0]);
        }
        if($detail_booking_penyewaan){
            $kaset = Kaset::whereId($request->kaset_id)->first();
            return response()->json([
                'success'=>true,
                'message'=>'detail booking penyewaan berhasil dihapus',
                'data'=>$kaset
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'detail booking penyewaan gagal dihapus'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\DetailBookingPenyewaan  $detailBookingPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail_booking_penyewaan = DetailBookingPenyewaan::findOrfail($id)->update(['status'=>2]);
        if($detail_booking_penyewaan){
            $detail_booking_penyewaan = DetailBookingPenyewaan::whereId($id)->with(['kaset', 'booking_penyewaan'])->first();
            return response()->json([
                'success'=>true,
                'message'=>'detail booking penyewaan berhasil diupdate',
                'data'=>$detail_booking_penyewaan
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'detail booking penyewaan gagal diupdate'
            ], 500);
        }

    }
}
