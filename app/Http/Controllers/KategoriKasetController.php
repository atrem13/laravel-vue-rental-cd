<?php

namespace App\Http\Controllers;

use App\Model\KategoriKaset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriKasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_kasets = KategoriKaset::all();
        return response()->json([
            'success'=>true,
            'message'=>'list kategori kaset',
            'data'=>$kategori_kasets
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
            $kategori_kaset = KategoriKaset::create($request->all());
            if($kategori_kaset){
                return response()->json([
                    'success'=>true,
                    'message'=>'kategori kaset berhasil diinput'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'kategori kaset gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\KategoriKaset  $kategoriKaset
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori_kaset = KategoriKaset::whereId($id)->first();
        if($kategori_kaset){
            return response()->json([
                'success'=>true,
                'message'=>'detail kategori kaset',
                'data'=>$kategori_kaset
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
     * @param  \App\Model\KategoriKaset  $kategoriKaset
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
            $kategori_kaset = KategoriKaset::findOrFail($id)->update($request->all());
            if($kategori_kaset){
                return response()->json([
                    'success'=>true,
                    'message'=>'kategori kaset berhasil diupdate'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'kategori kaset gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\KategoriKaset  $kategoriKaset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori_kaset = KategoriKaset::findOrfail($id)->delete();
        if($kategori_kaset){
            return response()->json([
                'success'=>true,
                'message'=>'kategori kaset berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'kategori kaset gagal dihapus'
            ], 500);
        }
    }
}
