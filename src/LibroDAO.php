<?php 
	namespace Biblioteca;

	use \Biblioteca\Conexion;

	class LibroDAO{

		public function __construct(){
		}

		public function recuperarPorCodigo($codigo){
			$factory = new Conexion();
			$conexion = $factory->crearConexion();
			$sql = "select * from libro where codigo = ?";
			$sentencia = $conexion->prepare($sql);
			$sentencia->bind_param("s", $codigo);
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			if($fila = $resultado->fetch_assoc()){
				return new Libro($fila);
			}
			return false;
		}

		public function catalogo(){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "select * from libro";
				$sentencia = $conexion->prepare($sql);
				$exito = $sentencia->execute();
				if($exito){
					$resultado = $sentencia->get_result();
					while($fila = $resultado->fetch_assoc()){
						echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["titulo"] . "</font></td>";
					    echo "<td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["autor"] . "</font></td>";
					    echo "<td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["anio"] . "</font></td>";
					    echo "<td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["codigo"]. "</font></td>";
						echo "<td width=\"25%\"><font face=\"verdana\">" . 
							$fila["stock"]. "</font></td></tr>";
					}
				}else{
					echo"<script type=\"text/javascript\">alert('Actualmente no tenemos libros disponibles'); window.location='catalogo.php';</script>";
				}
				return true;	
			} catch (Exception $e) {
				return false;
			}
		}
	}