<?php 
	namespace Biblioteca;
	
	class UsuarioDAO{
		private $conexion;

		public function __construct(){
			$conexion = (new Conexion())->crearConexion();
		}

		public function recuperarPorUsuario($usuario){
			$factory = new Conexion();
			$conexion = $factory->crearConexion();
			$sql = "select nombre, apellido, usuario, password from usuario where usuario = ?";
			$sentencia = $conexion->prepare($sql);		
			$sentencia->bind_param("s", $usuario);
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			if($fila = $resultado->fetch_assoc()){
				return new Usuario($fila);
			}
			return false;
		}

		public function guardar($datosUsuario){
			$usuario = $datosUsuario->toArray();
			if(is_null($usuario["usuario"])){
				return $this->insertar($usuario);
			}else{
				return $this->actualizar($usuario);
			}
		}

		public function listar(){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "select * from usuario";
				$sentencia = $conexion->prepare($sql);
				$exito = $sentencia->execute();
				if($exito){
					$resultado = $sentencia->get_result();
					while($fila = $resultado->fetch_assoc()){
						echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["nombre"] . "</font></td>";
					    echo "<td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["apellido"] . "</font></td>";
					    echo "<td width=\"25%\"><font face=\"verdana\">" . 
						    $fila["usuario"] . "</font></td>";
						}
					}else{
						echo"<script type=\"text/javascript\">alert('No hay usuarios creados'); window.location='listadoUsuarios.php';</script>";
					}
			} catch (Exception $e) {
				return false;
			}
		}

		public function insertar($datosUsuario){
			$factory = new Conexion();
			$conexion = $factory->crearConexion();
			$sql = "insert into usuario (nombre, apellido, usuario, password) values (?,?,?,?)";
			$sentencia = $conexion->prepare($sql);
			$sentencia->bind_param("ssss",
				$datosUsuario["nombre"],
				$datosUsuario["apellido"],
				$datosUsuario["usuario"],
				$datosUsuario["password"]);
		}

		public function eliminar($datosUsuario){
			$factory = new Conexion();
			$conexion = $factory->crearConexion();
			$sql = "delete from usuario where usuario = ? and password = ?";
			$sentencia = $conexion->prepare($sql);
			$sentencia->bind_param("ss",
				$datosUsuario["usuario"],
				$password["password"]);
		}
	}