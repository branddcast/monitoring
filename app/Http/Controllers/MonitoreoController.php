<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MonitoreoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	return view('monitoreo');
    }

    public function datosGenerales(Request $request){
    	$input = $request->all();

    	$datos = DB::table('settings')->where('usuario', $input['id'])->first();

        $fecha_actual = date("d-m-Y");

        $periodo = date("d-m-Y",strtotime($fecha_actual."- 15 days"));

        $output = array(
            'nombre_titular' => $datos->nombre_titular,
            'apellido_titular' => $datos->apellidos_titular,
            'seccion' => $datos->seccion,
            'periodo' => $periodo.' a '.date("d-m-Y")
        );

        return response()->json($output);
    }
}
