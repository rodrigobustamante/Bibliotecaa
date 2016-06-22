<?php 
	use \Biblioteca\Conexion;
	require_once __DIR__ . "/vendor/autoload.php";
	session_start(); 
	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] != "Administrador"){

	}else if(isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] == "Administrador"){
		header('location: panel_admin.php');
	}else{
		header('location: login.html');
	}

	$conexion = new Conexion();
	$crearConexion = $conexion->crearConexion();
	if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
		$usuario = isset($_SESSION["username"])? trim($_SESSION["username"]):"";
		$pass1 = isset($_POST["pass1"])? trim($_POST["pass1"]):"";
		$pass2 = isset($_POST["pass2"])? trim($_POST["pass2"]):"";
		$validar = $_SESSION["password"];
		if($pass1 != $pass2){
			echo"<script type=\"text/javascript\">alert('Las contraseñas no coinciden');</script>";
		}else if($validar != $pass1){
			echo"<script type=\"text/javascript\">alert('Contraseña incorrecta');</script>";
		}else{
			$sql = "DELETE FROM `usuario` WHERE usuario = ? and password = ?";
			$sentencia = $crearConexion->prepare($sql);
			$sentencia->bind_param("ss", $usuario, $pass1);
			$exito = $sentencia->execute();
			if ($exito) {
			    session_destroy();
				echo"<script type=\"text/javascript\">alert('Usuario eliminado correctamente'); window.location='login.html';</script>";
			} else {
			    echo "Error: conexion->error <br>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Eliminar usuario</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<body>
	<header>
		<div class="container">
			<div id="navbar" class="collapse navbar-collapse">
		        <ul class="nav navbar-nav">
		            <li><a href="index.php">Inicio</a></li>
					<li><a href="solicitar.php">Solicitar libro</a></li>
					<li><a href="devolver.php">Devolver libro</a></li>
					<li><a href="morosos.php">Listado de morosos</a></li>
					<li><a href="buscarUsuario.php">Buscar usuario</a></li>
					<li><a href="catalogo.php">Catalogo</a></li>
					<li>
						<a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true">
						Perfil
						<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
						    <li><a href="modificarUsuario.php">Modificar datos</a></li>
						    <li><a href="eliminarUsuario.php">Eliminar cuenta</a></li>
						</ul>
					</li>
					<div id="sesion">
						<li>
							Sesión actual:
							<script>
					    		var usuario = "<?php echo$_SESSION["username"];?>";
					    		document.write(usuario);
				    		</script>					    	
					    </li>
						<li>
							<a href="logout.php">Cerrar sesión</a>
						</li>
					</div>
		        </ul>
		    </div>
	    </div>
    </header>
    <div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <h2 class="text-center">Eliminar cuenta</h2>
	            <div class="alert alert-danger" role="alert"><p>Ingrese su contraseña para confirmar la eliminacion de su cuenta.</p></div>
	            <div class="account-wall">
					<form method="POST">
						<input name="pass1" id="usuario" type="password" class="form-control" placeholder="Contraseña" required autofocus>
			            <br>
			            <input name="pass2" id="pass" type="password" class="form-control" placeholder="Repita contraseña" required>
			            <br>
			            <button class="btn btn-lg btn-danger btn-block" type="submit">Eliminar cuenta</button>
					</form>
				</div>
			</div>
	    </div>
    </div>  
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$('.dropdown-toggle').dropdown();
    </script>
</body>
</html>

