<?php

class User{
    public $id;
    public $firstname;
    public $lastname;
    public $surname;
    public $email;
    public $login;
    public $pass_hash;
    public $pass_salt;
    public $registered;
    public $last_login;

    function __construct($dbLink = null){
        if($dbLink == null){
            unset($db_type);
            @include "db_ini.php";
            if(empty($db_type)){
                echo"Ошибка подключения";
                exit;
            }
            
            $conStr = "$db_type:host=$db_host;dbname=$db_name;charset=$db_enc;";
            
            try{
                $this->DB = new PDO($conStr, $db_user, $db_pass);
                $this->DB ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $ex){
                throw $ex;
            }

        }
        else{
            $this->DB = $dbLink;
        }
    }
    
    function load_from_array( $data ) {
        if( ! is_array( $data ) ) return false ;
        if( isset( $data['firstname'] ) ) $this->firstname = $data['firstname'];
        if( isset( $data['lastname']  ) ) $this->lastname  = $data['lastname'];
        if( isset( $data['surname']    ) ) $this->surname    = $data['surname'];
        if( isset( $data['email']      ) ) $this->email      = $data['email'];  
        if( isset( $data['login']      ) ) $this->login      = $data['login'];
        if( isset( $data['pass_hash']  ) ) $this->pass_hash  = $data['pass_hash'];
        if( isset( $data['pass_salt']  ) ) $this->pass_salt  = $data['pass_salt'];
        if( isset( $data['registered']  ) ) $this->pass_salt  = $data['registered'];
        if( isset( $data['lastlogin']  ) ) $this->pass_salt  = $data['lastlogin'];
    }

   function update_last_login( ) {
        if( empty( $this->DB ) ) return false ;
        if( empty( $this->id ) ) return false ;
        return $this->DB->query( 
            "update users set lastlogin = current_timestamp where id = " . $this->id 
        ) ;
    }

    function register_user( $data = null ) {
        
        if( empty( $this->DB ) ) return false ;
        
        if( is_array( $data ) ) {
            $this->load_from_array( $data ) ;
        }
        $sql = "INSERT INTO users( 
            firstname, lastname, surname, email, login, pass_hash, pass_salt,       registered  )
        VALUES( ?,        ?,        ?,      ?,       ?,         ?,      ?,      CURRENT_TIMESTAMP )" ;
            
        $prepared = $this->DB->prepare( $sql ) ;
        
        // Вносим данные из полей объекта
        $prepared->execute( [
            $this->firstname,
            $this->lastname ,
            $this->surname   ,
            $this->email     ,
            $this->login     ,
            $this->pass_hash ,
            $this->pass_salt 
        ] ) ;
    }

    function isLoginFree($login){
        if(empty($login)) return false;

        $query = "SELECT COUNT(ID) FROM users
                  WHERE login = '$login'";
        $answer = $this->DB->query($query);
        $n = ($answer->fetch(PDO::FETCH_NUM))[0];
        return $n == 0;
    }

    function isAuthorized($login, $pass){
        if(empty($this->DB)) return false;
        
        $query = "SELECT * FROM users WHERE login = '$login'";
        $answer = $this->DB->query($query);

        $userdata = $answer->fetch(PDO::FETCH_ASSOC);
        if(empty($userdata)){
            return false;
        }

        if( hash( 'SHA256', $pass . $userdata['pass_salt'] ) 
            != $userdata['pass_hash']
        ) {
            return false;
        }
        
        $this->id = $userdata['id'];
        
        return true ;
    }


function loadUserDataById( $id ) {
        if( empty( $this->DB ) ) return false ;
        if( empty( $id ) ) return false ;
        $res = $this->DB->query( 
            "SELECT * FROM users WHERE id = " . $id
        ) ;
        $row = $res->fetch( PDO::FETCH_ASSOC ) ;
        if( empty( $row ) ) return false ;
        $this->id = $id ;
        $this->firstname       = $row['firstname'];
        $this->lastname        = $row['lastname'];
        $this->surname          = $row['surname'];
        $this->email            = $row['email'];
        $this->login            = $row['login'];
        $this->registered_time  = $row['registered'];
        $this->last_login       = $row['lastlogin'];
        
        return true ;
    }

};