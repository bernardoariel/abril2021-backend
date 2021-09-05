<?php

class ControladorImportar{

	/*=============================================
	MOSTRAR DATOS IMPORTADOS
	=============================================*/

	static public function ctrMostrarDatosImportados($item, $valor){

		$tabla = "excel_productos";

		$respuesta = ModeloImportar::mdlMostrarDatosImportados($tabla,$item,$valor);

		return $respuesta;

	}
	
	static public function ctrMostrarDatosImportadosListado($item, $valor){

		$tabla = "listado";

		$respuesta = ModeloImportar::mdlMostrarDatosImportados($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	SUBIR LISTADO
	=============================================*/
	static public function ctrSubirListado(){

		if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK){


			$fileName = $_FILES['uploadedFile']['name'];
			$fileNameCmps = explode(".", $fileName);
		    $fileExtension = strtolower(end($fileNameCmps));
		    
		    // sanitize file-name
		    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

			$uploadFileDir = 'vistas/archivos/listado.'. $fileExtension;
      		$dest_path = $uploadFileDir; 

      		if(move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $dest_path)){
         		
         		echo 'Se ha cargado el archivo correctamente.';

         		

            }else{

        		echo  'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      		}
		}

	}

	
	/*=============================================
	CREAR PRODUCTOS DEL LISTADO
	=============================================*/

	static public function ctrCrearProductoListado($datos,$subcategoria){

		$item = "ruta";
		$valor=$datos["ruta"];

		$existeProducto=ControladorImportar::ctrMostrarDatosImportadosListado($item, $valor);

		if(empty($existeProducto)){

			/*=============================================
		CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR 
		LA FOTO DEL PRODUCTO
		=============================================*/

		$directorio = "vistas/img/listado/".$datos["ruta"];

		if (!file_exists($directorio)){

			mkdir($directorio, 0755);

		}

		$tabla="subcategorias";
		$item = "subcategoria";
		$valor = strtolower($subcategoria);
			
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
			$valor = strtolower($subcategoria);
			
			$modSubcategoria = ModeloSubCategorias::mdlMostrar1SubCategoria($tabla, $item, $valor);	
			
			#ENTREGO LO QUE EXISTE
			$id_subcategoria = $modSubcategoria["id"];
			$id_categoria = $modSubcategoria["id_categoria"];

		}else{

			#ENTREGO LO QUE EXISTE
			$id_subcategoria = $consultaSubcategoria["id"];
			$id_categoria = $consultaSubcategoria["id_categoria"];

		}
		
		#GUARDAMOS EN LISTADO
		$respuesta = ModeloImportar::mdlCrearProductoListado("listado", $datos,$id_categoria,$id_subcategoria);

		return $respuesta;


		}
		
		
	}

	/*=============================================
	MOSTRAR DATOS IMPORTADOS
	=============================================*/

	static public function ctrModificarImportar(){

		if(isset($_POST["idImportar"])){	

			$tabla = "excel_productos";

			$datos = array("id"=>$_POST["idImportar"],
							"codigo"=>$_POST["codigo"],
							"subcategoria"=>$_POST["subcategoria"],
							"descripcion1"=>$_POST["descripcion1"],
							"descripcion2"=>$_POST["descripcion2"],
							"marca"=>$_POST["marca"],
							"stock"=>$_POST["stock"],
							"importe"=>$_POST["importe"]);

			$respuesta = ModeloImportar::mdlModificarImportar($tabla,$datos);	
			
			if($respuesta="ok"){

				echo '<script> window.location="csv"</script>';
			}

		}	
		
	}

	/*=============================================
	MOSTRAR DATOS TALBA LISTADO
	=============================================*/

	static public function ctrMostrarListado($item, $valor){

		$tabla = "listado";

		$respuesta = ModeloImportar::mdlMostrarListado($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	COPIAR A PRODUCTOS
	=============================================*/

	static public function ctrCopiarAProductos($datos){

		$tabla = "productos";

		$respuesta = ModeloImportar::mdlCopiarAProductos($tabla,$datos);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR  PRODUCTOS
	=============================================*/

	static public function ctrActualizarProductos($datos){

		$tabla = "productos";

		$respuesta = ModeloImportar::mdlActualizarProductos($tabla,$datos);

		return $respuesta;

	}

	
                         




}