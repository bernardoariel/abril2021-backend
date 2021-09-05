<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class TablaProductos{

  /*=============================================
  MOSTRAR LA TABLA DE PRODUCTOS
  =============================================*/ 

  public function mostrarTablaProductos(){	

  	$item = null;
  	$valor = null;

  	$productos = ControladorProductos::ctrMostrarProductos($item, $valor);


  	$datosJson = '

  		{	
  			"data":[';

	 	for($i = 0; $i < count($productos); $i++){

			  /*=============================================
  			TRAER LAS CATEGORÍAS
  			=============================================*/

  			$item = "id";
			  $valor = $productos[$i]["id_categoria"];

			  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

  			if($categorias["categoria"] == ""){

  				$categoria = "SIN CATEGORÍA";
  			
  			}else{

  				$categoria = $categorias["categoria"];
  			}

			/*=============================================
  			TRAER LAS SUBCATEGORÍAS
  			=============================================*/

  		$item2 = "id";
			$valor2 = $productos[$i]["id_subcategoria"];

			$subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item2, $valor2);
      

			if(empty($subcategoria)){

        $subcategoria = $subcategorias[0]["subcategoria"];

      }else{

        $subcategoria = "SIN CATEGORIA";

      }

			/*=============================================
  			AGREGAR ETIQUETAS DE ESTADO
  			=============================================*/

  			if($productos[$i]["estado"] == 0){

  				$colorEstado = "btn-danger";
  				$textoEstado = "Desactivado";
  				$estadoProducto = 1;

  			}else{

  				$colorEstado = "btn-success";
  				$textoEstado = "Activado";
  				$estadoProducto = 0;

  			}

  			// $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$productos[$i]["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";
         /*=============================================
          AGREGAR ETIQUETAS DE ESTADO
          =============================================*/

          if($productos[$i]["vista"] == "productos"){

            $colorVista = "btn-danger";
            $textoVista = "Productos";
            $VistaProducto = "productos";

          }else{

            
            $colorVista = "btn-success";
            $textoVista = "Catalogo";
            $VistaProducto = "catalogo";

          }

          $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$productos[$i]["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

          $vista = "<button class='btn btn-xs btnVista ".$colorVista."' idProducto='".$productos[$i]["id"]."' vistaProducto='".$VistaProducto."'>".$textoVista."</button>";
  			
	  		/*=============================================
  			TRAER LAS ACCIONES
  			=============================================*/

        $acciones ="<button class='btn btn-warning btnEditarPrecioProducto' idPrecioProducto='".$productos[$i]['id']."' codigo='".$productos[$i]["ruta"]."' precio='".$productos[$i]["precio"]."'  data-toggle='modal' data-target='#modalEditarPrecioProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' imgOferta='".$productos[$i]["imgOferta"]."' rutaCabecera='".$productos[$i]["ruta"]."' imgPrincipal='".$productos[$i]["portada"]."'><i class='fa fa-times'></i></button><button class='btn btn-success btnAgregarFotoProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalAgregarTapa'><i class='fa fa-file-photo-o '></i></button>";
  			/*=============================================
  			CONSTRUIR LOS DATOS JSON
  			=============================================*/
      
      $tituloJson=str_replace('"','pulg.', $productos[$i]["titulo"]);

			$datosJson .='[
					
					"<img src='.$productos[$i]["portada"].' width=50px>",
          "'.$productos[$i]["ruta"].'",
					"'.$tituloJson.'",
					"'.$categoria.' '.$subcategoria.'",
					"'.$estado.'",
          "'.$vista.'",
					"'.$productos[$i]["stock"].'",
					"'.$productos[$i]["precio"].'",
				  "'.$productos[$i]["stock"].'",
          "'.$productos[$i]["stock"].'",
          "'.$productos[$i]["stock"].'",
				  "'.$acciones.'"	   

			],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']

		}';

		echo $datosJson;

  }


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();