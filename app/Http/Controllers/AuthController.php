<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
        */

        public function login(Request $request) {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            throw new HttpResponseException(response()->json(['Usuário ou senha incorreta'], 400));
            }else{
            $user = JWTAuth::fromUser(Auth::user());
            return response()->json($user);
            print("Usuário logado");
        }
    }    
}
