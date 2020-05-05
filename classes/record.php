<?php
class Record{
	public $id            ;
	public $title     	  ;
	public $description   ;
	public $operation	  ;
	public $dt_create     ;
	public $dt_edit       ;
	public $id_author     ;
	
	private $DB ;


	function __construct( $data = null ) {		
		@include "db_ini.php";
		if( empty( $db_type ) ) {
			throw new Exception( "Ошибка подключения к базе" ) ;
		}
		
		$conStr = "$db_type:host=$db_host;dbname=$db_name;charset=$db_enc;";
		
		try{
			$this->DB = new PDO( $conStr, $db_user, $db_pass ) ;
			$this->DB ->setAttribute(
				PDO::ATTR_ERRMODE, 
				PDO::ERRMODE_EXCEPTION
			) ;
		}
		catch( PDOException $ex ) {
			throw $ex;
		}
		
		if( is_array( $data ) ) {
			$this->load_from_array( $data ) ;
		}
	}


	function update_record( $data = null ) {
		if( empty( $this->DB ) )
			return false ;
		
		if( is_array( $data ) ) 
			$this->load_from_array( $data ) ;
			
		$prepared_sql = "UPDATE records SET
			title         = ? , 
			description   = ? , 
			operation     = ? ,
			dt_edit       = date('F j, Y, g:i a')
			WHERE id = ?
		" ;
		$prepared_que = $this->DB->prepare( $prepared_sql ) ;
		$prepared_que->execute( [ 
			$this->title         ,
			$this->description   ,
			$this->operation	 ,
			$this->id
		] ) ;
		return true ;
	}

	

	function load_by_id( $ID ) {
		if( empty( $this->DB ) )
			return false ;
		$data = $this
			->DB
			->query( "SELECT * FROM records WHERE id = $ID" )
			->fetch( PDO::FETCH_ASSOC ) ;
		if( empty( $data ) )
			return false ;

		return $data ;
	}

	function get_all_records( ) {
		if( empty( $this->DB ) )
			return false ;
		
		$all_records = $this->DB->query( "SELECT * FROM records" ) ;
		$ret = [] ;
		while( $records = $all_records->fetch( PDO::FETCH_ASSOC ) ) {
			$ret[] = $records ;
		}
		return $ret ;
	}

	function get_all_recordsById( $authorID) {
		if( empty( $this->DB ) )
			return false ;
		
		$all_records = $this->DB->query( "SELECT * FROM records WHERE id_author = $authorID" ) ;
		$ret = [] ;
		while( $records = $all_records->fetch( PDO::FETCH_ASSOC ) ) {
			$ret[] = $records ;
		}
		return $ret ;
	}

	function delete_from_db($ID){
		if( empty( $this->DB ) )
			return false ;
		$query = "DELETE FROM records WHERE id = $ID";
		$this->DB->
			exec($query);
	}
	

	function __dump() {
		return 
			'id'            . ' : ' . ($this->id            ?? '--' ) . '<br>' .
			'title'      	. ' : ' . ($this->title         ?? '--' ) . '<br>' .
			'description'   . ' : ' . ($this->description   ?? '--' ) . '<br>' .
			'operation'     . ' : ' . ($this->operation	    ?? '--' ) . '<br>' .
			'dt_create'     . ' : ' . ($this->dt_create     ?? '--' ) . '<br>' .
			'dt_edit'       . ' : ' . ($this->dt_edit       ?? '--' ) . '<br>' .
			'id_author'     . ' : ' . ($this->id_author     ?? '--' ) . '<br>' 
		;
	}

	function add_to_db( $data = null ) {
		if( empty( $this->DB ) )
			return false ;
		
		if( is_array( $data ) ) 
			$this->load_from_array( $data ) ;
			
		$prepared_sql = "INSERT INTO records
				(title, description, operation, dt_create,     id_author)
		VALUES(		?,     ?,          ?,     CURRENT_TIMESTAMP ,  ? )
		" ;
		$prepared_que = $this->DB->prepare( $prepared_sql ) ;
		$prepared_que->execute( [ 
			$this->title    	 ,
			$this->description   ,
			$this->operation 	 ,
			$this->id_author
			
		] ) ;
		return true ;
	}

	function load_from_array( $data ) {
		if( isset( $data[ 'id'             ] ) ) $this->id             = $data[ 'id'           ];
		if( isset( $data[ 'title'      	   ] ) ) $this->title      	   = $data[ 'title'        ];
		if( isset( $data[ 'description'    ] ) ) $this->description    = $data[ 'description'  ];
		if( isset( $data[ 'operation'      ] ) ) $this->operation      = $data[ 'operation'    ];
		if( isset( $data[ 'dt_create'      ] ) ) $this->dt_create      = $data[ 'dt_create'    ];
		if( isset( $data[ 'dt_edit'        ] ) ) $this->dt_edit        = $data[ 'dt_edit'      ];
		if( isset( $data[ 'id_author'      ] ) ) $this->id_author      = $data[ 'id_author'    ];
		
	}
}


