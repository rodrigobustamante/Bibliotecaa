<?php 
	namespace Biblioteca;

	class Libro{
		private $titulo;
		private $anio;
		private $codigo;
		private $autor;
		private $stock;
		private $cantidad;
	
		public function __construct($datosLibro = array()){
			$this->titulo = "";
			$this->anio = "";
			$this->codigo = "";
			$this->autor = "";
			$this->stock = "";
			$this->cantidad = "";

			if(is_array($datosLibro) && (count($datosLibro) > 0)){

				if(isset($datosLibro["titulo"])){
				$this->titulo = $datosLibro["titulo"];	
				}
				if(isset($datosLibro["anio"])){
					$this->anio = $datosLibro["anio"];	
				}
				if(isset($datosLibro["codigo"])){
					$this->codigo = $datosLibro["codigo"];	
				}
				if(isset($datosLibro["autor"])){
					$this->autor = $datosLibro["autor"];
				}
				if(isset($datosLibro["stock"])){
					$this->stock = $datosLibro["stock"];
				}
				if(isset($datosLibro["cantidad"])){
					$this->cantidad = $datosLibro["cantidad"];
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
		public function solicitar($codigo){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$stock = $this->stock;
				if($stock > 0) {
					$sql1 = "update libro set stock = (stock - 1) where codigo = ?";
					$sentencia = $conexion->prepare($sql1);
					$sentencia->bind_param("s", $codigo);
					$exito = $sentencia->execute();
					if($exito){
						echo"<script type=\"text/javascript\">alert('Libro con codigo $codigo solicitado correctamente, dirijase a la biblioteca para retirarlo'); window.location='solicitar.php'; </script>";
					}
				}else{
					echo"<script type=\"text/javascript\">alert('Este libro no se encuentra disponible'); window.location='solicitar.php'; </script>";
				}
				
			} catch (Exception $e) {
				
			}
		}

		public function devolver($codigo){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$stock = $this->stock;
				$cantidad = $this->cantidad - 1;
				$sql1 = "update libro set stock = (stock + 1) where codigo = ?";
				$sentencia = $conexion->prepare($sql1);
				$sentencia->bind_param("s", $codigo);
				if($stock <= $cantidad){	
					$exito = $sentencia->execute();
					if($exito){
						echo"<script type=\"text/javascript\">alert('Libro con codigo $codigo devuelto correctamente, dirijase a la biblioteca para devolverlo'); window.location='devolver.php'; </script>";
					}
				}else{
					echo"<script type=\"text/javascript\">alert('Este libro ya fue devuelto'); window.location='devolver.php'; </script>";
				}				
			} catch (Exception $e) {
				
			}
		}

		public function modificar($titulo, $autor, $anio, $stock, $cantidad, $codigo){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "update libro set titulo = ?, autor = ?, anio = ?, stock = ?, cantidad = ? where codigo = ? ";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bind_param("ssiiis", $titulo, $autor, $anio, $stock, $cantidad, $codigo);
				$sentencia->execute();
				return true;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function eliminar($codigo){
			try {
				$factory = new Conexion();
				$conexion = $factory->crearConexion();
				$sql = "delete from libro where codigo = ?";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bind_param("s", $codigo);
				$sentencia->execute();
				return true;	
			} catch (Exception $e) {
				return false;
			}	
		}		
	}