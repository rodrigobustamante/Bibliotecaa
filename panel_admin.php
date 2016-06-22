<?php 
	session_start(); 
	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] == "Administrador"){

	}else if(isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] != "Administrador"){
		header('location: index.php');
	}else{
		header('location: login.html');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inicio</title>
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
    	<h3>Panel de administrador</h3>
    	<div>
    		En este panel es donde se agregan libros, se modifican o eliminan estos, solo el administrador y los bibliotecarios tienen acceso a este, es primordial no compartir tu contraseña con nadie.
    		<p>-La administración biblioteca Pablo Neruda.</p>
			<br>
			<br>
    		<p>Usuario actual: <?php echo $_SESSION["username"];?></p>
    	</div>
    </div>
</body>
</html>