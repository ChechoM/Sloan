<?php
	include_once "../conexion.php";
	if (isset ($_GET['id_incidencia'])){
		$id_incidencia=(int)$_GET['id_incidencia'];
		$delete_incidencia= $con-> prepare('DELETE FROM incidencias WHERE id_incidencia=:id_incidencia');
		$delete_incidencia-> execute(array(':id_incidencia'=>$id_incidencia));
		header ('location: inciencia.php');
	} else {
	    header ('location: inciencia.php');
	}
?>