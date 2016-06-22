<?php
	namespace Biblioteca;

	class Biblioteca{
		private $usuario; 	//clase usuario
		private $libro;		//clase libro
		private $fecha_pedido;
		private $fecha_devolucion;
		private $estado;

		public funcion __construct($datosBilioteca = array()){ //constructor
			$this->usuario = new Usuario();
			$this->libro = new Libro();
			$this->fecha_pedido = date("dd/mm/yyyy");
			$this->fecha_devolucion = date("dd/mm/yyyy");
			$this->estado = false;

			if(is_array($datosBilioteca) && (count($datosBilioteca) > 0)){
				if(isset($datosBilioteca["usuario"])){
					$this->usuario = $datosBilioteca["usuario"];
				}
				if(isset($datosBilioteca["libro"])){
					$this->libro = $datosBilioteca["libro"];
				}
				if(isset($datosBilioteca["fecha_pedido"])){
					$this->fecha_pedido = $datosBilioteca["fecha_pedido"];
				}
				if(isset($datosBilioteca["fecha_devolucion"])){
					$this->fecha_devolucion = $datosBilioteca["fecha_devolucion"];
				}
				if(isset($datosBilioteca["estado"])){
					$this->estado = $datosBilioteca["estado"];
				}
			}
		} //fin constructor

		public function toArray(){
			$respuesta = array();
			foreach ($$this as $campo => $valor) {
				$respuesta[$campo] = $valor;
			}
			return respuesta;
		}

		public function login(){

		}

		public function prestamo(){

		}

		public function devolucion(){

		}

		public function listaMorosos(){
			try{
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "select * from biblioteca where estado = true";
				$sentencia = $conexion->prepare($sql);
				$exito = $sentencia->execute();
				if($exito){
					return $exito;
				}
				return "No hay morosos";
			} catch{
				return "Error";
			}
		}

		public function busquedaUsuario(){

		}

		public function catalogo(){

		}
	}

?>