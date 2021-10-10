<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
class adminRegisterController extends Controller
{
    public function Register(Request $res){
        $val = Validator::make($res->all() , [
           'name'=>'required|string|max:200',
           'email'=>'required|email',
           'password'=>'required', 
        ]);
        if($val->fails()){
            return response()->json($val->errors());
        }
        admin::create([
            'email'=>$res->email,
            'name'=>$res->name,
            'password'=>bcrypt($res->password),
        ]);
        $user = admin::first();
        $token = JWTAuth::fromUser($user);
        return Response::json( compact('token'));
    }
}
