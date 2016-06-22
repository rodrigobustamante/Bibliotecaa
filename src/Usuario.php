<?php 
	
	namespace Biblioteca;

	class Usuario{
		private $nombre;
		private $apellido;
		private $usuario;
		private $password;

	public function __construct($datosUsuario = array()){
		$this->nombre = "";
		$this->apellido = "";
		$this->usuario = "";
		$this->password = "";

		if(is_array($datosUsuario) && (count($datosUsuario) > 0)){
			if(isset($datosUsuario["nombre"])){
				$this->nombre = $datosUsuario["nombre"];	
			}
			if(isset($datosUsuario["apellido"])){
				$this->apellido = $datosUsuario["apellido"];	
			}
			if(isset($datosUsuario["usuario"])){
				$this->usuario = $datosUsuario["usuario"];	
			}
			if(isset($datosUsuario["password"])){
				$this->password = $datosUsuario["password"];
			}
		}
	}

		public function toArray(){
			$respuesta = array();
			foreach ($this as $campo => $valor) {
				$respuesta[$campo] = $valor;
			}
			return $respuesta;
		}

		public function buscar($usuario){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "select nombre, apellido, usuario from usuario where usuario = ?";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bind_param("s", $usuario);
				$exito = $sentencia->execute();
				if($exito){
					$resultado = $sentencia->get_result();
					if($resultado->num_rows == 1){
						$user = $resultado->fetch_assoc();
						echo "Se encontro el siguiente usuario : <br>";
						echo "Nombre : " . $user["nombre"] . "<br>";
						echo "Apellido : " . $user["apellido"] . "<br>";
					}else{
						echo"<script type=\"text/javascript\">alert('No se encontro ningun usuario $usuario'); window.location='buscarUsuario.php';</script>";
					}
				}
				return true;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function modificar($nombre, $apellido, $password, $usuario){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "update usuario set nombre = ?, apellido = ?, password = ? where usuario = ? ";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bind_param("ssss", $nombre, $apellido, $password, $usuario);
				$sentencia->execute();
				return true;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function autorizar($validar){
			$password = $this->password;
			if($password == $validar){
				return $password;	
			}
			echo"<script type=\"text/javascript\">alert('Contraseña incorrecta');
			window.location='login.html'; </script>";
		}
	}