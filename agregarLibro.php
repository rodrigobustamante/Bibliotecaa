<?php 
	session_start();

	use \Biblioteca\Conexion;
	require_once __DIR__ . "/vendor/autoload.php";

	$factory = new Conexion();
	$conexion = $factory->crearConexion();

	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] == "Administrador"){

	}else if(isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] != "Administrador"){
		header('location: index.php');
	}else{
		header('location: login.html');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$titulo = isset($_POST["titulo"])? trim($_POST["titulo"]):"";
		$anio = isset($_POST["anio"])? trim($_POST["anio"]):"";
		$codigo = isset($_POST["codigo"])? trim($_POST["codigo"]):"";
		$autor = isset($_POST["autor"])? trim($_POST["autor"]):"";
		$cantidad = isset($_POST["cantidad"])? trim($_POST["cantidad"]):"";
		if($cantidad >= 1 && $anio >= 1){
			$sql = "insert into libro (titulo, anio, codigo, autor, stock, cantidad) values (?,?,?,?,?,?)";
			$sentencia = $conexion->prepare($sql);
			if($conexion->errno){
				echo "Error de sql: $conexion->error <br>";
			die();
			}	
			$sentencia->bind_param("sissii", $titulo, $anio, $codigo, $autor, $cantidad, $cantidad);
			$exito = $sentencia->execute();
			if($exito){
				echo"<script type=\"text/javascript\">alert('Libro ingresado correctamente'); window.location='agregarLibro.php';</script>";
			}else if($conexion->errno == 1062){
			echo"<script type=\"text/javascript\">alert('Codigo de libro ya designado'); window.location='agregadoLibro.php';</script>";
			}else{
				echo "Error: $conexion->error <br>";
				echo"<script type=\"text/javascript\">alert('Error: $conexion->error <br>'); window.location='agregadoLibro.php';</script>";
			}
		}else{
			echo"<script type=\"text/javascript\">alert('Stock o año incorrecto');</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Agregar libro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<div class="container">
			<div id="navbar" class="collapse navbar-collapse">
		        <ul class="nav navbar-nav">
		            <li><a href="index.php">Panel</a></li>
					<li><a href="agregarLibro.php">Agregar libro</a></li>
					<li><a href="modificarLibro.php">Modificar libro</a></li>
					<li><a href="eliminarLibro.php">Eliminar libro</a></li>
					<li><a href="catalogoAdmin.php">Catalogo</a></li>
					<li><a href="listadoUsuarios.php">Listado de usuarios</a></li>
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
	            <h2 class="text-center">Agregar libro</h2>
	            <div class="account-wall">
					<form method="POST">
						<input name="titulo" id="titulo" type="text" class="form-control" placeholder="Titulo del libro" required autofocus>
			            <br>
			            <input name="autor" id="autor" type="text" class="form-control" placeholder="Autor del libro" required>
			            <br>
			            <input name="anio" id="anio" type="number" class="form-control" placeholder="Año de publicacion" required>
			            <br>
			            <input name="codigo" id="codigo" type="text" class="form-control" placeholder="Codigo del libro" required>
			            <br>
			            <input name="cantidad" id="cantidad" type="number" class="form-control" placeholder="Cantidad" required>
			            <br>
			            <button class="btn btn-lg btn-primary btn-block" type="submit">Agregar libro</button>
					</form>
				</div>
			</div>
	    </div>
    </div>  
</body>
</html>