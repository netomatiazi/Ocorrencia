<?php
	require_once 'controle/funcao.php';
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );

	$con = mysql_connect( 'localhost', 'root', '' ) ;
	mysql_select_db( 'ocorrencia', $con );

	$categoria = mysql_real_escape_string( $_GET['idcategoria'] );	
	$subcategoria= array();

	$sql = "SELECT s.idsubcategoria, s.tipo
			FROM subcategoria s
			INNER JOIN categoria c ON (s.idcategoria = c.idcategoria)
			WHERE s.idcategoria=$categoria";
			
	$res = mysql_query( $sql );
	while ( $row = mysql_fetch_assoc( $res ) ) {
		$subcategoria[] = array(
			'idsubcategoria'	=> $row['idsubcategoria'],
			'tipo'			=> $row['tipo'],
		);
	}

	echo( json_encode( $subcategoria));
?>