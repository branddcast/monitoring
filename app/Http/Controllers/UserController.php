<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function agregarUsuario(Request $request)
    {
    	$input = $request->all();

    	//Verificar que no haya un email igual registrado
    	$existeEmail = User::where('email', $input['email'])->first();

    	if(isset($existeEmail)){
            return response()->json(array('mensaje' => 'Ya hay un usuario registrado con ese correo electrónico', 'status' => 0));
        }

    	$usuario = new User;
    	$usuario->name = $input['nombre'];
    	$usuario->email =  $input['email'];
    	$usuario->rol = 2;
    	$usuario->password = Hash::make($input['password']);

    	if(!$usuario->save())
    		return response()->json(["mensaje" => "Ocurrió un problema mientras se guardaba el usuario.", "status" => 0]);

        return response()->json(["mensaje" => "El usuario se guardó exitosamente.", "status" => 1]);
    }
}
