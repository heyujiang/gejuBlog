<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','refresh']]);
    }

    public function login()
    {
        $credentials = request(['name','password']);

        $customClaims = ['name'=>$credentials['name']];   //设置载荷 claims

        if(! $token = auth('api')->claims($customClaims)->attempt($credentials)){
            return response()->json(['error'=>'Unauthorized'],401);
        }

        return $this->respondWithToken($token);
    }

    public function me(){
        return response()->json(auth('api')->user());
    }

    public function logout(){

//        auth('api')->logout();

        $token = auth('api')->getToken()->get();
        $result = auth('api')->invalidate();

//        JWTAuth::parseToken()->logout();
        return response()->json(['message'=>'Successfully logged out',''=>$result]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    public function respondWithToken($token)
    {
        return response()->json([
           'access_token' => $token,
           'token_type'   => 'bearer',
           'expires_in'   => auth('api')->factory()->getTTL()*1
        ]);
    }
}
