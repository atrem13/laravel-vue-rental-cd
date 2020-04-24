<?php

namespace App\Http\Controllers;

use App\Model\Kaset;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kaset = Kaset::whereId(1)->first();
        // $data=[];
        // foreach ($kaset->kategori_films as $key => $value){
        //     $data[$key] = $value;
        // }
        // dd($data);
        // return view('test');
        $kasets = Kaset::with(['kategori_films', 'distributor', 'kategori_kaset', 'rak'])->get();
        return response()->json([
            'success'=>true,
            'message'=>'list kaset',
            'data'=>$kasets
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
        // $input[] = [8,9];
        // $kaset = Kaset::whereId(1)->first();
        // foreach($input as $item){
        //     $kaset->kategori_films()->sync($item, false);
        // }
        // $kaset->kategori_films()->getRelatedIds();
        // dd($kaset);
        $validation = Validator::make($request->all(),[
                'kategori_kaset_id'=>'required',
                'distributor_id'=>'required',
                'rak_id'=>'required',
                'judul'=>'required',
                'deskripsi'=>'required',
                'jumlah'=>'required',
                'harga_beli'=>'required',
                'harga_sewa'=>'required',
                'kategori_films'=>'required'
            ],
            [
                'kategori_kaset_id.required'=>'masukan kategorikaset',
                'distributor_id.required'=>'masukan distributor',
                'rak_id.required'=>'masukan rak',
                'judul.required'=>'masukan judul',
                'deskripsi.required'=>'masukan deskripsi',
                'jumlah.required'=>'masukan jumlah',
                'harga_beli.required'=>'masukan harga beli',
                'harga_sewa.required'=>'masukan harga sewa',
                'kategori_films.required'=>'masukan kategori film',
            ]
        );
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $kaset = Kaset::create($request->except(['kategori_films']));
            if($kaset){
                $kaset->kategori_films()->sync($request->kategori_films);
                return response()->json([
                    'success'=>true,
                    'message'=>'kaset berhasil diinput',
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'kaset gagal diinput',
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Kaset  $kaset
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kaset = Kaset::whereId($id)->with(['kategori_films'])->first();
        if($kaset){
            $temp = [];
            foreach($kaset->kategori_films as $item){
                array_push($temp, $item->id);
            }
            return response()->json([
                'success'=>true,
                'message'=>'detail kaset',
                'kategori_films'=>$temp,
                'data'=>$kaset
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'data tidak ditemukan',
                'data'=>''
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Kaset  $kaset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
                'kategori_kaset_id'=>'required',
                'distributor_id'=>'required',
                'rak_id'=>'required',
                'judul'=>'required',
                'deskripsi'=>'required',
                'jumlah'=>'required',
                'harga_beli'=>'required',
                'harga_sewa'=>'required',
                'kategori_films'=>'required'
            ],
            [
                'kategori_kaset_id.required'=>'masukan kategorikaset',
                'distributor_id.required'=>'masukan distributor',
                'rak_id.required'=>'masukan rak',
                'judul.required'=>'masukan judul',
                'deskripsi.required'=>'masukan deskripsi',
                'jumlah.required'=>'masukan jumlah',
                'harga_beli.required'=>'masukan harga beli',
                'harga_sewa.required'=>'masukan harga sewa',
                'kategori_films.required'=>'masukan kategori film',
            ]
        );
        if($validation->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validation->errors()
            ], 400);
        }else{
            $kaset = Kaset::whereId($id)->first();
            $kaset->kategori_films()->sync($request->kategori_films);
            if($kaset){
                $kaset = Kaset::findOrfail($id)->update($request->except(['kategori_films']));
                if($kaset){
                    return response()->json([
                        'success'=>true,
                        'message'=>'kaset berhasil diupdate',
                    ], 200);
                }else{
                    return response()->json([
                        'success'=>false,
                        'message'=>'kaset gagal diupdate',
                    ], 500);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Kaset  $kaset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kaset = Kaset::whereId($id)->first();
        $kaset->kategori_films()->detach();
        if($kaset){
            $kaset = Kaset::findOrfail($id)->delete();
            if($kaset){
                return response()->json([
                    'success'=>true,
                    'message'=>'kaset berhasil dihapus',
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'kaset gagal dihapus',
                ], 500);
            }
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'kaset gagal dihapur',
            ], 500);
        }
    }
}
