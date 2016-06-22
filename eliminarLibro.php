<?php 
	//ARREGLAR
	session_start(); 
	use \Biblioteca\Conexion;
	use \Biblioteca\LibroDAO;
	require_once __DIR__ . "/vendor/autoload.php"; 

	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] == "Administrador"){

	}else if(isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] != "Administrador"){
		header('location: index.php');
	}else{
		header('location: login.html');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$codigo = isset($_POST["codigo1"])? trim($_POST["codigo1"]):"";
		$verificar = isset($_POST["codigo2"])? trim($_POST["codigo2"]):"";
		if($codigo == $verificar){
			$dao = new LibroDAO();
			$libroAEliminar = $dao->recuperarPorCodigo($codigo);
			if($libroAEliminar){
				if($libroAEliminar->eliminar($codigo)){
					echo"<script type=\"text/javascript\">alert('Libro con codigo $codigo eliminado correctamente');</script>";
				}
			}else{
				echo"<script type=\"text/javascript\">alert('Codigo no ingresado');</script>";	
			}
		}else{
			echo"<script type=\"text/javascript\">alert('Los codigos no coinciden');</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Eliminar libro</title>
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
	            <h2 class="text-center">Eliminar libro</h2>
	            <div class="alert alert-danger" role="alert"><p>Ingrese el codigo del libro para eliminarlo.</p></div>
	            <div class="account-wall">
					<form method="POST">
						<input name="codigo1" id="codigo" type="text" class="form-control" placeholder="Codigo" required autofocus>
			            <br>
			            <input name="codigo2" id="codigo" type="text" class="form-control" placeholder="Repita el codigo" required>
			            <br>
			            <button class="btn btn-lg btn-danger btn-block" type="submit">Eliminar libro</button>
					</form>
				</div>
			</div>
	    </div>
    </div>  
</body>
</html>