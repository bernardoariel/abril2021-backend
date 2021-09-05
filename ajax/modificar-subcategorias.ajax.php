<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxModSubCategoriaProductos{


  /*=============================================
  MODIFICAR SUBCATEGORIA
  =============================================*/ 

  public $idCategoria;
  public $idSubcategoria;

  public function ajaxModificarSubCategoria(){

    #AGREGO A LA SUBCATEGORIA UNA CATEGORIA
    $item = "id";
    $id_categoria = $this->idCategoria;
    $id_subcategoria = $this->idSubcategoria;

    $datos = array("id"=>$id_subcategoria,
                  "id_categoria"=>$id_categoria);

    $respuesta = ControladorSubCategorias::ctrAgregarCategoriaASubCategoria($datos);
    #AGREGO A LA categoria al producto UNA CATEGORIA
    $respuesta = ControladorProductos::ctrAgregarCategoriaAProductos($datos);
    

  }


}



/*=============================================
EDITAR CATEGORIA
=============================================*/
if(isset($_POST["opcionesCat"])){

  $modificar = new AjaxModSubCategoriaProductos();
  $modificar -> idCategoria = $_POST["opcionesCat"];
  $modificar -> idSubcategoria = $_POST["idSubcategoria"];
  $modificar -> ajaxModificarSubCategoria();

}



