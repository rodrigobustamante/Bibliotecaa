<?php 
	
	use \Biblioteca\Conexion;
	require_once __DIR__ . "/vendor/autoload.php";
	
	$factory = new Conexion();
	$conexion = $factory->crearConexion();

	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$usuario = $_POST["usuario"];
	$password = $_POST["pass"];
	$confirmar = $_POST["pass2"];

	if($password != $confirmar){
		echo "<p>Las contraseñas no coinciden</p>";
		echo "<p> Da click <a href='registro.html'>aqui</a> para volver</p>";
	}else if(strlen($password) < 6){
		echo "<p>La contraseña es muy corta, minimo 6 caracteres</p>";
		echo "<p> Da click <a href='registro.html'>aqui</a> para volver</p>";
	}else if(strlen($usuario) < 6){
		echo "<p>El usuario debe tener minimo 6 caracteres</p>";
		echo "<p> Da click <a href='registro.html'>aqui</a> para volver</p>";
	}else{
		$sql = "insert into usuario (nombre, apellido, usuario, password) values (?, ?, ?, ?)";
		$sentencia = $conexion->prepare($sql);
		if($conexion->errno){
			echo "Error de sql: $conexion->error <br>";
			die();
		}

		$sentencia->bind_param("ssss", $nombre, $apellido, $usuario, $password);
		$exito = $sentencia->execute();

		if($exito){
			echo"<script type=\"text/javascript\">alert('Usuario creado correctamente'); window.location='login.html';</script>";
		}else if($conexion->errno == 1062){
			echo"<script type=\"text/javascript\">alert('El usuario ya existe'); window.location='registro.html';</script>";
		}else{
			echo "Error: conexion->error <br>";
		}
	}
