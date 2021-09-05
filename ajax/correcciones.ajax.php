<?php


require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/correcciones.controlador.php";
require_once "../modelos/correcciones.modelo.php";
require_once "../controladores/importar.controlador.php";
require_once "../modelos/importar.modelo.php";
require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";
require_once "../modelos/rutas.php";

class AjaxCorrecciones{

	/*=============================================
	CORRECCIONES
	=============================================*/

  	public function ajaxCorreccionProducto(){

  		$ordenar = "id";
        $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);
        
       
        foreach ($productos as $key => $value) {

        	$tabla = "productos";
			$titulo = str_replace("/", " ", $value["titulo"]);
			
			$datos = array("id" => $value["id"],	
					      "titulo" => $titulo);
			 $modificarProductos = ControladorCorrecciones::ctrCorreccionEspacios($tabla,$datos);
			 
			
        }
  		
  		return  $productos;

	}
	/*=============================================
	CORRECCIONES
	=============================================*/
	public $tipovistas;
	
  	public function ajaxCorreccionStockCero(){
		
  		
        $productos = ControladorProductos::ctrMostrarStockCero($this->tipovistas);
        
  		echo  $productos;

	}

	/*=============================================
	LIMPIAR LA TABLA IMPORT
	=============================================*/
	
  	public function ajaxLimpiarTablaImport(){
		
  		
  		
        $tablaImport = ControladorCorrecciones::ctrLimpiarTablaImport();
        
  		echo  $tablaImport;

	}

	
	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/
	
  	public function ajaxTotalImport(){
		
        $registrosImport = count(ControladorCorrecciones::ctrMostrarTotalImport());
        
  		echo $registrosImport;

	}


	/*=============================================
	MOSTRAR TOTALES
	=============================================*/
	public $vistasTotales;
  	public function ajaxTotales(){

  		$ordenar = "id";
        $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);

        $gruposCodigo = array();
        $gruposId = array();

        foreach ($productos as $key => $value) {

          $bsq_sql = strstr($value["ruta"],"-", true);

          if($bsq_sql==true){

          	if($this->vistasTotales=="productos"){

          		ControladorCorrecciones::ctrEliminarCombo($value["id"]);

          	}else{

          		array_push ($gruposCodigo , $value["codigo"]);
            	array_push ($gruposId , $value["id"]);

          	}
            
          }

        }


		$todosGrupos = count($gruposCodigo);
		$todosCatalogo = count(ControladorCorrecciones::ctrProductosTotales("catalogo"));
        $todosProductos = count(ControladorCorrecciones::ctrProductosTotales("productos")); 
        
        
        $tot = array();
        array_push ($tot , $todosCatalogo);
        array_push ($tot , $todosProductos);
        array_push ($tot , $todosGrupos);
		echo json_encode($tot);
	}

		

	/*=============================================
	ELIMINAR LOS ESPACIOS
	=============================================*/
	
  	public function ajaxEliminarEspacios(){
		
  		
        $tablaImport = ControladorCorrecciones::ctrEliminarEspacios();
        
  		echo  $tablaImport;

	}

	/*=============================================
	Cargar excel
	=============================================*/
	
  	public function ajaxCargarExcel(){

		$ruta = Ruta::ctrRutaServidor();
        $excelCarga = ControladorCorrecciones::ctrExcelCarga($ruta);
        
  		echo  $excelCarga;

	}

	/*=============================================
	Cargar PROMO
	=============================================*/
	
  	public function ajaxAgregarPromo(){

        $promoCombo = ControladorCorrecciones::ctrProductosTotales2("promo");                

		foreach ($promoCombo as $key => $value) {

			
			/*=============================================
			BUSCAR PRODUCTOS
			=============================================*/
			$item = 'ruta';
			$valor = $value['codigo'];
			$producto = ModeloProductos::mdlMostrarProductos2("productos",$item, $valor);
			
		
			if(!empty($producto)){
				
				$tabla = "productos";
				$item1 = "vista";
				$valor1 ="catalogo";


				$item2 = "id";
				$valor2 = $producto['id'];
				$respuesta = ModeloProductos::mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2);
				

			}else{
				
				$datosPromo = array(
					"id_categoria"=>15,
					"id_subcategoria"=>183,
					"tipo"=>'simple',
					"vista"=>'catalogo',
					"ruta"=>$value["codigo"],
					"codigo"=>$value["codigo"],
					"estado"=>2,
					"titulo"=>$value["nombre"],
					"titular"=> substr($value["nombre"], 0, 225)."...",
					"descripcion"=> $value["medida"]." ".$value["descripcion"],
					"marca"=>$value["marca"],
					"stock"=>$value["stock"],
					"multimedia"=>'[{\\\"foto\\\":\\\"vistas/img/productos/default/default.jpg\\\"}]',
					"detalles"=>'',
					"precio"=> $value["precio"],
					"portada"=> 'vistas/img/productos/default/default.jpg',
					"imagen_tabla"=> '',
					"vistas"=>0,
					"ventas"=>0,
					"vistasGratis"=>0,
					"ventasGratis"=>0,
					"ofertadoPorCategoria"=>0,
					"ofertadoPorSubCategoria"=>0,
					"oferta"=>0,
					"precioOferta"=>0,
					"descuentoOferta"=>0,
					"imgOferta"=>"",                             
					"peso"=>25,
					"entrega"=>25
				);
	
				$respuesta = ControladorCorrecciones::ctrIngresarPromo($datosPromo);
				
			}
			
		}
	}

	/*=============================================
	ACTUALIZAR PRODUCTOS
	=============================================*/

  	public function ajaxActualizarProductos(){

  		#recorro los items de la tabla import
		
		$item = null;
		$valor = null;

        $productos_importados = ControladorImportar::ctrMostrarDatosImportados($item, $valor);
        $act = 0;
        $nuevos = 0;
        $arrayProductos = array();
        $arrayRepetidos = array();
        $arrayNuevos = array();

        foreach ($productos_importados as $key => $value) {
        	

        	// primero consulto si existe
        	$item = "ruta";
        	$valor = $value["codigo"];
        	$existeProducto = ModeloProductos::mdlMostrarProductos2("productos",$item,$valor);
        	

        	if(!empty($existeProducto)){

    			if (in_array($value["codigo"], $arrayProductos)){

        			$stock = $value["stock"] + $existeProducto["stock"];
        			#si esta repetido actualiza precio y stock
	        		$datos = array("ruta" => $value["codigo"],	
						       	   "stock" => $stock,
						   	       "precio" => $value["importe"]);
        	
    				$productosTablaProductos = ControladorProductos::ctrActualizarStockyPrecio($datos);
    				
    				array_push ($arrayRepetidos , $value["codigo"]);

				}else{

					#si esta repetido actualiza precio y stock
	        		$datos = array("ruta" => $value["codigo"],	
							       "stock" => $value["stock"],
							   	   "precio" => $value["importe"]);
        	
    				$productosTablaProductos = ControladorProductos::ctrActualizarStockyPrecio($datos);
    		

					array_push ($arrayProductos , $value["codigo"]);
				}

				$item = null;
	        	$valor = null;
	        	$todosProductos = ModeloProductos::mdlMostrarProductos2("productos",$item,$valor);
	        	
					
				// foreach ($todosProductos as $key => $valueProducto) {
					
				// 	if (strpos($valueProducto["codigo"], '-') !== false){	
						
				// 		$combo = explode("-", $valueProducto["codigo"]);

				// 		echo "<br><br>El número de elementos en el array es: ".$valueProducto["codigo"]." " . count($combo);

				// 		if(count($combo)==2){

				// 			$total = $combo[0]*$combo[1];
				// 		}

				// 		if(count($combo)==4){
							
				// 			$importe1 = $combo[0]*$combo[1];
				// 			$importe2 = $combo[2]*$combo[3];
				// 			$total = 0;
				// 			break;

				// 		}
							
				// 		$datos = array("ruta" => $valueProducto["codigo"],	
				// 				       "stock" => $valueProducto["stock"],
				// 				   	   "precio" => $total);
	        	
    //     				$productosTablaProductos = ControladorProductos::ctrActualizarStockyPrecio($datos);

				// 	}
	        		
				// }
					
        		$act++;

	        		

				// }

			}else{
				# si debo mantener los datos del catalogo
				array_push ($arrayNuevos , $value["codigo"]);

				mkdir ('../vistas/img/listado/'.$value["codigo"], 0700);

				$nuevos ++;
				
				$tabla="subcategorias";
				$item = "subcategoria";
				$valor = strtolower($value["subcategoria"]);
					
				$consultaSubcategoria = ModeloSubCategorias::mdlMostrar1SubCategoria($tabla, $item, $valor);

				
				if(empty($consultaSubcategoria)){//si esta vacio
					
					#CREO UNA NUEVA
					$datos2 = array("subcategoria"=>$valor,
								   "idCategoria"=>0,
								   "ruta"=>str_replace(' ', '-', $valor),
								   "estado"=> 2,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");

					#GUARDAMOS EN LISTADO
					$respuesta = ModeloSubCategorias::mdlIngresarSubCategoria($tabla, $datos2);

					$tabla="subcategorias";
					$item = "subcategoria";
					$valor = strtolower($value["subcategoria"]);
					
					$modSubcategoria = ModeloSubCategorias::mdlMostrar1SubCategoria($tabla, $item, $valor);	
					
					#ENTREGO LO QUE EXISTE
					$id_subcategoria = $modSubcategoria["id"];
					$id_categoria = $modSubcategoria["id_categoria"];

				}else{

					#ENTREGO LO QUE EXISTE
					$id_subcategoria = $consultaSubcategoria["id"];
					$id_categoria = $consultaSubcategoria["id_categoria"];

				}

				$datos =array(	"id_categoria"=>$id_categoria,
	                            "id_subcategoria"=>$id_subcategoria,
	                            "tipo"=>"fisico",
	                            "vista"=>"productos",
	                            "ruta"=>$value["codigo"],
	                            "codigo"=>$value["codigo"],
	                            "estado"=>2,
	                            "titulo"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
	                            "titular"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
	                            "descripcion"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"],
	                            "marca"=>$value["marca"],
	                            "stock"=>$value["stock"],
	                            "multimedia"=>'[{"foto":"vistas/img/productos/default/default.jpg"}]',
	                            "detalles"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
	                            "precio"=>$value["importe"],
	                            "portada"=>"vistas/img/productos/default/default.jpg",
	                            "imagen_tabla"=>null,
	                            "vistas"=>0,
	                            "ventas"=>0,
	                            "vistasGratis"=>0,
	                            "ventasGratis"=>0,
	                            "ofertadoPorCategoria"=>0,
	                            "ofertadoPorSubCategoria"=>0,
	                            "oferta"=>0,
	                            "precioOferta"=>0,
	                            "descuentoOferta"=>0,
	                            "imgOferta"=>"",                             
	                            "peso"=>25,
	                            "entrega"=>25);

                

					
				#GUARDAMOS EN LISTADO
				$respuesta = ModeloProductos::mdlCrearProductoNuevoExcel("productos", $datos);

			}

        }


        echo json_encode($arrayNuevos);
        // echo json_encode($arrayRepetidos);
        // echo "LOS ARTICULOS ACTUALIZADO ".$act."<br>";
        // echo "LOS ARTICULOS NUEVVOS ".$nuevos."<br>";

        // echo '<pre>'; print_r($arrayRepetidos); echo '</pre>';
        // echo '<pre>'; print_r($arrayNuevos); echo '</pre>';
        

	}


}

