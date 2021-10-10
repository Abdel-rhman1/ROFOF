<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\vendor;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
class vendorRegisterController extends Controller
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
        vendor::create([
            'email'=>$res->email,
            'name'=>$res->name,
            'password'=>bcrypt($res->password),
        ]);
        $user = vendor::first();
        $token = JWTAuth::fromUser($user);
        return Response::json( compact('token'));
    }
}
