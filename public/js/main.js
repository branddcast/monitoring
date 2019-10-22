var validate_auth_user = null;

$(document).ready(function(){

	$('[data-toggle="tooltip"]').tooltip();
	datosGenerales();
	bitacora();
	comboBox_roles();
	$('#user_loading').hide();
});

var intentos_cont = 0;
var date = null;
var date_aux = null;
var maxIntentos = 5;
var minutosDeEspera = 5;

function datosGenerales(){
	$.ajax({
		url: base_url + "/datos_generales",
		type: 'post',
		data:{
		    id: id_user,
		    _token: token
		},
		success: function(data){
			//console.log(data.apellidos_titular);
			$('#nombre_titular').text(data.nombre_titular + ' ' + data.apellidos_titular);
			$('#seccion').text(data.seccion);
			$('#periodo').text(data.periodo);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});
}

function grafica_1(){
	var options = {
		chart: {
	    	type: 'line'
	  	},
	  	series: [{
	    	name: 'sales',
	    	data: [30,40,35,50,49,60,70,91,125]
	  	}],
	  	xaxis: {
	    	categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
	  	}
	}

	var chart = new ApexCharts(document.querySelector("#grafica_1"), options);

	chart.render();
}

function bitacora(){
	$.ajax({
		url: base_url + "/bitacora/ultimos_registros",
		type: 'get',

		beforeSend: function () {
            $('#bitacora').append('<tr><td colspan="6">'+
            	'<div class="spinner-grow text-info" role="status">'+
  					'<span class="sr-only">Loading...</span>'+
				'</div></td></tr>');
        },
		success: function(data){
			//console.log(data);

			$('#bitacora tbody').empty();

			for (var i = 0; i < data.length; i++) {
				$('#bitacora').append(
					'<tr>' +
						'<th class="scope">' + (i+1) + '</th>' +
						'<td>' + data[i].usuario + '</td>' +
						'<td>' + data[i].proceso + '</td>' +
						'<td>' + data[i].intentos + '</td>' +
						'<td>' + data[i].estado + '</td>' +
						'<td>' + data[i].fecha + '</td>' +
					'</tr>'
				);
			}

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});
}

function usuarios_registrados(){
	$.ajax({
		url: base_url + "/usuarios/all",
		type: 'get',

		beforeSend: function () {
			$('#usuarios_registrados tbody').empty();
            $('#usuarios_registrados').append('<tr><td colspan="7">'+
            	'<div class="spinner-grow text-info" role="status">'+
  					'<span class="sr-only">Loading...</span>'+
				'</div></td></tr>');
        },
		success: function(data){
			//console.log(data);

			$('#usuarios_registrados tbody').empty();

			for (var i = 0; i < data.length; i++) {
				$('#usuarios_registrados').append(
					'<tr>' +
						'<th class="scope">' + (i+1) + '</th>' +
						'<td>' + data[i].nombre + '</td>' +
						'<td>' + data[i].email + '</td>' +
						'<td>' + data[i].rol + '</td>' +
						'<td>' + data[i].huella + '</td>' +
						'<td>' + data[i].fecha + '</td>' +
						'<td>' + data[i].acciones + '</td>' +
					'</tr>'
				);
			}

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});
}

/*function make_hash(){

	if(intentos_cont >= maxIntentos){
		if(date == null){
			date = new Date();
			date_aux = new Date();
			date_aux.setMinutes(date_aux.getMinutes() + minutosDeEspera);
		}

		if(new Date() >= date_aux){
			//inicializar valores
			date = null;
			intentos_cont = 0;
		}

		alert('Ha superado la cantidad máxima de intentos, espere unos minutos. Por favor.\n\nEspere hasta ' + date_aux.getDate() + '-' + (date_aux.getMonth()+1) + '-' + date_aux.getFullYear() + ' ' +date_aux.getHours() + ':' + date_aux.getMinutes() + '\n\n');
		return false;
	}

	var key = prompt("Escriba la palabra secreta. Restan [" + (5-intentos_cont) + '] intentos: ');
	console.log(key);

	if(key == null){
		return false;
	}

	$.ajax({
		url: base_url + "/validar_usuario",
		type: 'post',
		data:{
		    key: key,
		    intentos: intentos_cont,
		    _token: token
		},
		success: function(data){
			if(data.estado == 1){
				alert(data.mensaje + '\n\n');
				$('#bitacora tbody').empty();
				bitacora();

				//inicializar valores
				date = null;
				intentos_cont = 0;
			}else{
				if(data.estado == 0){
					intentos_cont += 1;
				}
				alert(data.mensaje + '\n\n');
				console.log(intentos_cont);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});
}*/

function make_fingerPrint(){

	if(intentos_cont >= maxIntentos){
		if(date == null){
			date = new Date();
			date_aux = new Date();
			date_aux.setMinutes(date_aux.getMinutes() + minutosDeEspera);
		}

		if(new Date() >= date_aux){
			//inicializar valores
			date = null;
			intentos_cont = 0;
		}

		//alert('Ha superado la cantidad máxima de intentos, espere unos minutos. Por favor.\n\nEspere hasta ' + date_aux.getDate() + '-' + (date_aux.getMonth()+1) + '-' + date_aux.getFullYear() + ' ' +date_aux.getHours() + ':' + date_aux.getMinutes() + '\n\n');
		alerta('¡Oops!', 'Ha superado la cantidad máxima de intentos, espere unos minutos. Por favor.\n\nEspere hasta ' + date_aux.getDate() + '-' + (date_aux.getMonth()+1) + '-' + date_aux.getFullYear() + ' ' +date_aux.getHours() + ':' + date_aux.getMinutes() + '\n\n', 'warning');
		return false;
	}

	var key = prompt("Escriba el Id de la huella. Restan [" + (5-intentos_cont) + '] intentos: ');
	console.log(key);

	if(key <= 0){
		//alert('Ingrese un Id correcto.');
		alerta('¡Oops!', 'Ingrese un Id correcto', 'error');
		if (key != null) {
			intentos_cont += 1;
		}
		return false;
	}

	$.ajax({
		url: base_url + "/api/validar_usuario",
		type: 'post',
		data:{
		    key: key,
		    intentos: intentos_cont,
		    //_token: token
		},
		success: function(data){
			if(data.estado == 1){
				//alert(data.mensaje + '\n\n');
				alerta('¡Genial!', data.mensaje, 'success');
				$('#bitacora tbody').empty();
				bitacora();

				//inicializar valores
				date = null;
				intentos_cont = 0;
			}else{
				if(data.estado == 0){
					intentos_cont += 1;
				}
				//alert(data.mensaje + '\n\n');
				alerta('¡Oops!', data.mensaje, 'error');
				console.log(intentos_cont);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});
}

function save_user(){
	validate_auth_user = null;
	var nombre = $('#user_name').val();
	var email = $('#user_email').val();
	var password = $('#user_password').val();
	var password_confirmed = $('#user_password_confirmed').val();
	var rol = $('#user_rol').val();
	var id = $('#hidden_id_input').val();

	var validate = {
		"nombre" : nombre,
		"email"  : email,
		"password" : password,
		"password_confirmed" : password_confirmed,
		"rol" : rol,
		"id" : (id >= 0)? id : null,
	};

	if(!validate_form(validate)){
		return false;
	}

	$('#add_user').modal('hide');
	eject_ajax_user(validate, $('#hidden_process_input').val());
}

function deleteUser(id){
	eject_ajax_user(id, 'delete');
}

function updateUser(id){
	$('#user_name').val('');
	$('#user_email').val('');
	$('#user_password').val('');
	$('#user_password_confirmed').val('');
	$("#user_rol option").prop("selected",false);
	$('#hidden_id_input').val(0);

	$('#add_user').modal('show');

	$.ajax({
		url: base_url + "/usuarios/usuario/" + id,
		type: 'get',

		beforeSend: function () {
			$('#user_loading').show();
        },
		success: function(data){
			//console.log(data);

			$('#user_loading').hide();

			if(data.status == 0){
				alerta('¡Oops!', data.mensaje, 'info');
				return false;
			}

			if(data.disabled == 1){
				$('#user_name').prop('disabled', true);
				$('#user_email').prop('disabled', true);
				$("#user_rol option").prop("disabled", true);
			}

			$('#hidden_id_input').val(data.id);
			$('#user_name').val(data.nombre);
			$('#user_email').val(data.email);
			$("#user_rol option[value="+ data.rol +"]").prop("selected", true);
			

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});

	$('#hidden_process_input').val('update');
}

function validate_form(validate){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if(validate.nombre == ""){
		//alert('El campo del nombre no debe estar vacío');
		alerta('¡Oops!', 'El campo del nombre no debe estar vacío', 'info');
		return false;
	}

	if (validate.email == "") {
		//alert('El campo del correo electrónico no debe estar vacío');
		alerta('¡Oops!', 'El campo del correo electrónico no debe estar vacío', 'info');
		return false;
	}else if (!filter.test(validate.email)) {
		//alert('El campo del correo electrónico debe llevar un formato: correo@ejemplo.com');
		alerta('¡Oops!', 'El campo del correo electrónico debe llevar un formato: correo@ejemplo.com', 'info');
		return false;
	}

	if($('#hidden_id_input').val() == 0){
		if (validate.password == "" || validate.password_confirmed == "") {
			//alert('Los campos de las contraseñas no deben estar vacíos');
			alerta('¡Oops!', 'Los campos de las contraseñas no deben estar vacíos', 'info');
			return false;
		}else if (validate.password != validate.password_confirmed) {
			//alert("Las contraseñas no coinciden. Escríbalas correctamente");
			alerta('¡Oops!', 'Las contraseñas no coinciden. Escríbalas correctamente', 'info');
			return false;
		}
	}else{
		if (validate.password != validate.password_confirmed) {
			//alert("Las contraseñas no coinciden. Escríbalas correctamente");
			alerta('¡Oops!', 'Las contraseñas no coinciden. Escríbalas correctamente', 'info');
			return false;
		}
	}

	return true;
}

function alerta(title, text, icon, button = 'Aceptar'){
	swal({
	  title: title,
	  text: text,
	  icon: icon,
	  button: button,
	});
}

function eject_ajax_user(validate=null, option=null){
	$('#hidden_auth_input').val(0);

	var password = null;

	$('#user_auth_password').val('');

	$('#user_auth').modal('show');

	$('#user_auth_submit').click(function(){
		//Validar pretición
		password = null;
	 	password = $('#user_auth_password').val();

	 	console.log(password);

	 	if(password == null || password == ''){
	 		alerta('¡Oops!', 'No debes dejar el campo vacío.', 'warning');
	 		return false;
	 	}

	 	$('#user_auth').modal('hide');

	 	$.post(base_url + "/usuarios/auth_user",{usuario: id_user, password: password, _token: token}, function(data, status){
			$('#hidden_auth_input').val(data.auth);

			validate_auth_user = data.auth;

			if(validate_auth_user == 0 || validate_auth_user == null){
				alerta('¡Oops!', 'Error en credenciales de Administrador. Repita el proceso.', 'warning');
				$('#user_auth_password').val('');
				$('#user_auth').modal('show');
				return false;
			}
			$('#user_auth_password').val('');

			ajax_user(validate, option, validate_auth_user);

			//setUserAuth(data.auth, validate, option);
		});
	});
}

/*function setUserAuth(paramValidate = null, validate=null, option=null){
	validate_auth_user = paramValidate;

	if(validate_auth_user == 0 || validate_auth_user == null){
		alerta('¡Oops!', 'Error en credenciales de Administrador. Repita el proceso.', 'warning');
		$('#user_auth_password').val('');
		$('#user_auth').modal('show');
		return false;
	}
	$('#user_auth_password').val('');

	ajax_user(validate, option, validate_auth_user);
}*/

function ajax_user(validate=null, option=null, checked =null){

	if(checked == 0){
		return false;
	}

	switch(option){
		case 'save' :
			$.ajax({
				url: base_url + "/usuarios/agregar_usuario",
				type: 'post',
				data:{
					nombre : validate.nombre,
					email: validate.email,
					password: validate.password,
					rol: validate.rol,
				    _token: token
				},
				success: function(data){
					if(data.status == 1){
						//alert(data.mensaje + '\n\n');
						alerta('¡Genial!', data.mensaje, 'success');

						$('#user_name').val('');
						$('#user_email').val('');
						$('#user_password').val('');
						$('#user_password_confirmed').val('');
						$('#user_rol').val('0');
						$('.modal-backdrop').hide();
						usuarios_registrados();
					}else{
						//alert(data.mensaje + '\n\n');
						$('#add_user').modal('show');
						alerta('¡Oops!', data.mensaje, 'error');

					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest);
				}
			});
			break;
		case 'delete' :
			//delete
			$.ajax({
				url: base_url + "/usuarios/eliminar_usuario",
				type: 'post',
				data:{
					id : validate,
				    _token: token
				},
				success: function(data){
					if(data.status == 1){
						//alert(data.mensaje + '\n\n');
						alerta('¡Genial!', data.mensaje, 'success');
						usuarios_registrados();
					}else{
						//alert(data.mensaje + '\n\n');
						alerta('¡Oops!', data.mensaje, 'error');
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest);
				}
			});
			break;
		case 'update' :
			//update
			$.ajax({
				url: base_url + "/usuarios/actualizar_usuario",
				type: 'post',
				data:{
					nombre : validate.nombre,
					email: validate.email,
					password: validate.password,
					rol: validate.rol,
					id: validate.id,
				    _token: token
				},
				success: function(data){
					if(data.status == 1){
						//alert(data.mensaje + '\n\n');
						alerta('¡Genial!', data.mensaje, 'success');

						$('#user_name').val('');
						$('#user_email').val('');
						$('#user_password').val('');
						$('#user_password_confirmed').val('');
						$("#user_rol option").attr("selected",false);
						$("#user_rol option[value=0]").attr("selected",true);
						$('.modal-backdrop').hide();
						$('#add_user').modal('hide');
						usuarios_registrados();
					}else{
						//alert(data.mensaje + '\n\n');
						$('#add_user').modal('show');
						alerta('¡Oops!', data.mensaje, 'error');

					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest);
				}
			});
			break;
	}
}

function comboBox_roles(){
	$.ajax({
		url: base_url + "/roles/all",
		type: 'get',
		success: function(data){
			//console.log(data);

			for (var i = 0; i < data.length; i++) {
				$('#user_rol').append(
					'<option value="' + data[i].id + '">' + data[i].nombre + '</option>'
				);
			}

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});
}

function user_form(){
	$('#user_name').val('');
	$('#user_email').val('');
	$('#user_password').val('');
	$('#user_password_confirmed').val('');
	$("#user_rol option").prop("selected",false);
	$("#user_rol option[value='0']").prop("selected",true);
	$('#hidden_id_input').val(0);

	$('#add_user').modal('toggle');
	$('#hidden_process_input').val('save');
}

function registrar_huella(){
	$('#fingerPrint_nombre').val('');
	$('#fingerPrint_email').val('');
	$('#fingerPrint_rol').val('');
	$('#fingerPrint_huella').val('');
	$('#usuario_id').val('');
	$('#fingerPrint_usuario').val('');

	$('#fingerPrint_loading').hide();
	$('#fingerPrint').modal('show');
	
	$('#fingerPrint_usuario').focusout(function (){
		
		var usuario = $('#fingerPrint_usuario').val();
		
		//Solicitar usuario

		solicitar_huella_usuario(usuario);
	});
}

$('#eliminar_huella').click(function () {
	var usuario = $('#usuario_id').val();
	var email = $('#fingerPrint_usuario').val();

	$.ajax({
			url: base_url + "/usuarios/huella_eliminar",
			type: 'post',
			data: {
				usuario: usuario,
				_token: token
			},

			/*beforeSend: function () {
				//$('#fingerPrint_loading').show();
	        },*/
			success: function(data){

				if (data.status == 1) {
					alerta('Genial!', data.mensaje, 'success');
					var usuario = $('#fingerPrint_usuario').val();
					//Solicitar usuario

					solicitar_huella_usuario(email);
				}else{
					alerta('¡Oops!', data.mensaje, 'warning');
				}

			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest);
			}
		});
});

function solicitar_huella_usuario(usuario){
	$.ajax({
			url: base_url + "/usuarios/huella_usuario/" + usuario,
			type: 'get',

			beforeSend: function () {
				$('#fingerPrint_loading').show();
	        },
			success: function(data){
				//console.log(data);
				$('#fingerPrint_loading').hide();
				
				$('#fingerPrint_nombre').val(data.nombre);
				$('#fingerPrint_email').val(data.email);
				$('#fingerPrint_rol').val(data.rol);
				$('#fingerPrint_huella').val(data.huella);

				if (data.status == 1) {
					$('#fingerPrint_huella').removeClass('text-danger');
					$('#fingerPrint_huella').addClass('text-success');
					$('#eliminar_huella').show();
					$('#usuario_id').val(data.id);
					$('#registrar_huella_btn').hide();
				}else{
					$('#fingerPrint_huella').removeClass('text-success');
					$('#fingerPrint_huella').addClass('text-danger');
					$('#eliminar_huella').hide();
					$('#usuario_id').val('');
					$('#registrar_huella_btn').show();
				}

				if (data.fail == 1) {
					alerta('¡Oops!', 'Parece que no existe un usuario con ' + usuario, 'warning');
				}

			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest);
			}
		});
}

function startFingerPrintProcess(){
	console.log("Inicia proceso para registar huellla");
}
