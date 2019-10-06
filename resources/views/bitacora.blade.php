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
			<span class="monitoring-border-bottom" onclick="javascript:make_fingerPrint()">
				<b id="make_hash">Generar Autenticación</b>
			</span>
			<span class="monitoring-border-bottom">
				<a href="#" data-toggle="modal" data-target="#add_user"><b>Agregar Usuario</b></a>
			</span>

			<table id="bitacora" class="table table-bordered responsive table-sm mt-3 monitoring-table">
				<thead class="text-center">
					<tr>
						<th scope="col">#</th>
						<th>Usuario</th>
						<th>Proceso</th>
						<th>Intentos Fallidos</th>
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

<!-- User Form Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="add_userTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_userTitle">Agregar Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div class="row">
      			<div class="col-md-12">
      				<small>Éste formulario es para añadir un nuevo usuario a la base de datos. Para registrar la huella dactilar, utilizar el sensor biométrico de la caja fuerte.</small>
      			</div>
      		</div>
      		<div class="row mt-4">
      			<div class="col-md-6">
      				<input id="user_name" class="form-control form-control-sm" type="text" placeholder="Nombre" required>
      			</div>
      			<div class="col-md-6">
      				<input id="user_email" class="form-control form-control-sm" type="text" placeholder="Email" required>
      			</div>
      		</div>
      		<div class="row mt-2">
      			<div class="col-md-6">
      				<input id="user_password" class="form-control form-control-sm" type="password" placeholder="Contraseña" required>
      			</div>
      			<div class="col-md-6">
      				<input id="user_password_confirmed" class="form-control form-control-sm" type="password" placeholder="Repetir Contraseña" required>
      			</div>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="javascript:save_user()">Guardar</button>
      </div>
    </div>
  </div>
</div>

@endsection