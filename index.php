<?php  
 session_start( ) ;

 if( isset( $_GET[ 'logout' ] ) ) {
	unset( $_SESSION[ 'userid' ] ) ;
	header( "Location: index.php" ) ;
	exit ;
}

if(!empty($_SESSION[ 'userid' ]))
{
		@include_once "classes/user.php";
	if(!class_exists("User"))
		echo "Ошибка подключения класса User";
	
	else{
		$users= new User();
		$res=$users->loadUserDataById( $_SESSION[ 'userid' ] ) ;
		if($res!==true)
		{
			$users=null;
		}
	}
}

	@include_once "classes/record.php" ;
	if( ! class_exists( "Record" ) ) 
		echo "Ошибка подключения класса Record" ;
	else {
		$records = new Record( ) ;
		if(!empty($users))
		$all_records = $records->get_all_recordsById( $_SESSION[ 'userid' ] ) ;
	else{
		$all_records['title'] = "";
		$all_records['description'] = "";

	}

	

	include "view/index_view.php";
	exit ;
}

