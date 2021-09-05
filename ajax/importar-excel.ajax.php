<?php

require_once "../controladores/importar.controlador.php";
require_once "../modelos/importar.modelo.php";

class AjaxImportar{

  /*=============================================
  EDITAR LO QUE SE IMPORTA
  =============================================*/ 
  public $idImportar;

  public function ajaxEditarImportacion(){

    $item = "id";
    $valor = $this->idImportar;
 

    $respuesta=ControladorImportar::ctrMostrarDatosImportados($item,$valor);

    echo json_encode($respuesta);
    
  }

  /*=============================================
  CORREGIR DATOS DE IMPORTACION
  =============================================*/ 
  // public $idImportar;
  // public $valor;
  // public $columna;

  // public function ajaxCorregirImportacion(){
    
  //   $datos = array("id"=>$this->idImportar,
  //                   "columna"=>$this->columna,
  //                   "valor"=>$this->valor);

  //  // echo '<pre>'; print_r($datos); echo '</pre>';
  //   $respuesta=ControladorImportar::ctrModificarImportar($datos);
  //   //echo '<pre>'; print_r($respuesta); echo '</pre>';
 

    
  // }


}

/*=============================================
EDITAR LO QUE SE IMPORTA
=============================================*/
if(isset($_POST["idImportar"])){

  $editar = new AjaxImportar();
  $editar -> idImportar = $_POST["idImportar"];
  $editar -> ajaxEditarImportacion();

}

// /*=============================================
// EDITAR LO QUE SE IMPORTA
// =============================================*/
// if(isset($_POST["idImportar"])){

//   $editar = new AjaxImportar();
//   $editar -> idImportar = $_POST["idImportar"];
//   $editar -> ajaxCorregirImportacion();

// }