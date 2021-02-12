<?php
	include_once "../conexion.php";
	if (isset ($_GET['id_articulo'])){
		$id_articulo=(int)$_GET['id_articulo'];
		$delete_articulo= $con-> prepare('DELETE FROM articulos WHERE id_articulo=:id_articulo');
		$delete_articulo-> execute(array(':id_articulo'=>$id_articulo));
		header ('location: inventario.php');
	} else {
	    header ('location: inventario.php');
	}
?>