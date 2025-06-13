<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function storeToken (Request $request)
    {
        // Se almacena el token en la sesion de PHP
        $request -> session() -> put('api_token', $request -> input('token'));

        // Se almacena el ID del usuario en la sesion de PHP
        $request -> session() -> put('api_userID', $request -> input('user_id'));

        return response() -> json(['message' => 'Token and User ID Stored']);
    }
}
