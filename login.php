<?php 
//validar texto correcto
session_start(); 
use \Biblioteca\Conexion;
use \Biblioteca\UsuarioDAO;
//$conexion = new Conexion();
//$crearConexion = $conexion->crearConexion(); 
require_once __DIR__ . "/vendor/autoload.php"; 


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$usuario = isset($_POST["usuario"])? trim($_POST["usuario"]):"";
	$password = isset($_POST["password"])? trim($_POST["password"]):"";
	$validar = isset($_POST["password"])? trim($_POST["password"]):"";
	$dao = new UsuarioDAO();
	$login = $dao->recuperarPorUsuario($usuario);
	if($login){
		if($login->autorizar($validar)){
			$_SESSION["loggedin"] = true;
			$_SESSION["username"] = $usuario;
			$_SESSION["password"] = $password;
			$_SESSION["start"] = time();
			header('location: index.php');
		}else{
			echo"<script type=\"text/javascript\">alert('Contraseña incorrecta');
			window.location='login.html'; </script>";
		}		
	}else{
		echo"<script type=\"text/javascript\">alert('Usuario no registrado'); window.location='login.html';</script>";
	}
}
/*
$usuario = $_POST["usuario"];
$password = $_POST["password"];

$sql = "select nombre, apellido, usuario, password from usuario where usuario = ? and password = ?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("ss", $usuario, $password);
$exito = $sentencia->execute();

if ($exito){
	$resultado = $sentencia->get_result();
	if($resultado->num_rows == 1){
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $usuario;
		$_SESSION["password"] = $password;
		$_SESSION["start"] = time();
		header('location: index.php'); 
	}else{
	echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrecta'); window.location='login.html';</script>";
	}
}
*/