$(document).ready(function(){
	$("#nombre").blur(validarNombre);
	$("#apellido").blur(validarApellido);
	$("#usuario").blur(validarUsuario);
	$("#pass").blur(validarPass);
	$("#pass2").blur(validarIguales);
});

function validarNombre(){
	$("#checkNombre").removeClass();
	$("#mensaje_nombre").html(" ");
	var nombre = $("#nombre").val();
	var patron = /^[a-zA-Z]+$/;
	if(nombre.length == 0){
		$("#checkNombre").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_nombre").html("Campo nombre vacio").css({color: "red"});
		$('#boton').attr("disabled", true);
	}else if (patron.test(nombre)) {
		$("#checkNombre").addClass( "fa fa-check" ).css({color: "green"});
		$("#mensaje_nombre").html("Campo nombre valido").css({color: "green"});
		$('#boton').attr("disabled", true);
	}else{
		$("#checkNombre").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_nombre").html("Campo nombre invalido").css({color: "red"});
	}
}

function validarApellido(){
	$("#checkApellido").removeClass();
	$("#mensaje_apellido").html(" ");
	var apellido = $("#apellido").val();
	var patron = /^[a-zA-Z]+$/;
	if(apellido.length == 0){
		$("#checkApellido").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_apellido").html("Campo apellido vacio").css({color: "red"});
		$('#boton').attr("disabled", true);
	}else if (patron.test(apellido)) {
		$("#checkApellido").addClass( "fa fa-check" ).css({color: "green"});
		$("#mensaje_apellido").html("Campo apellido valido").css({color: "green"});
		$('#boton').attr("disabled", true);
	}else{
		$("#checkApellido").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_apellido").html("Campo apellido invalido").css({color: "red"});
	}
}

function validarUsuario(){
	$("#checkUsuario").removeClass();
	$("#mensaje_usuario").html(" ");
	var usuario = $("#usuario").val();
	if(usuario.length == 0){
		$("#checkUsuario").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_usuario").html("Campo usuario vacio").css({color: "red"});
		$('#boton').attr("disabled", true);
	}else{
		$("#checkUsuario").addClass( "fa fa-check" ).css({color: "green"});
		$("#mensaje_usuario").html("Campo usuario valido").css({color: "green"});
	}
}

function validarPass(){
	$("#checkPass").removeClass();
	$("#checkPass2").removeClass();
	$("#mensaje_pass").html(" ");
	$("#mensaje_pass2").html(" ");
	var pass = $("#pass").val();
	var pass2 = $("#pass2").val();
	if(pass.length == 0){
		$("#checkPass").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_pass").html("Campo contraseña vacio").css({color: "red"});
	}else{
		$("#checkPass").addClass( "fa fa-check" ).css({color: "green"});
		$("#mensaje_pass").html("Campo contreña valido").css({color: "green"});
		
	}
}

function validarIguales(){
	$("#checkPass2").removeClass();
	$("#mensaje_pass2").html(" ");
	var pass = $("#pass").val();
	var pass2 = $("#pass2").val();
	if (pass != pass2) {
		$("#checkPass2").addClass( "fa fa-times" ).css({color: "red"});
		$("#mensaje_pass2").html("Las contraseñas no coinciden").css({color: "red"});
		$('#boton').attr("disabled", true);
	}else if(pass2.length > 0){
		$("#checkPass2").addClass( "fa fa-check" ).css({color: "green"});
		$("#mensaje_pass2").html("Las contreñas coinciden").css({color: "green"});
		$('#boton').attr("disabled", false);
	}
}