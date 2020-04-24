<?php

namespace App\Http\Controllers;

use App\Model\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = Distributor::all();
        return response()->json([
            'success'=>true,
            'messages'=>'list distributor',
            'data'=>$distributors
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
            'nama'=>'required',
            'notelp'=>'required|numeric',
            'alamat'=>'required'
        ],[
            'nama.required'=>'masukan nama',
            'notelp.required'=>'masukan nomor telepon',
            'notelp.numeric'=>'nomor telepon harus berupa angka',
            'alamat.required'=>'masukan alamat'
        ]);
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $distributor = Distributor::create($request->all());
            if($distributor){
                return response()->json([
                    'success'=>true,
                    'message'=>'distributor berhasil diinput'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'distributor gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distributor = Distributor::whereId($id)->first();
        if($distributor){
            return response()->json([
                'success'=>true,
                'message'=>'detail distributor',
                'data'=>$distributor
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
     * @param  \App\Model\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'nama'=>'required',
            'notelp'=>'required|numeric',
            'alamat'=>'required'
        ],[
            'nama.required'=>'masukan nama',
            'notelp.required'=>'masukan nomor telepon',
            'notelp.numeric'=>'nomor telepon harus berupa angka',
            'alamat.required'=>'masukan alamat'
        ]);
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $distributor = Distributor::findOrfail($id)->update($request->all());
            if($distributor){
                return response()->json([
                    'success'=>true,
                    'message'=>'distributor berhasil diupdate'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'distributor gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distributor = Distributor::findOrfail($id)->delete();
        if($distributor){
            return response()->json([
                'success'=>true,
                'message'=>'distributor berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'distributor gagal dihapus'
            ], 500);
        }
    }
}
