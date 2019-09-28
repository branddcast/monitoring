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

        return response()->json($datos);
    }
}
