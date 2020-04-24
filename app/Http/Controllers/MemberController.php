<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return response()->json([
            'success'=>true,
            'message'=>'list member',
            'data'=>$members
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
        $validator = Validator::make($request->all(),[
            'nik'=>'required|numeric',
            'nama'=>'required',
            'notelp'=>'required',
            'alamat'=>'required'
        ],
        [
            'nik.required'=>'masukan nik',
            'nik.numeric'=>'nik harus berupa angka',
            'nama.required'=>'masukan nama',
            'notelp.required'=>'masukan notelp',
            'alamat.required'=>'masukan alamat'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validator->errors()
            ], 400);
        }else{
            $member = Member::create($request->all());
            if($member){
                return response()->json([
                    'success'=>true,
                    'message'=>'member berhasil diinput',
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'member gagal diinput'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::whereId($id)->first();
        if($member){
            return response()->json([
                'success'=>true,
                'message'=>'detail member',
                'data'=>$member
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
     * @param  \App\Model\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nik'=>'required',
            'nama'=>'required',
            'notelp'=>'required',
            'alamat'=>'required'
        ],
        [
            'nik.required'=>'masukan nik',
            'nama.required'=>'masukan nama',
            'notelp.required'=>'masukan notelp',
            'alamat.required'=>'masukan alamat'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'input data salah',
                'data'=>$validator->errors()
            ], 400);
        }else{
            $member = Member::findOrfail($id)->update($request->all());
            if($member){
                return response()->json([
                    'success'=>true,
                    'message'=>'member berhasil diupdate',
                ], 200);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'member gagal diupdate'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrfail($id)->delete();
        if($member){
            return response()->json([
                'success'=>true,
                'message'=>'member berhasil dihapus'
            ], 200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'member gagal dihapus'
            ], 500);
        }
    }
}
