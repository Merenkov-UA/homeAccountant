<?php
session_start( ) ;
// Проверка переданных данных
$title = "";
$description = "";
$operation = "";
$msg = [];
$add_ok = false ;
@include_once "classes/record.php" ;
if( ! class_exists( "Record" ) ) 
	$msg[] = "Ошибка подключения класса Record" ;
else {
$records = new Record( ) ;




if( ! empty( $_POST ) ) {
	// Валидация данных
	if( empty( $_POST[ 'title' ] ) ) {
		$msg[] = "Необходимо указать название" ;
	}
	if( empty( $_POST[ 'description' ] ) ) {
		$msg[] = "Необходимо указать описание" ;
	}
	if( empty( $_POST[ 'operation' ] ) ) {
		$msg[] = "Необходимо указать сумму операции" ;
	}
	if( empty($_SESSION[ 'userid' ]) ) {
		$msg[] = "Необходимо указать автора" ;
	}
	
	if( ! empty( $msg ) ) {
		$title       = $_POST[ 'title' ]      ;
		$description  = $_POST[ 'description' ] ;
		$operation    = $_POST[ 'operation' ]   ;

		
	} else {
		
			$records->load_from_array( [
				'title'          => $_POST[ 'title' ]       ,
				'description'    => $_POST[ 'description' ] ,
				'operation'      => $_POST['operation']     ,
				'dt_create'      => date( "Y-m-d H:i:s" )   ,
				'id_author'      =>   $_SESSION[ 'userid' ]                 
				
			] ) ;

			try {
				$records->add_to_db( ) ;
				$add_ok = true ;
			} catch( Exception $ex ) {
				$msg[] = "Ошибка добавления записи: " . $ex->getMessage( ) ;
			}
		
	}
	 
	
}
}
// Отображение
include "view/records_add_view.php" ;