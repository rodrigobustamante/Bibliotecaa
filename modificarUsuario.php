<?php 
	use \Biblioteca\Conexion;
	use \Biblioteca\UsuarioDAO;
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
		$usuario = $_SESSION["username"];
		$nombre = isset($_POST["nombre"])? trim($_POST["nombre"]):"";
		$apellido = isset($_POST["apellido"])? trim($_POST["apellido"]):"";
		$actual = isset($_POST["actual"])? trim($_POST["actual"]):"";
		$password = isset($_POST["pass1"])? trim($_POST["pass1"]):"";
		$pass2 = isset($_POST["pass2"])? trim($_POST["pass2"]):"";
		$validar = $_SESSION["password"];
		if($password != $pass2){
			echo"<script type=\"text/javascript\">alert('Las contraseñas no coinciden');</script>";
		}else if($actual != $validar){
			echo"<script type=\"text/javascript\">alert('Contraseña incorrecta');</script>";
		}else if(strlen($nombre) < 0 && !preg_match('/[^a-Z]/',$nombre)){
			echo"<script type=\"text/javascript\">alert('Campo nombre invalido');</script>";
		}else if(strlen($apellido) < 0 && !preg_match('/[^a-Z]/',$apellido)){
			echo"<script type=\"text/javascript\">alert('Campo apellido invalido');</script>";
		}else{
			$dao = new UsuarioDAO();
			$usuarioAModificar = $dao->recuperarPorUsuario($usuario);
			if ($usuarioAModificar->modificar($nombre, $apellido, $password, $usuario)){
				echo"<script type=\"text/javascript\">alert('Usuario modificado correctamente'); window.location='index.php';</script>";
			} else {
			    echo "Error: conexion->error <br>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar usuario</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
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
	            <h2 class="text-center">Modificar cuenta</h2>
	            <div class="alert alert-success" role="alert"><p>Ingrese datos a modificar, todos los campos son obligatorios</p></div>
	            <div class="account-wall">
					<form method="POST">
						<input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre" required autofocus>
			            <br>
			            <input name="apellido" id="apellido" type="text" class="form-control" placeholder="Apellido" required>
			            <br>
			            <input name="actual" id="actual" type="password" class="form-control" placeholder="Contraseña actual" required>
			            <br>
			            <input name="pass1" id="pass1" type="password" class="form-control" placeholder="Nueva contraseña" required>
			            <br>
			            <input name="pass2" id="pass2" type="password" class="form-control" placeholder="Repita Contraseña" required>
			            <br>
			            <button class="btn btn-lg btn-primary btn-block" type="submit">Modificar cuenta</button>
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