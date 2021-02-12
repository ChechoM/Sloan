<?php
	include_once "../conexion.php";
	if (isset ($_GET['id_devolucion'])){
		$id_devolucion=(int)$_GET['id_devolucion'];
		$delete_devolucion= $con-> prepare('DELETE FROM devoluciones WHERE id_devolucion=:id_devolucion');
		$delete_devolucion-> execute(array(':id_devolucion'=>$id_devolucion));
		header ('location: devoluciones.php');
	} else {
	    header ('location: devoluciones.php');
	}
?>