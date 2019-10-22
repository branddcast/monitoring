<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hash;
use App\Models\Bitacora;
use App\User;
use Carbon\Carbon;

class BitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' , 
            ['except' => ['validar_hash']]
        );
    }
    
    public function index(){
    	return view('bitacora');
    }

    public function ultimos_registros(){
    	$ultimos_registros = Bitacora::orderBy('created_at','desc')->limit(10)->get();

    	$response = array();

    	foreach ($ultimos_registros as $row) {
    		$output = array();

    		$output['usuario'] = ($row->usuario == null) ? 'Usuario no registrado' : $row->user->name;
    		$output['proceso'] = $row->proceso;
    		$output['intentos'] = $row->intentos;
    		$output['estado'] = $row->estado;
    		$output['fecha'] = $row->created_at->format('d-m-Y H:i:s');

    		$response[] = $output;
    	}

    	return response()->json($response);
    }

    public function validar_hash(Request $request){
    	$input = $request->all();

        if($input['key'] <= 0){
            return response()->json(array('mensaje' => 'Id no aceptado', 'estado' => 0));
        }

        $user = User::where([
            ['id_huella', $input['key']],
            ['activo', 1]
        ])->get();

    	if($input['intentos'] <= 5){
	    	//$hash = Hash::where('hash', sha1($input['key']))->get();

	    	$total = $user->count();

	    	if($total == 0){
	    		return response()->json(array('mensaje' => 'Id no aceptado. Verifique que la huella este registrada.', 'estado' => 0));
	    	}
	    }

    	$registro_nuevo = new Bitacora;

    	$registro_nuevo->usuario = $user[0]->id;
    	$registro_nuevo->proceso = 'Inicio de Sesión';
    	$registro_nuevo->intentos = $input['intentos'];
    	$registro_nuevo->estado = ($input['intentos'] <= 5) ? 'Sesión Permitida' : 'Sesión Bloqueada';
    	$registro_nuevo->created_at = Carbon::now();

    	if($registro_nuevo->save() == false){
    		return response()->json(array('mensaje' => 'Error al intentar validar el Id. Intente de nuevo', 'estado' => 2));
    	}

    	return response()->json(array('mensaje' => 'Autenticación generada correctamente', 'estado' => 1));
    }

}
