<?php

namespace App\Http\Controllers;

use App\Model\BookingPenyewaanTersedia;
use App\Model\DetailBookingPenyewaan;
use Illuminate\Http\Request;

class BookingPenyewaanTersediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_penyewaan_tersedias = DetailBookingPenyewaan::whereHas('booking_penyewaan_tersedia')->with(['booking_penyewaan', 'booking_penyewaan_tersedia', 'kaset'])->get();
        return response()->json([
            'success'=>true,
            'message'=>'list booking penyewaan tersedia',
            'data'=>$booking_penyewaan_tersedias
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking_penyewaan_tersedia = BookingPenyewaanTersedia::create($request->all());
        if($booking_penyewaan_tersedia){
            return response()->json([
                'success'=>true,
                'message'=>'berhasil konfirm booking penyewaan tersedia'
            ], 200);
        }else{
            return response()->json([
                'success'=>true,
                'message'=>'gagal konfirm booking penyewaan tersedia'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BookingPenyewaanTersedia  $bookingPenyewaanTersedia
     * @return \Illuminate\Http\Response
     */
    public function show(BookingPenyewaanTersedia $bookingPenyewaanTersedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BookingPenyewaanTersedia  $bookingPenyewaanTersedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking_penyewaan_tersedia = BookingPenyewaanTersedia::findOrfail($id)->update(['status'=>2]);
        if($booking_penyewaan_tersedia){
            $booking_penyewaan_tersedia = DetailBookingPenyewaan::whereId($request->detail_booking_penyewaan_id)->with(['booking_penyewaan', 'booking_penyewaan_tersedia', 'kaset'])->first();
            return response()->json([
                'success'=>true,
                'message'=>'berhasil konfirm booking penyewaan tersedia',
                'data'=>$booking_penyewaan_tersedia
            ], 200);
        }else{
            return response()->json([
                'success'=>true,
                'message'=>'gagal konfirm booking penyewaan tersedia'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BookingPenyewaanTersedia  $bookingPenyewaanTersedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingPenyewaanTersedia $bookingPenyewaanTersedia)
    {
        //
    }
}
