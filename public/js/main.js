$(document).ready(function(){

	datosGenerales();
	bitacora();
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
		success: function(data){
			//console.log(data);

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

function make_hash(){

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
}

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

		alert('Ha superado la cantidad máxima de intentos, espere unos minutos. Por favor.\n\nEspere hasta ' + date_aux.getDate() + '-' + (date_aux.getMonth()+1) + '-' + date_aux.getFullYear() + ' ' +date_aux.getHours() + ':' + date_aux.getMinutes() + '\n\n');
		return false;
	}

	var key = prompt("Escriba el Id de la huella. Restan [" + (5-intentos_cont) + '] intentos: ');
	console.log(key);

	if(key <= 0){
		alert('Ingrese un Id correcto.');
		intentos_cont += 1;
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
}

function save_user(){
	var nombre = $('#user_name').val();
	var email = $('#user_email').val();
	var password = $('#user_password').val();
	var password_confirmed = $('#user_password_confirmed').val();

	var validate = {
		"nombre" : nombre,
		"email"  : email,
		"password" : password,
		"password_confirmed" : password_confirmed
	};

	if(!validate_form(validate)){
		return false;
	}

	$.ajax({
		url: base_url + "/usuarios/agregar_usuario",
		type: 'post',
		data:{
			nombre : nombre,
			email: email,
			password: password,
		    _token: token
		},
		success: function(data){
			if(data.status == 1){
				alert(data.mensaje + '\n\n');

				$('#user_name').val('');
				$('#user_email').val('');
				$('#user_password').val('');
				$('#user_password_confirmed').val('');

				$('#add_user').modal('hide');
			}else{
				alert(data.mensaje + '\n\n');
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest);
		}
	});

}

function validate_form(validate){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if(validate.nombre == ""){
		alert('El campo del nombre no debe estar vacío');
		return false;
	}

	if (validate.email == "") {
		alert('El campo del correo electrónico no debe estar vacío');
		return false;
	}else if (!filter.test(validate.email)) {
		alert('El campo del correo electrónico debe llevar un formato: correo@ejemplo.com');
		return false;
	}

	if (validate.password == "" || validate.password_confirmed == "") {
		alert('Los campos de las contraseñas no deben estar vacíos');
		return false;
	}else if (validate.password != validate.password_confirmed) {
		alert("Las contraseñas no coinciden. Escríbalas correctamente");
		return false;
	}

	return true;
}

