<?php 
	session_start(); 
	use \Biblioteca\Conexion;
	use \Biblioteca\LibroDAO;
	require_once __DIR__ . "/vendor/autoload.php"; 
	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] != "Administrador"){

	}else if(isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] == "Administrador"){
		header('location: panel_admin.php');
	}else{
		header('location: login.html');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$codigo = isset($_POST["codigo"])? trim($_POST["codigo"]):"";
		$dao = new LibroDAO();
		$libroADevolver = $dao->recuperarPorCodigo($codigo);
		if($libroADevolver){
			if($libroADevolver->devolver($codigo)){
			}
		}else{
			echo"<script type=\"text/javascript\">alert('Codigo no ingresado');</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Devolver libro</title>
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
	            <h1 class="text-center login-title">Devolver libro:</h1>
	            <div class="account-wall">
	                <form method="POST">
	                <input name="codigo" id="codigo" type="text" class="form-control" placeholder="Ingresa codigo de libro a devolver" required autofocus>
	                <br>
	                <button id="boton" class="btn btn-lg btn-primary btn-block" type="submit">Devolver</button>
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