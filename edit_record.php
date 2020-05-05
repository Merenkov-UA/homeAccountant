<?php


$title ="";
$description ="";
$operation = "";
$msg = [];
if( empty( $_GET[ 'dtl' ] ) ) {
	echo "Недостаточно данных" ;
	exit ;
}

$record_id = intval( $_GET[ 'dtl' ] ) ;
if( empty( $record_id ) ) {
	echo "Неправильные данные" ;
	exit ;
}

@include_once "classes/record.php" ;
if( ! class_exists( "Record" ) ) {
	echo "Ошибка подключения класса Record" ;
	exit ;
}

$records = new Record( ) ;
if( $records->load_by_id( $record_id ) === false ) {
	echo "Запись не найдена" ;
	exit ;
}
$all_records = $records->get_all_records( ) ;
if(!empty($_POST)){
	
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
	
	
	if( ! empty( $msg ) ) {
		$title       = $_POST[ 'title' ]      ;
		$description  = $_POST[ 'description' ] ;
		$operation    = $_POST[ 'operation' ]   ;

		
	} else {
		
			$records->load_from_array( [
				'title'          => $_POST[ 'title' ]       ,
				'description'    => $_POST[ 'description' ] ,
				'operation'      => $_POST['operation']     ,
				'dt_edit'      	 => date('F j, Y, g:i a')   ,
				'id'     		 =>  $record_id                  
				
			] ) ;

			try {
				$res = $records->update_record();
				$add_ok = true ;
			} catch( Exception $ex ) {
				$msg[] = "Ошибка редактирования записи: " . $ex->getMessage( ) ;
			}
			echo "<script>setInterval(
						()=>{
					var v=countdown.innerText-1;
					if(v<0)window.location='index.php';
					else countdown.innerText=v
				},
				1000
			)</script>
			<div class='container' style='text-align:center;'><h1>Данные приняты, через несколько секунд вы окажетесь на главной странице</h1>
			<p id='countdown'>3</p></div>" ;
			exit; 


		
	}


	}



@include_once "classes/user.php";
if( ! class_exists( "User" ) ) {
	echo "Ошибка подключения класса User" ;
	exit ;
}

$user = new User( ) ;
 $user->loadUserDataById($records->id_author );


$workmode = "edit" ;
$rid = $record_id;

$title = $records->title;
$description = $records->description;
$operation = $records->operation;

$add_ok = false ;




include "view/records_add_view.php" ;
