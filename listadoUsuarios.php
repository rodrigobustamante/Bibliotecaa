<?php 
	session_start(); 
	use \Biblioteca\Conexion;
	use \Biblioteca\UsuarioDAO;
	require_once __DIR__ . "/vendor/autoload.php"; 
	if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true){
	}else{
		header('location: login.html');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado de usuarios</title>
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
	    <h3>Catalogo:</h3>
	    <div>
	    	<table class="table table-condense">
	    		<tr>
					<td><font face="verdana"><b>Nombre</b></font></td>
					<td><font face="verdana"><b>Apellido</b></font></td>
					<td><font face="verdana"><b>Nombre de Usuario</b></font></td>
					<?php 
						$dao = new UsuarioDAO();
						$listar = $dao->listar();
					?>
				</tr>
			</table>
	    </div>
    </div>  
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$('.dropdown-toggle').dropdown();
    </script>
</body>
</html>