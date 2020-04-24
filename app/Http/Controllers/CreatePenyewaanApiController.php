<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;

class CreatePenyewaanApiController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return response()->json([
            'success'=>true,
            'message'=>'list member',
            'data'=>$members
        ], 200);
    }
}
