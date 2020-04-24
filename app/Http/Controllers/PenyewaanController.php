<?php

namespace App\Http\Controllers;

use App\Model\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyewaans = Penyewaan::with('member')->get();
        return response()->json([
            'success'=>true,
            'message'=>'list penyewaan',
            'data'=>$penyewaans
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
                'tanggal_sewa'=>'required',
                'tanggal_kembali'=>'required'
            ],
            [
                'member_id.required'=>'pilih member',
                'tanggal_sewa'=>'masukan tanggal sewa',
                'tanggal_kembali'=>'masukan tanggal kembali'
            ]
        );
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors
            ], 400);
        }else{
            $penyewaan = Penyewaan::create($request->all());
            if($penyewaan){
                return response()->json([
                    'success'=>true,
                    'message'=>'penyewaan berhasil dibuat',
                    'data'=>$penyewaan->id
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'penyewaan gagal dibuat'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penyewaan = Penyewaan::with('member')->whereId($id)->first();
        if($penyewaan){
            return response()->json([
                'success'=>true,
                'message'=>'detail penyewaan',
                'data'=>$penyewaan
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'data tidak ditemukan',
                'data'=>''
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->only(['tanggal_sewa', 'tanggal_kembali']),[
                'tanggal_sewa'=>'required',
                'tanggal_kembali'=>'required'
            ],
            [
                'tanggal_sewa'=>'masukan tanggal sewa',
                'tanggal_kembali'=>'masukan tanggal kembali'
            ]
        );
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors
            ], 400);
        }else{
            $penyewaan = Penyewaan::findOrFail($id)->update($request->only(['tanggal_sewa', 'tanggal_kembali']));
            if($penyewaan){
                return response()->json([
                    'success'=>true,
                    'message'=>'penyewaan berhasil diupdate'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'penyewaan gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyewaan = Penyewaan::whereId($id)->first();
        $penyewaan->detail_penyewaans()->delete();
        if($penyewaan){
            $penyewaan = Penyewaan::findOrFail($id)->delete();
            if($penyewaan){
                return response()->json([
                    'success'=>true,
                    'message'=>'penyewaan berhasil dihapus'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'penyewaan gagal dihapus'
                ], 500);
            }
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'penyewaan gagal dihapus'
            ], 500);
        }
    }
}
