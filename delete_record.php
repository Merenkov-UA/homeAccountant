<?php

if(! empty( $_GET[ 'dtl' ] ) ) {
	@include_once "classes/record.php" ;
	
	if( ! class_exists( "Record" ) ) 
		echo "Ошибка подключения класса Record" ;
	else {
		
	$records = new Record( ) ;
	$d_records = $records->delete_from_db($_GET[ 'dtl' ]) ;
	
	echo "<script>setInterval(
							()=>{
						var v=countdown.innerText-1;
						if(v<0)window.location='index.php';
						else countdown.innerText=v
					},
					1000
				)</script>
				<div class='container' style='text-align:center;'><h1>Удаление прошло успешно, через несколько секунд вы окажетесь на главной странице</h1>
				<p id='countdown'>3</p></div>" ;
			exit;
	}
}

