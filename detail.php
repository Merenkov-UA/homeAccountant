<?php

if(! empty( $_GET[ 'dtl' ] ) ) {
	@include_once "classes/record.php" ;
	
	if( ! class_exists( "Record" ) ) 
		echo "Ошибка подключения класса Record" ;
	else {
		
	$records = new Record( ) ;
	$d_records = $records->load_by_id($_GET[ 'dtl' ]) ;
	
	include "view/detail_records_view.php";
	exit ;
	}
}

echo "<h1 style='color:tomato;transform:rotate(20deg);margin-top:30vh;text-align:center'>404</h1>" ;
