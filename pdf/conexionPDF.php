<?php
	$mysqli = new mysqli('localhost', 'root', '', 'proyectosloan');
	if($mysqli->connect_error){
		die('Error en la conexion' . $mysqli->connect_error);
	}
?>