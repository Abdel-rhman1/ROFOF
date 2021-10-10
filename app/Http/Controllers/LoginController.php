<?php
namespace App\Http\Controllers;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request -> all(),[
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator -> fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email','password');
        try{
            if (!$token = Auth('api')->setTTL(60)->attempt($credentials)) {
                //return $token;
                return response()->json( ['error'=> 'invalid username and password'],401);
            }
        }catch(JWTException $e){
          return response()->json( ['error'=> 'could not create token'],500);
        }
        return response()->json( compact('token'));        
    }
}
