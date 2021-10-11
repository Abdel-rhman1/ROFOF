<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
class RegisterController extends Controller
{
    public function Register(Request $res){
        $val = Validator::make($res->all() , [
           'name'=>'required|string|max:200',
           'email'=>'required|email|unique:users',
           'password'=>'required', 
        ]);
        if($val->fails()){
            return response()->json($val->errors());
        }
        User::create([
            'email'=>$res->email,
            'name'=>$res->name,
            'password'=>bcrypt($res->password),
        ]);
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        
        return Response::json( compact('token'));
    }
}
