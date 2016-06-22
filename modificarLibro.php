<?php 
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
		$titulo = isset($_POST["titulo"])? trim($_POST["titulo"]):"";
		$autor = isset($_POST["autor"])? trim($_POST["autor"]):"";
		$anio = isset($_POST["anio"])? trim($_POST["anio"]):"";
		$stock = isset($_POST["stock"])? trim($_POST["stock"]):"";
		$cantidad = isset($_POST["cantidad"])? trim($_POST["cantidad"]):"";
		$codigo = isset($_POST["codigo"])? trim($_POST["codigo"]):"";
		$verificar = isset($_POST["verificar"])? trim($_POST["verificar"]):"";
		if($codigo == $verificar){
			$dao = new LibroDAO();
			$libroAModificar = $dao->recuperarPorCodigo($codigo);
			if($libroAModificar){
				if($libroAModificar->modificar($titulo, $autor, $anio, $stock, $cantidad, $codigo)){
					echo"<script type=\"text/javascript\">alert('Libro con codigo $codigo modificado correctamente');</script>";
				}
			}else{
				echo"<script type=\"text/javascript\">alert('Codigo incorrecto');</script>";	
			}
		}else{
			echo"<script type=\"text/javascript\">alert('Los codigos no coinciden');</script>";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Modificar libro</title>
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
	            <h2 class="text-center">Modificar libro</h2>
	            <div class="account-wall">
					<form method="POST">
						<input name="titulo" id="titulo" type="text" class="form-control" placeholder="Titulo del libro" required autofocus>
			            <br>
			            <input name="autor" id="autor" type="text" class="form-control" placeholder="Autor del libro" required>
			            <br>
			            <input name="anio" id="anio" type="number" class="form-control" placeholder="Año de publicacion" required>
			            <br>
			            <input name="stock" id="stock" type="number" class="form-control" placeholder="Stock" required>
			            <br>
			             <input name="cantidad" id="cantidad" type="number" class="form-control" placeholder="Cantidad" required>
			            <br>
			            <input name="codigo" id="codigo" type="text" class="form-control" placeholder="Codigo de verificación" required>
			            <br>
			             <input name="verificar" id="verificar" type="text" class="form-control" placeholder="Repita codigo" required>
			            <br>
			            <button class="btn btn-lg btn-primary btn-block" type="submit">Modificar libro</button>
					</form>
				</div>
			</div>
	    </div>
    </div>  
</body>
</html>