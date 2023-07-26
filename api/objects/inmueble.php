<?php
class Inmueble{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_inmuebles";
 
    // object properties
    public $IdInmueble;
    public $NumCredito;
    public $Deudor;
    public $TipoAdquisicion;
    public $IdReoBan;
    public $CuentaCat;
    public $NumFolioReal;
    public $IdEtapa;
    public $IdEstado;
    public $IdMunicipio;
    public $Calle;
    public $CodigoPostal;
    public $M2superficie;
    public $M2construccion;
    public $MontoDeuda;
    public $MontoMin;
    public $MontoVenta;
    public $NumExpediente;
    public $ComentarioRegPub;
    public $ComentarioExpJudicial;
    public $EstatusInm;
    public $Colonia; 
    public $Banos; 
    public $Cochera; 
    public $Dormitorios; 
    public $DescripcionAdicional; 
    public $NumInterior; 
    public $NumExt; 
    public $TipoInmueble;

    public $Etapa;
    public $Estado;
    public $Municipio;

    public $NombreDeudor;
    public $ApellidosDeudor;
    public $NomRec;
    public $NomEstado;
    public $NomMunic;
  
    //Proceso
    public $Idadquisicion;
    public $Idtabsubetapa;
    public $IdProceso;


  
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

function readOne(){
     
    $query = 
      "
      SELECT 
      `numCredit_inmueble`,`nombreDeudor_inmueble`,`apellidosDeudor_inmueble`,`tipoAdquisicion_inmueble`
      ,`id_proveedor_inmueble`, `numFolioReal_inmueble`,`cuentaCat_inmueble`,inm.`estatus_inmueble`,
      `comentRegPub_inmueble`, mun.`id_estado_municipio`,inm.`id_municipio_inmueble`,inm.`calle_inmueble`,
      inm.`codigoPostal_inmueble`, inm.`m2superficie_inmueble`, inm.`m2construccion_inmueble`, 
      `montoDeuda_inmueble`, `montoMin_inmueble`, `montoVenta_inmueble`, `numExpediente_inmueble`, `comentExpJud_inmueble`,
      pro.`nombre_proveedor` as NomProveedor,inm.`id_etapa_inmueble`, et.`descripcion_etapa` as Etapa, 
      est.`nombre_estado` as NomEstado, mun.`nombre_municipio` as NomMunic, inm.`banos_inmueble` as Banos, 
      inm.`cochera_inmueble` as Cochera, inm.`dormitorios_inmueble` as Dormitorios, inm.`descripcionAdicional_inmueble` as DescripcionAdicional,
      inm.`colonia_inmueble`as Colonia, inm.`numInt_inmueble` as NumInterior, inm.`numExt_inmueble` as NumExt
      , inm.`tipo_inmueble` as TipoInmueble
      FROM ". $this->table_name . " inm 
      INNER JOIN tb_proveedores pro ON inm. id_proveedor_inmueble = pro.id_proveedor 
      INNER JOIN tb_etapas et ON et.id_etapa = inm.id_etapa_inmueble
      INNER JOIN tb_municipios mun ON mun.id_municipio = inm.id_municipio_inmueble
      INNER JOIN tb_estados est ON mun.id_estado_municipio = est.id_estado
      WHERE inm.id_inmueble = ?";        
   
      // prepare query statement
      $stmt = $this->conn->prepare( $query );
   
      // bind id of product to be updated
      //$stmt->bindParam(1, $this->id_usuario);
      $stmt->bindParam(1, $this->IdInmueble);

     
      // execute query
       $stmt->execute();
       if($stmt->rowCount() > 0){ 
              // // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       //echo $row['idUsuario'];
   
       // // set values to object properties
        $this->NumCredito = $row['numCredit_inmueble'];
        $this->NombreDeudor = $row['nombreDeudor_inmueble'];
        $this->ApellidosDeudor = $row['apellidosDeudor_inmueble'];
        $this->TipoAdquisicion =$row['tipoAdquisicion_inmueble'];
        $this->IdReoBan=$row['id_proveedor_inmueble'];
        $this->NumFolioReal=$row['numFolioReal_inmueble'];
        $this->CuentaCat=$row['cuentaCat_inmueble'];
        $this->EstatusInm = $row['estatus_inmueble'];
        $this->ComentarioRegPub=$row['comentRegPub_inmueble'];
        $this->IdMunicipio = $row['id_municipio_inmueble'];
        $this->Calle = $row['calle_inmueble'];
        $this->CodigoPostal = $row['codigoPostal_inmueble'];
        $this->M2superficie = $row['m2superficie_inmueble'];
        $this->M2construccion = $row['m2construccion_inmueble'];
        $this->MontoDeuda = $row['montoDeuda_inmueble'];
        $this->MontoMin = $row['montoMin_inmueble'];
        $this->MontoVenta = $row['montoVenta_inmueble'];
        $this->NumExpediente = $row['numExpediente_inmueble'];
        $this->ComentarioExpJudicial = $row['comentExpJud_inmueble'];
        $this->NomRec = $row['NomProveedor'];
        $this->IdEtapa = $row['id_etapa_inmueble'];
        $this->Etapa = $row['Etapa'];
        $this->NomEstado = $row['NomEstado'];
        $this->NomMunic = $row['NomMunic'];

        $this->Colonia = $row['Colonia'];
        $this->Banos = $row['Banos'];
        $this->Cochera = $row['Cochera'];
        $this->Dormitorios = $row['Dormitorios'];
        $this->DescripcionAdicional = $row['DescripcionAdicional'];
        $this->NumInterior = $row['NumInterior'];
        $this->NumExt = $row['NumExt'];
        $this->TipoInmueble = $row['TipoInmueble'];
       }
  }

