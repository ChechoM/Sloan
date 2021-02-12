<?php
	include_once "../conexion.php";
	if (isset ($_GET['id_prestamo'])){
		$id_prestamo=(int)$_GET['id_prestamo'];
		$delete_prestamo= $con-> prepare('DELETE FROM prestamos WHERE id_prestamo=:id_prestamo');
		$delete_prestamo-> execute(array(':id_prestamo'=>$id_prestamo));
		header ('location:prestamo.php');
	} else {
	    header ('location:prestamo.php');
	}
?>