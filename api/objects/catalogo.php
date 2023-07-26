<?php
class Catalogo{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_catalogosDet";
 
    // object properties
    public $IdMae;
    public $IdDet;
    public $Descripcion;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function readById(){
        // select all query
        $query = 
                "SELECT 
                    `descripcion_catalogoDet` 
                    FROM 
                    " . $this->table_name . " 
                    WHERE `estatus_catalogoDet` = 171
                    AND `id_catalogoDet` = '".$this->IdDet."'";

        // prepare query statement
        //echo $query;
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->Descripcion = $row['descripcion_catalogoDet'];
        }
    }
}