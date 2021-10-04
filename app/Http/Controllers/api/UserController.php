<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){

    }

    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();
            $resArr = [];
            $resArr['token'] = $user->createToken('api-application')->accessToken;
            return response()->json($resArr, 200);
        }
        else{
            return response()->json(['error'=>'Unauthorized Access']);
        }
    }

    public function edit(Requst $request){

    }

    public function create(Request $request){

    }

    public function delete(Request $request){

    }
}
