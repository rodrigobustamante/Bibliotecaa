<?php
	namespace Biblioteca;

	use \Biblioteca\Conexion;

	class BibliotecaDAO{

		public function __construct(){
			$conexion = (new Conexion())->crearConexion();
		}

		public function recuperarPorUsuario($usuario){	//recibe clase usuario
			$sql = "select * from biblioteca where = ?";
			$sentencia = $conexion->prepare($sql);
			$sentencia->bind_param("s", $usuario["idUsuario"]);
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			if($fila = $resultado->fetch_assoc()){
				return new Bilioteca($fila);
			}
			return false;
		}

		public function recuperarPorLibro($libro){	//recibe clase libro
			$sql = "select * from biblioteca where = ?";
			$sentencia = $conexion->prepare($sql);
			$sentencia->bind_param("s", $libro["idLibro"]);
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			if($fila = $resultado->fetch_assoc()){
				return new Bilioteca($fila);
			}
			return false;
		}

		public function listaMorosos(){
			try{
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "select u.nombre, u.apellido, l.titulo, b.fecha_devolucion
				 from biblioteca b JOIN usuario u
				 on b.idUsuario = u.idUsuario
                 join libro l 
                 on b.idLibro = l.idLibro
                 where b.estado = true";
				$sentencia = $conexion->prepare($sql);
				$exito = $sentencia->execute();
				if($exito){
					$resultado = $sentencia->get_result();
					return $resultado;
				}
			} catch(Exception $e){
				return false;
			}
		}

	}

?>