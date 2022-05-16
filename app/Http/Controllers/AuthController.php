<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        public function login()
        {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Erro ao logar'], 401);
        }else {
            print("Usuário logado com Sucesso");
        }

        return $this->respondWithToken($token);
        }

    protected function respondWithToken($token)
    {
        return response()->json([
            
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