/*=============================================
ACTUALIZAR PROCESO DE ENVÍO
=============================================*/
if(isset($_POST["correccion"])){


	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxCorreccionProducto();

}

/*=============================================
ACTUALIZAR STOCK A CERO
=============================================*/
if(isset($_POST["stockcero"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> tipovistas = $_POST["tipovistas"];
	$envioVenta -> ajaxCorreccionStockCero();

}

/*=============================================
ACTUALIZAR PRODUCTOS
=============================================*/
if(isset($_POST["actualizarProductos"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxActualizarProductos();

}
/*=============================================
AGREGAR PROMO
=============================================*/
if(isset($_POST["agregarPromo"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxAgregarPromo();

}
/*=============================================
LIMPIAR TABLA DE IMPORT
=============================================*/
if(isset($_POST["limpiarTablaImport"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxLimpiarTablaImport();

}

/*=============================================
ELIMINAR ESPACIOS
=============================================*/
if(isset($_POST["eliminarEspacios"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxEliminarEspacios();

}

/*=============================================
CONTAR DATOS DEL IMPORT
=============================================*/
if(isset($_POST["totalImport"])){

	$limpiarImport = new AjaxCorrecciones();
	$limpiarImport -> ajaxTotalImport();

}

/*=============================================
Cargar exce
=============================================*/
if(isset($_POST["ExcelCarga"])){

	$limpiarImport = new AjaxCorrecciones();
	$limpiarImport -> ajaxCargarExcel();

}

/*=============================================
Cargar exce
=============================================*/
if(isset($_POST["totales"])){

	$mostrarTotales = new AjaxCorrecciones();
	$mostrarTotales -> vistasTotales = $_POST["vistasTotales"];
	$mostrarTotales -> ajaxTotales();

}