    // read products
function read(){
     
        // select all query
        $query = 
        "SELECT 
        inm.id_inmueble as IdInmueble,inm.numCredit_inmueble as NumCredito,es.nombre_estado as Estado, mun.nombre_municipio as Municipio
        FROM 
        ". $this->table_name . " inm 
        INNER JOIN tb_municipios mun ON inm.id_municipio_inmueble = mun.id_municipio
		Inner JOIN tb_estados es ON mun.id_estado_municipio = es.id_estado
  ";

     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

function readporproceso(){
     
        // select all query
        $query = 
                "SELECT inm.IdInmueble,NumCredito,est.Nombre as Estado, mun.Nombre as Municipio, inm.MontoDeuda as MontoDeuda
                    FROM inmueble inm
                    INNER JOIN tb_adquisicion adq ON inm.IdInmueble = adq.IdInmueble
                    INNER JOIN tb_estados est ON inm.IdEstado = est.IdEstado
                    INNER JOIN tb_municipios mun ON inm.IdMunicipio = mun.IdMunicipio
                    WHERE adq.IdProceso = :idproceso";

     
        // prepare query statement
        $stmt = $this->conn->prepare($query);

           // sanitize
        $this->IdProceso=htmlspecialchars(strip_tags($this->IdProceso));

         // bind values
         $stmt->bindParam(":idproceso", $this->IdProceso);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }


          // create product
function create(){
     
        // query to insert record
        $query =
        "INSERT INTO 
            " . $this->table_name . "
            (`NumCredito`, `Deudor`, `TipoAdquisicion`, `IdReoBan`, `CuentaCat`, 
        `NumFolioReal`, `IdEtapa`, `IdEstado`, `IdMunicipio`, `Calle`, `CodigoPostal`, `M2superficie`, `M2construccion`, 
        `MontoDeuda`, `MontoMin`, `MontoVenta`,`NumExpediente`, `ComentarioRegPub`, `ComentarioExpJudicial`,`EstatusInmueble`,`Colonia`,
        `Banos`,`Cochera`,`Dormitorios`,`DescripcionAdicional`,`NumInterior`,`NumExt`,`TipoInmueble`) 
        VALUES (:numcredito,:namedeudor,:lastdeudor,:tipodquisicion,:idreoban,:cuentacat,:numfolioreal,:idetapa,
        :idestado,:idmunicipio,:calle,:codigopostal,:m2superficie,:m2construccion,:montoDeuda,:montoMin,:montoVenta,
        :numexpediente,:comentarioregpub,:comentarioexpjudicial,:estatusinm, :Colonia, :Banos, :Cochera, :Dormitorios,
        :DescripcionAdicional, :NumInterior, :NumExt, :TipoInmueble)";

       
        //prepare query
        $stmt = $this->conn->prepare($query);
     

        // sanitize
        $this->numcredito=htmlspecialchars(strip_tags($this->numcredito));
        $this->deudor=htmlspecialchars(strip_tags($this->deudor));
        $this->tipodquisicion=htmlspecialchars(strip_tags($this->tipodquisicion));
        $this->idreoban=htmlspecialchars(strip_tags($this->idreoban));
        $this->cuentacat=htmlspecialchars(strip_tags($this->cuentacat));
        $this->numfolioreal=htmlspecialchars(strip_tags($this->numfolioreal));
        $this->idetapa=htmlspecialchars(strip_tags($this->idetapa));
        $this->idestado=htmlspecialchars(strip_tags($this->idestado));
        $this->idmunicipio=htmlspecialchars(strip_tags($this->idmunicipio));
        $this->calle=htmlspecialchars(strip_tags($this->calle));
        $this->codigopostal=htmlspecialchars(strip_tags($this->codigopostal));
        $this->m2superficie=htmlspecialchars(strip_tags($this->m2superficie));
        $this->m2construccion=htmlspecialchars(strip_tags($this->m2construccion));
        $this->montoDeuda=htmlspecialchars(strip_tags($this->montoDeuda));
        $this->montoMin=htmlspecialchars(strip_tags($this->montoMin));
        $this->montoVenta=htmlspecialchars(strip_tags($this->montoVenta));

        $this->numexpediente=htmlspecialchars(strip_tags($this->numexpediente));
        $this->comentarioregpub=htmlspecialchars(strip_tags($this->comentarioregpub));
        $this->comentarioexpjudicial=htmlspecialchars(strip_tags($this->comentarioexpjudicial));
        $this->estatusinm=htmlspecialchars(strip_tags($this->estatusinm));

        $this->Colonia=htmlspecialchars(strip_tags($this->Colonia)); 
        $this->Banos=htmlspecialchars(strip_tags($this->Banos)); 
        $this->Cochera=htmlspecialchars(strip_tags($this->Cochera)); 
        $this->Dormitorios=htmlspecialchars(strip_tags($this->Dormitorios)); 
        $this->DescripcionAdicional=htmlspecialchars(strip_tags($this->DescripcionAdicional));
        $this->NumInterior=htmlspecialchars(strip_tags($this->NumInterior));
        $this->NumExt=htmlspecialchars(strip_tags($this->NumExt)); 
        $this->TipoInmueble=htmlspecialchars(strip_tags($this->TipoInmueble));
     
        // bind values
        $stmt->bindParam(":numcredito", $this->numcredito);
        $stmt->bindParam(":deudor", $this->deudor);
        $stmt->bindParam(":tipodquisicion", $this->tipodquisicion);
        $stmt->bindParam(":idreoban", $this->idreoban);
        $stmt->bindParam(":cuentacat", $this->cuentacat);
        $stmt->bindParam(":numfolioreal", $this->numfolioreal);
        $stmt->bindParam(":idetapa", $this->idetapa);
        $stmt->bindParam(":idestado", $this->idestado);
        $stmt->bindParam(":idmunicipio", $this->idmunicipio);
        $stmt->bindParam(":calle", $this->calle);
        $stmt->bindParam(":codigopostal", $this->codigopostal);
        $stmt->bindParam(":m2superficie", $this->m2superficie);
        $stmt->bindParam(":m2construccion", $this->m2construccion);
        $stmt->bindParam(":montoDeuda", $this->montoDeuda);
        $stmt->bindParam(":montoMin", $this->montoMin);
        $stmt->bindParam(":montoVenta", $this->montoVenta);
        $stmt->bindParam(":numexpediente", $this->numexpediente);
        $stmt->bindParam(":comentarioregpub", $this->comentarioregpub);
        $stmt->bindParam(":comentarioexpjudicial", $this->comentarioexpjudicial);
        $stmt->bindParam(":estatusinm", $this->estatusinm);
        $stmt->bindParam(":Colonia",$this->Colonia); 
        $stmt->bindParam(":Banos",$this->Banos); 
        $stmt->bindParam(":Cochera",$this->Cochera); 
        $stmt->bindParam(":Dormitorios",$this->Dormitorios); 
        $stmt->bindParam(":DescripcionAdicional",$this->DescripcionAdicional);
        $stmt->bindParam(":NumInterior",$this->NumInterior);
        $stmt->bindParam(":NumExt",$this->NumExt); 
        $stmt->bindParam(":TipoInmueble",$this->TipoInmueble);
     
         
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
}

  

function update(){     
        // query to update record
        $query =
        "UPDATE `inmueble`
        SET
        `NumCredito` = :numcredito,
        `NombreDeudor` = :namedeudor,
        `ApellidosDeudor` = :lastdeudor,
        `TipoAdquisicion` = :tipodquisicion,
        `IdReoBan` = :idreoban,
        `CuentaCat` = :cuentacat,
        `NumFolioReal` = :numfolioreal,
        `IdEstado` = :idestado,
        `IdMunicipio` = :idmunicipio,
        `Calle` = :calle,
        `CodigoPostal` = :codigopostal,
        `M2superficie` = :m2superficie,
        `M2construccion` = :m2construccion,
        `MontoDeuda` = :montoDeuda,
        `MontoMin` = :montoMin,
        `MontoVenta` = :montoVenta,
        `NumExpediente` = :numexpediente,
        `ComentarioRegPub` = :comentarioregpub,
        `ComentarioExpJudicial` = :comentarioexpjudicial,
        `EstatusInmueble` = :estatusinm,
        `Colonia` = :Colonia, 
        `Banos` = :Banos, 
        `Cochera` = :Cochera, 
        `Dormitorios` = :Dormitorios,
        `DescripcionAdicional` = :DescripcionAdicional, 
        `NumInterior` = :NumInterior, 
        `NumExt` = :NumExt, 
        `TipoInmueble`= :TipoInmueble
        WHERE `IdInmueble` = :idinmueble";
        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->IdInmueble=htmlspecialchars(strip_tags($this->IdInmueble));
        $this->NumCredito=htmlspecialchars(strip_tags($this->NumCredito));
        $this->NameDeudor=htmlspecialchars(strip_tags($this->NameDeudor));
        $this->LastDeudor=htmlspecialchars(strip_tags($this->LastDeudor));
        $this->TipoAdquisicion=htmlspecialchars(strip_tags($this->TipoAdquisicion));
        $this->IdReoBan=htmlspecialchars(strip_tags($this->IdReoBan));
        $this->CuentaCat=htmlspecialchars(strip_tags($this->CuentaCat));
        $this->NumFolioReal=htmlspecialchars(strip_tags($this->NumFolioReal));
        $this->IdEstado=htmlspecialchars(strip_tags($this->IdEstado));
        $this->IdMunicipio=htmlspecialchars(strip_tags($this->IdMunicipio));
        $this->Calle=htmlspecialchars(strip_tags($this->Calle));
        $this->CodigoPostal=htmlspecialchars(strip_tags($this->CodigoPostal));
        $this->M2superficie=htmlspecialchars(strip_tags($this->M2superficie));
        $this->M2construccion=htmlspecialchars(strip_tags($this->M2construccion));
        $this->MontoDeuda=htmlspecialchars(strip_tags($this->MontoDeuda));
        $this->MontoMin=htmlspecialchars(strip_tags($this->MontoMin));
        $this->MontoVenta=htmlspecialchars(strip_tags($this->MontoVenta));
        $this->NumExpediente=htmlspecialchars(strip_tags($this->NumExpediente));
        $this->ComentarioRegPub=htmlspecialchars(strip_tags($this->ComentarioRegPub));
        $this->ComentarioExpJudicial=htmlspecialchars(strip_tags($this->ComentarioExpJudicial));
        $this->EstatusInm=htmlspecialchars(strip_tags($this->EstatusInm));

        $this->Colonia=htmlspecialchars(strip_tags($this->Colonia)); 
        $this->Banos=htmlspecialchars(strip_tags($this->Banos)); 
        $this->Cochera=htmlspecialchars(strip_tags($this->Cochera)); 
        $this->Dormitorios=htmlspecialchars(strip_tags($this->Dormitorios)); 
        $this->DescripcionAdicional=htmlspecialchars(strip_tags($this->DescripcionAdicional));
        $this->NumInterior=htmlspecialchars(strip_tags($this->NumInterior));
        $this->NumExt=htmlspecialchars(strip_tags($this->NumExt)); 
        $this->TipoInmueble=htmlspecialchars(strip_tags($this->TipoInmueble));
     
        // bind values
        $stmt->bindParam(":idinmueble", $this->IdInmueble);
        $stmt->bindParam(":numcredito", $this->NumCredito);
        $stmt->bindParam(":namedeudor", $this->NameDeudor);
        $stmt->bindParam(":lastdeudor", $this->LastDeudor);
        $stmt->bindParam(":tipodquisicion", $this->TipoAdquisicion);
        $stmt->bindParam(":idreoban", $this->IdReoBan);
        $stmt->bindParam(":cuentacat", $this->CuentaCat);
        $stmt->bindParam(":numfolioreal", $this->NumFolioReal);
        $stmt->bindParam(":idestado", $this->IdEstado);
        $stmt->bindParam(":idmunicipio", $this->IdMunicipio);
        $stmt->bindParam(":calle", $this->Calle);
        $stmt->bindParam(":codigopostal", $this->CodigoPostal);
        $stmt->bindParam(":m2superficie", $this->M2superficie);
        $stmt->bindParam(":m2construccion", $this->M2construccion);
        $stmt->bindParam(":montoDeuda", $this->MontoDeuda);
        $stmt->bindParam(":montoMin", $this->MontoMin);
        $stmt->bindParam(":montoVenta", $this->MontoVenta);
        $stmt->bindParam(":numexpediente", $this->NumExpediente);
        $stmt->bindParam(":comentarioregpub", $this->ComentarioRegPub);
        $stmt->bindParam(":comentarioexpjudicial", $this->ComentarioExpJudicial);
        $stmt->bindParam(":estatusinm", $this->EstatusInm);

        $stmt->bindParam(":Colonia",$this->Colonia); 
        $stmt->bindParam(":Banos",$this->Banos); 
        $stmt->bindParam(":Cochera",$this->Cochera); 
        $stmt->bindParam(":Dormitorios",$this->Dormitorios); 
        $stmt->bindParam(":DescripcionAdicional",$this->DescripcionAdicional);
        $stmt->bindParam(":NumInterior",$this->NumInterior);
        $stmt->bindParam(":NumExt",$this->NumExt); 
        $stmt->bindParam(":TipoInmueble",$this->TipoInmueble);

        
     
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;         
}

function existnc(){
    
   

    $query = 
    "SELECT count(IdInmueble) as num
    FROM inmueble
    where NumCredito ='" . $this->numcredito ."'";

 

     $stmt = $this->conn->prepare($query);

     $stmt->execute();

     $numelements = $stmt->fetchColumn();

     //echo $numelements;

    if($numelements == 0){
        return true;
    }
 
     return false;
}

  
   

function getmaxInm(){
        $qmax = "SELECT MAX(IdInmueble) FROM inmueble";
    
        $stmt = $this->conn->prepare($qmax);
        
        $stmt->execute();
        
        $max = $stmt->fetchColumn();
    
       return $max;
    }


    // search Inmuebles
function search(){
    $query = 
    "SELECT 
    inm.IdInmueble,NumCredito,es.Nombre as Estado, mun.Nombre as Municipio, pro.Descripcion as proceso
    , pro.IdProceso, adq.Estatus
    FROM 
    inmueble inm
    INNER JOIN tb_estados es ON inm.IdEstado = es.IdEstado
    INNER JOIN tb_municipios mun ON inm.IdMunicipio = mun.IdMunicipio
    INNER JOIN tb_adquisicion adq ON inm.IdInmueble = adq.IdInmueble 
    INNER JOIN tb_procesos pro ON adq.IdProceso = pro.IdProceso "; 
    //echo $this->NumCredito;
        if (!empty($this->NumCredito)) {
            $query=$query."WHERE NumCredito = ".$this->NumCredito;
        }
        else {
            if (!empty($this->Estado)) {
                $query = $query."WHERE es.nombre LIKE '%$this->Estado%'";
                if (!empty($this->Municipio)) {
                    $query = $query."AND mun.Nombre LIKE '%$this->Municipio%'";
                }
            }
            else {
                if (!empty($this->Municipio)) {
                    $query = $query. "WHERE mun.Nombre LIKE '%$this->Municipio%'";
                }
            }   
        }
       //echo $query;
        // prepare query statement
         $stmt = $this->conn->prepare($query);
     
         // execute query
         $stmt->execute();
     
         return $stmt;
    }


   


}