@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 monitoring-border-top bg-white">
				<div class="row mb-3">
					<div class="col-md-12 text-center monitoring-head-text" style="background: rgba(68, 102, 187, .05)">
						<b>Monitoreo Eléctrico</b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<span class="monitoring-border-bottom">
							<b>Datos Generales</b>
						</span>

						<p class="mt-3 datos_generales_p">
						   Nombre: <label id="nombre_titular"></label><br/>
						   Sección: <label id="seccion"></label> <br/>
						   Periodo: <label id="periodo"></label><br/>
						   Costo: <label id="costo"></label>
						</p>
					</div>
					<div class="col-md-6 text-right">
						<div id="container-speed" class="wrapper">
							<div class="gauge">
							    <div class="slice-colors">
							      <div class="st slice-item"></div>
							      <div class="st slice-item"></div>
							      <div class="st slice-item"></div>
							      <div class="st slice-item"></div>
							      <div class="st slice-item"></div>
							    </div>
							    <div class="needle"></div>
							    <div class="gauge-center"></div>
							  </div>
						</div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12 mb-4">
						<span class="monitoring-border-bottom">
							<b>Consumo Potencia Eléctrica</b>
						</span>
					</div>
					<div class="col-md-12">
						<div id="grafica_potencia" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12 mb-4">
						<span class="monitoring-border-bottom">
							<b>Últimos Registros</b>
						</span>
					</div>
					<div class="col-md-12">
						<table id="consumo_electrico_tabla" class="table responsive table-bordered table-sm monitoring-table">
							<thead class="text-center">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Voltaje</th>
									<th scope="col">Corriente</th>
									<th scope="col">Potencia</th>
									<th scope="col">Costo</th>
									<th scope="col">Tiempo</th>
								</tr>
							</thead>
							<tbody class="text-center">
							</tbody>
						</table>
					</div>
				</div>
				<div class="row mt-4 mb-4">
					<div class="col-md-12 mb-4">
						<span class="monitoring-border-bottom">
							<b>Consumo Voltaje y Corriente Eléctrica</b>
						</span>
					</div>
					<div class="col-md-12">
						<div id="grafica_voltaje_corriente" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection