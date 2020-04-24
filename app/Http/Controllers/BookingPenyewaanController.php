<?php

namespace App\Http\Controllers;

use App\Model\BookingPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_penyewaans = BookingPenyewaan::with('member')->get();
        return response()->json([
            'success'=>true,
            'message'=>'list booking penyewaan',
            'data'=>$booking_penyewaans
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
        $validation = Validator::make($request->all(),[
                'member_id'=>'required',
                'no_booking'=>'required',
                'tanggal_booking'=>'required'
            ],
            [
                'member_id.required'=>'pilih member ',
                'no_booking.required'=>'input salah',
                'tanggal_booking.required'=>'masukan tanggal booking'
            ]
        );

        if($validation->fails()){
            return response()->json([
                'sucess'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $booking_penyewaan = BookingPenyewaan::create($request->all());
            if($booking_penyewaan){
                return response()->json([
                    'sucess'=>true,
                    'message'=>'booking penyewaan berhasil diinput',
                    'data'=>$booking_penyewaan->id
                ], 200);
            }else{
                return response()->json([
                    'sucess'=>false,
                    'message'=>'booking penyewaan gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BookingPenyewaan  $bookingPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking_penyewaan = BookingPenyewaan::whereId($id)->with('member')->first();
        if($booking_penyewaan){
            return response()->json([
                'sucess'=>true,
                'message'=>'detail booking penyewaan',
                'data'=>$booking_penyewaan
            ], 200);
        }else{
            return response()->json([
                'sucess'=>false,
                'message'=>'data tidak ditemukan',
                'data'=>''
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BookingPenyewaan  $bookingPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
                'tanggal_booking'=>'required'
            ],
            [
                'tanggal_booking.required'=>'masukan tanggal booking'
            ]
        );

        if($validation->fails()){
            return response()->json([
                'sucess'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $booking_penyewaan = BookingPenyewaan::findOrfail($id)->update($request->only(['tanggal_booking']));
            if($booking_penyewaan){
                return response()->json([
                    'sucess'=>true,
                    'message'=>'booking penyewaan berhasil diupdate'
                ], 200);
            }else{
                return response()->json([
                    'sucess'=>false,
                    'message'=>'booking penyewaan gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BookingPenyewaan  $bookingPenyewaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking_penyewaan = BookingPenyewaan::findOrfail($id)->delete();
        if($booking_penyewaan){
            return response()->json([
                'sucess'=>true,
                'message'=>'booking penyewaan berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'sucess'=>false,
                'message'=>'booking penyewaan gagal dihapus'
            ], 500);
        }
    }
}
