<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "Tb_usuarios";
 
    // object properties
    public $idUsuario;
    public $Email;
    public $Pass;
    public $IdPersona;
    public $IdRol;
    public $Hash;
  
    
  
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read users
function read(){
     
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . "";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

function readOne(){
     
          $query = "SELECT
                   idUsuario_usuario,email_usuario,id_persona_usuario,id_rol_usuario
                FROM
                    " . $this->table_name . " 
                WHERE
                idUsuario_usuario = ?
                ";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        //$stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(1, $this->idUsuario);

       
        // execute query
         $stmt->execute();
         if($stmt->rowCount() > 0){ 
                // // get retrieved row
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         //echo $row['idUsuario'];
     
         // // set values to object properties
          $this->idUsuario = $row['idUsuario_usuario'];
          $this->Email = $row['email_usuario'];
          $this->IdPersona = $row['id_persona_usuario'];
          $this->IdRol = $row['id_rol_usuario'];
         }
    }

    // login
function login(){
     

         $query = "SELECT 
                         idUsuario_usuario, email_usuario, id_persona_usuario,id_rol_usuario,pass_usuario
                   FROM
                     " . $this->table_name . "
                 WHERE
                     email_usuario = '".$this->Email."'
               ";

     $stmt = $this->conn->prepare($query);
    
      $stmt->execute();
    if($stmt->rowCount() > 0){ 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->idUsuario = $row['idUsuario_usuario'];
    $this->Email = $row['email_usuario'];
    $this->IdPersona = $row['id_persona_usuario'];
    $this->IdRol = $row['id_rol_usuario'];
    $this->Hash = $row['pass_usuario'];

    }
    
         
      }

  
function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email_usuario=:email, pass_usuario=:pass, id_persona_usuario=:idpersona, 
                    id_rol_usuario=:idrol";
     
        // prepare query
        $stmt = $this->conn->prepare($query);

        $opciones = [
            'cost' => 12,
        ];
        //Secho password_hash($this->Pass, PASSWORD_BCRYPT, $opciones)."\n";

        // sanitize
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Pass=htmlspecialchars(strip_tags(password_hash($this->Pass, PASSWORD_BCRYPT, $opciones)));
        $this->IdPersona=htmlspecialchars(strip_tags($this->IdPersona));
        $this->IdRol=htmlspecialchars(strip_tags($this->IdRol));

        
    
        // bind values
        $stmt->bindParam(":email", $this->Email);
        $stmt->bindParam(":pass", $this->Pass);
        $stmt->bindParam(":idpersona", $this->IdPersona);
        $stmt->bindParam(":idrol", $this->IdRol);
       
     
        // execute query
        if($stmt->execute()){
             
      
            return true;
        }
     
        return false;
    }

function changePass(){

        // query to insert record
        $query = 
                   "UPDATE " . $this->table_name . " 
                    SET pass_usuario = :pass
                    Where idUsuario_usuario = :idUsuario
                    AND email_usuario=:email";
     
        // prepare query
        $stmt = $this->conn->prepare($query);

        $opciones = [
            'cost' => 12,
        ];
        //Secho password_hash($this->Pass, PASSWORD_BCRYPT, $opciones)."\n";

        // sanitize
        $this->Pass=htmlspecialchars(strip_tags(password_hash($this->Pass, PASSWORD_BCRYPT, $opciones)));
        $this->idUsuario=htmlspecialchars(strip_tags($this->idUsuario));
        $this->Email=htmlspecialchars(strip_tags($this->Email));

        
    
        // bind values
        $stmt->bindParam(":pass", $this->Pass);
        $stmt->bindParam(":idUsuario", $this->idUsuario);
        $stmt->bindParam(":email", $this->Email);
       
     
        // execute query
        if($stmt->execute()){
             
      
            return true;
        }
     
        return false;
    }





function existe(){
     
        $query = "SELECT
                 idUsuario_usuario
              FROM
                  " . $this->table_name . " 
              WHERE
                  email_usuario = ?
              ";
   
      // prepare query statement
      $stmt = $this->conn->prepare( $query );
   
      // bind id of product to be updated
      //$stmt->bindParam(1, $this->id_usuario);
      $stmt->bindParam(1, $this->Email);

     
      // execute query
       $stmt->execute();
       if($stmt->rowCount() > 0){ 
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       // // set values to object properties
        $this->idUsuario = $row['idUsuario_usuario'];
       }
  }

function sendEmailRecover(){
    $query = "SELECT 
        idUsuario_usuario, email_usuario, id_persona_usuario,id_rol_usuario,pass_usuario
    FROM
    " . $this->table_name . "
    WHERE
    email_usuario= '".$this->Email."'
    ";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();
    if($stmt->rowCount() > 0){ 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->idUsuario = $row['idUsuario_usuario'];
    $this->Email = $row['email_usuario'];
    $this->IdPersona = $row['id_persona_usuario'];
    $this->IdRol = $row['id_rol_usuario'];
    $this->Hash = $row['pass_usuario'];

    }

  }


}