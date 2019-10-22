<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\ConsumoElectrico;

class ConsumoElectricoController extends Controller
{
    public function inputs_electricos(Request $request){

    	$input = $request->all();

    	$encendido = new DateTime($input['encendido']);//fecha inicial
		$apagado = new DateTime($input['apagado']);//fecha de cierre

		$intervalo = $encendido->diff($apagado);

		$horas = $intervalo->format('%H');

    	do{
    		$voltaje = (float) bcdiv(10/rand(1,5), 1, 2);
    	}while($voltaje > 5.0);

    	do{
    		$corriente = (float) bcdiv(rand(500,1000) / 1000, 1, 2);
    	}while($corriente > 1000);

    	$potencia = (float) bcdiv($voltaje * $corriente, 1, 2);

    	$costo = (float) bcdiv(($potencia * $horas) * 0.793, 1, 2);

    	$consumo = new ConsumoElectrico;

    	$consumo->voltaje   = $voltaje;
    	$consumo->corriente = $corriente;
    	$consumo->potencia  = $potencia;
    	$consumo->costo     = $costo;
    	$consumo->encendido = $encendido;
    	$consumo->apagado   = $apagado;

    	if ($consumo->save()) {
    		return response()->json(["estatus" => 1]);
    	}else{
    		return response()->json(["estatus" => 0]);
    	}
    }

    public function getAll(Request $request){
    	$consumos = ConsumoElectrico::orderBy('id', 'desc')->limit(10)->get();

        $response = array();

        foreach ($consumos as $row) {
            $output = array();

            $encendido = new DateTime($row->encendido);//fecha inicial
			$apagado = new DateTime($row->apagado);//fecha de cierre

            $tiempo = $encendido->diff($apagado)->format('%H h %I m');

            $output['voltaje'] = $row->voltaje;
            $output['corriente'] = $row->corriente;
            $output['potencia'] = $row->potencia;
            $output['costo'] = $row->costo;
            $output['tiempo'] = $tiempo;
            //$output['fecha'] = $row->created_at->format('d-m-Y');
            //$output['acciones'] = ($admin->rol == 1) ? '<i class="fas fa-pencil-alt text-info mr-3" style="font-size: 12pt; cursor:pointer" onclick="javascript:updateUser('.$row->id.')"></i> <i class="fas fa-times text-danger" style="font-size: 12pt; cursor:pointer" onclick="javascript:deleteUser('.$row->id.')"></i>' : '-';

            $response[] = $output;
        }

        return response()->json($response);
    }
}
