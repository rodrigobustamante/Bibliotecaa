<?php 
	session_start(); 
	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] != "Administrador"){

	}else if(isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true & $_SESSION["username"] == "Administrador"){
		header('location: panel_admin.php');
	}else{
		header('location: login.html');
	}
?>

<!DOCTYPE html>
<html>
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
	    <h3>Bienvenido!</h3>
	    <div>
			En este portal podras revisar el stock de los libros que deseas, ademas de solicitarlos y devolverlos por este mismo medio.
			Lo unico que necesitas ser alumno o funcionario del liceo Pablo Neruda y no tener retrasos con la devolución de libros.
			<p>-La administración.</p>
	    </div>
    </div>  
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$('.dropdown-toggle').dropdown();
    </script>
</body>
</html>