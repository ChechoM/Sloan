<?php
	include 'plantilla.php';
	require 'conexionPDF.php';
	
	$query = "SELECT * FROM incidencias";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(35,6,'Id. Incidencia',1,0,'C',1);
	$pdf->Cell(40,6, utf8_decode('Id. Devolución'),1,0,'C',1);
	$pdf->Cell(40,6,'Tipo Incidencia',1,0,'C',1);
	$pdf->Cell(75,6,'Observaciones',1,1,'C',1);

	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc()) {
		$pdf->Cell(35,6,utf8_decode($row['id_incidencia']),1,0,'C');
		$pdf->Cell(40,6,$row['id_det_devolucion'],1,0,'C');
		$pdf->Cell(40,6,utf8_decode($row['tipo_incidencia']),1,0,'C');
		$pdf->Cell(75,6,utf8_decode($row['observaciones']),1,1,'C');
	}
	$pdf->Output();
?>
