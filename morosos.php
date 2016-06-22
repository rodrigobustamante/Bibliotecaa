<?php 
	session_start(); 
	use \Biblioteca\BibliotecaDAO;
	require_once __DIR__ . "/vendor/autoload.php"; 

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
	<title>Morosos</title>
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
    	<table class="table table-condense">
    		<tr>
    			<th>Nombre</th>
    			<th>Apellido</th>
    			<th>Libro</th>
    			<th>Fecha Devolucion</th>
    		</tr>
    		<?php
    			$morosos = (new BibliotecaDAO())->listaMorosos();
    			if(count($morosos) > 0){
	    			foreach ($morosos as $usuario) {
	    				echo "<tr><td width='25%'>" . $usuario["nombre"] . "</td>";
	    				echo "<td width='25%'>" . $usuario["apellido"] . "</td>";
	    				echo "<td width='25%'>" . $usuario["titulo"] . "</td>";
	    				echo "<td width='25%'>" . $usuario["fecha_devolucion"] . "</td></tr>";
	    			}
	    		}
	    		else{
	    			echo "No usuario morosos";
	    		}
    		?>
    	</table>
    </div>  
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$('.dropdown-toggle').dropdown();
    </script>
</body>
</html>