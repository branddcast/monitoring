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
    	$usuario->rol = ($input['rol'] != null) ? $input['rol'] : 2;
    	$usuario->password = Hash::make($input['password']);

    	if(!$usuario->save())
    		return response()->json(["mensaje" => "Ocurrió un problema mientras se guardaba el usuario.", "status" => 0]);

        return response()->json(["mensaje" => "El usuario se guardó exitosamente.", "status" => 1]);
    }

    public function updateUser(Request $request){
        $input = $request->all();

        $user = User::where([
            ['id', $input['id']],
            ['activo', 1]
        ])->first();

        if(empty($user->id)){
            return response()->json(array('mensaje' => 'El usuario que intenta actualizar no existe.', 'status' => 0));
        }

        //Verificar que no haya un email igual registrado
        $existeEmail = User::where([
            ['email', $input['email']]
        ])->first();


        if(isset($existeEmail) && $existeEmail->id != $input['id']){
            return response()->json(array('mensaje' => 'Ya hay un usuario registrado con ese correo electrónico', 'status' => 0));
        }


        $user->name = $input['nombre'];
        $user->email = $input['email'];
        if(isset($input['rol'])){
            $user->rol = $input['rol'];
        }
        if($input['password'] != '' || $input['password'] != null){
            $user->password = Hash::make($input['password']);
        }

        if($user->save()){
            return response()->json(array('mensaje' => 'El usuario ha sido actualizado correctamente.', 'status' => 1));
        }
    }

    public function getAll(){
        $users = User::where('activo', 1)->orderBy('created_at', 'DESC')->get();

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
            $output['acciones'] = ($admin->rol == 1) ? '<i class="fas fa-pencil-alt text-info mr-3" style="font-size: 12pt; cursor:pointer" onclick="javascript:updateUser('.$row->id.')"></i> <i class="fas fa-times text-danger" style="font-size: 12pt; cursor:pointer" onclick="javascript:deleteUser('.$row->id.')"></i>' : '-';

            $response[] = $output;
        }

        return response()->json($response);
    }

    public function getUser($id){
        $user = User::where([
            ['id', $id],
            ['activo', 1]
        ])->first();

        if(!isset($user->id)){
            return response()->json(array('mensaje' => 'Usuario no encontrado', 'status' => 0));
        }

        $response = array(
            'nombre' => $user->name,
            'email' => $user->email,
            'rol' => $user->rol,
            'mensaje' => '',
            'id' => $user->id,
            'status' => 1,
            'disabled' => ($user->email == 'admin@demo.com') ? 1 : 0,
        );

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

    public function deleteUser(Request $request){
        $input = $request->all();

        $user = User::find($input['id']);

        if($user->email == 'admin@demo.com'){
            return response()->json(["mensaje" => "No puedes eliminar la cuenta de Super Administrador", "status" => 0]);
        }

        $user->activo = 0;

        if($user->save())
            return response()->json(["mensaje" => "Usuario eliminado correctamente", "status" => 1]);

        return response()->json(["mensaje" => "Ocurrió un problema al intentar eliminar al usuario", "status" => 0]);
    }

    public function huella_usuario($usuario)
    {
        $user = User::where([
            ['email', $usuario],
            ['activo', 1]
        ])->first();

        if(!isset($user->id)){
            return response()->json(array('mensaje' => 'Usuario no encontrado', 'fail' => 1));
        }

        $response = array(
            'nombre' => $user->name,
            'email' => $user->email,
            'rol' => $user->rol_user->Nombre,
            'mensaje' => '',
            'id' => $user->id,
            'status' => ($user->id_huella != 0 )? 1: 0,
            'huella' => ($user->id_huella != 0 )? "Huella Registrada": "Huella Sin registrar",
            'fail' => 0
        );

        return response()->json($response);
    }

    public function huella_eliminar(Request $request){
        $input = $request->all();

        $user = User::find($input['usuario']);

        $user->id_huella = 0;

        if ($user->save()) {
            return response()->json(["mensaje" => "Huella Eliminada correctamente", "status" => 1]);
        }else{
            return response()->json(["mensaje" => "Error al eliminar la huella", "status" => 0]);
        }
    }
}
