<?php

namespace Biblioteca;

class Conexion{

	const DBHOST = "localhost";
	const DBNAME = "biblioteca";
	const DBUSER = "root";
	const DBPASS = "";

	public function crearConexion(){
		$conexion = new \mysqli(self::DBHOST, 
			self::DBUSER, self::DBPASS, self::DBNAME);
		if ($conexion->connect_errno){
			die("No hay conexion a la base de datos");
		}
		return $conexion;
	}
}