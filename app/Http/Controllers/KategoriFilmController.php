<?php

namespace App\Http\Controllers;

use App\Model\KategoriFilm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriFilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_films = KategoriFilm::all();
        return response()->json([
            'success'=>true,
            'message'=>'list kategori film',
            'data'=>$kategori_films
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
            $kategori_film = KategoriFilm::create($request->all());
            if($kategori_film){
                return response()->json([
                    'success'=>true,
                    'message'=>'kategori film berhasil diinput'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'kategori film gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\KategoriFilm  $kategoriFilm
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori_film = KategoriFilm::whereId($id)->first();
        if($kategori_film){
            return response()->json([
                'success'=>true,
                'message'=>'detail kategori film',
                'data'=>$kategori_film
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
     * @param  \App\Model\KategoriFilm  $kategoriFilm
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
            $kategori_film = KategoriFilm::findOrFail($id)->update($request->all());
            if($kategori_film){
                return response()->json([
                    'success'=>true,
                    'message'=>'kategori film berhasil diupdate'
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'kategori filrm gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\KategoriFilm  $kategoriFilm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori_film = KategoriFilm::findOrfail($id)->delete();
        if($kategori_film){
            return response()->json([
                'success'=>true,
                'message'=>'kategori film berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'kategori film gagal dihapus'
            ], 500);
        }
    }
}
