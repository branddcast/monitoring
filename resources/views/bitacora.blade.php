@extends('layouts.app')

@section('content')

<div class="container bg-white monitoring-border-top w-50">
	<div class="row">
		<div class="col-md-12 text-center monitoring-head-text" style="background: rgba(68, 102, 187, .05)">
			<b>Bitácora</b>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12">
			<span class="monitoring-border-bottom">
				<b>Autenticación</b>
			</span>
			<span class="monitoring-border-bottom" onclick="javascript:make_hash()">
				<b id="make_hash">Generar Autenticación</b>
			</span>

			<table id="bitacora" class="table table-bordered responsive table-sm mt-3 monitoring-table">
				<thead class="text-center">
					<tr>
						<th scope="col">#</th>
						<th>Usuario</th>
						<th>Proceso</th>
						<th>No. Intentos</th>
						<th>Estado</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<tbody class="text-center">
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection