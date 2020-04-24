<?php

namespace App\Http\Controllers;

use App\Model\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raks = Rak::all();
        return response()->json([
            'success'=>true,
            'message'=>'list rak',
            'data'=>$raks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama'=>'required'
        ],
        [
            'nama.required'=>'masukan nama'
        ]);
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $rak = Rak::create($request->all());
            if($rak){
                return response()->json([
                    'success'=>true,
                    'message'=>'rak berhasil diinput'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'rak gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rak = Rak::whereId($id)->first();
        if($rak){
            return response()->json([
                'success'=>true,
                'message'=>'detail rak',
                'data'=>$rak
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'data tidak ditemukan',
                'data'=>''
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'nama'=>'required'
        ],
        [
            'nama.required'=>'masukan nama'
        ]);
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $rak = Rak::findOrFail($id)->update($request->all());
            if($rak){
                return response()->json([
                    'success'=>true,
                    'message'=>'rak berhasil diupdate'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'rak gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rak = Rak::findOrfail($id)->delete();
        if($rak){
            return response()->json([
                'success'=>true,
                'message'=>'rak berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'rak gagal dihapus'
            ], 500);
        }
    }
}
