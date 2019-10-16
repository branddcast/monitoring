<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

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

    public function getAll(){
        $users = User::orderBy('created_at', 'DESC')->get();

        $admin = User::where('id', \Auth::id())->first();

        $response = array();

        //Hacer que muestre el nombre del rol y no el id Rol
        //dd([$users[0]->rol_user->Nombre, $users[2]->rol_user->Nombre]);exit;

        foreach ($users as $row) {
            $output = array();

            $output['nombre'] = ($row->name == null) ? 'Usuario no registrado' : $row->name;
            $output['email'] = $row->email;
            $output['rol'] = $row->rol_user->Nombre;
            $output['huella'] = ($row->id_huella == 0) ? '<span class="text-danger">Sin Huella</span>' : '<span class="text-success">Huella Registrada</span>';
            $output['fecha'] = $row->created_at->format('d-m-Y');
            $output['acciones'] = ($admin->rol == 1) ? '<i class="fas fa-times mr-3" style="font-size: 12pt;"></i> <i class="fas fa-pencil-alt" style="font-size: 12pt;"></i>' : '-';

            $response[] = $output;
        }

        return response()->json($response);
    }

    public function auth_user(Request $request){
        $input = $request->all();

        $user = User::find($input['usuario']);

        if (Hash::check($input['password'], $user->password)) {
            return response()->json(['auth' => 1]);
        }else{
            return response()->json(['auth' => 0]);
        }
    }
}
