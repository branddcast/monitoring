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
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            <span class="monitoring-border-bottom">
              <b>Autenticación</b>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span class="monitoring-border-bottom" onclick="javascript:make_fingerPrint()">
              <b id="make_hash">Generar Autenticación</b>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#add_user">
            <span class="monitoring-border-bottom">
              <b>Agregar Usuario</b>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false" onclick="javascript:usuarios_registrados()">
            <span class="monitoring-border-bottom">
              <b>Usuarios</b>
            </span>
          </a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
        <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="usuario-tab">
          <table id="usuarios_registrados" class="table table-bordered responsive table-sm mt-3 monitoring-table">
            <thead class="text-center">
              <tr>
                <th scope="col">#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Huella</th>
                <th>Registrado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
          </table>
        </div>
      </div>
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