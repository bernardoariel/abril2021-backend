<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS
	=============================================*/

	static public function ctrMostrarTotalProductos($orden){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarTotalProductos($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	SUBIR MULTIMEDIA
	=============================================*/

	static public function ctrSubirMultimedia($datos, $ruta){

		if(isset($datos["tmp_name"]) && !empty($datos["tmp_name"])){

			/*=============================================
			DEFINIMOS LAS MEDIDAS
			=============================================*/

			list($ancho, $alto) = getimagesize($datos["tmp_name"]);	

			$nuevoAncho = 1000;
			$nuevoAlto = 1000;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA MULTIMEDIA
			=============================================*/

			$directorio = "../vistas/img/multimedia/".$ruta;

			/*=============================================
			PRIMERO PREGUNTAMOS SI EXISTE UN DIRECTORIO DE MULTIMEDIA CON ESTA RUTA
			=============================================*/

			if (!file_exists($directorio)){

				mkdir($directorio, 0755);
			
			}

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if($datos["type"] == "image/jpeg"){

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$rutaMultimedia = $directorio."/".$datos["name"];

				$origen = imagecreatefromjpeg($datos["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $rutaMultimedia);

			}

			if($datos["type"] == "image/png"){

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$rutaMultimedia = $directorio."/".$datos["name"];

				$origen = imagecreatefrompng($datos["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagealphablending($destino, FALSE);
		
				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $rutaMultimedia);

			}

			return $rutaMultimedia;	

		}

	}

	/*=============================================
	CREAR PRODUCTOS
	=============================================*/

	static public function ctrCrearProducto($datos){

		if(isset($datos["tituloProducto"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["tituloProducto"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionProducto"]) ){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = "../vistas/img/cabeceras/default/default.jpg";

				if(isset($datos["fotoPortada"]["tmp_name"]) && !empty($datos["fotoPortada"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPortada"]["tmp_name"]);	

					$nuevoAncho = 1280;
					$nuevoAlto = 720;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPortada"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPortada);

					}

					if($datos["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}

				}

				/*=============================================
				VALIDAR IMAGEN PRINCIPAL
				=============================================*/

				$rutaFotoPrincipal = "../vistas/img/productos/default/default.jpg";

				if(isset($datos["fotoPrincipal"]["tmp_name"]) && !empty($datos["fotoPrincipal"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPrincipal"]["tmp_name"]);	

					$nuevoAncho = 400;
					$nuevoAlto = 450;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPrincipal"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaFotoPrincipal);

					}

					if($datos["fotoPrincipal"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaFotoPrincipal);

					}

				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				=============================================*/

				$rutaOferta = "";

				if(isset($datos["fotoOferta"]["tmp_name"]) && !empty($datos["fotoOferta"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($datos["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}

				}

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTE EN CAMINO
				=============================================*/

				if($datos["selActivarOferta"] == "oferta"){

					$datosProducto = array(
						   "titulo"=>$datos["tituloProducto"],
						   "idCategoria"=>$datos["categoria"],
						   "idSubCategoria"=>$datos["subCategoria"],
						   "tipo"=>$datos["tipo"],
						   "detalles"=>$datos["detalles"],
						   "multimedia"=>$datos["multimedia"],
						   "ruta"=>$datos["rutaProducto"],
						   "estado"=> 1,
						   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
						   "descripcion"=> $datos["descripcionProducto"],
						   "palabrasClaves"=> $datos["pClavesProducto"],
						   "precio"=> $datos["precio"],
						   "peso"=> $datos["peso"],
						   "entrega"=> $datos["entrega"],  
						   "imgPortada"=>substr($rutaPortada,3),
						   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
						   "oferta"=>1,
						   "precioOferta"=>$datos["precioOferta"],
						   "descuentoOferta"=>$datos["descuentoOferta"],
						   "imgOferta"=>substr($rutaOferta,3),
						   "finOferta"=>$datos["finOferta"]
					   );


				}else{

					$datosProducto = array(
						   "titulo"=>$datos["tituloProducto"],
						   "idCategoria"=>$datos["categoria"],
						   "idSubCategoria"=>$datos["subCategoria"],
						   "tipo"=>$datos["tipo"],
						   "detalles"=>$datos["detalles"],
						   "multimedia"=>$datos["multimedia"],
						   "ruta"=>$datos["rutaProducto"],
						   "estado"=> 1,
						   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
						   "descripcion"=> $datos["descripcionProducto"],
						   "palabrasClaves"=> $datos["pClavesProducto"],
						   "precio"=> $datos["precio"],
						   "peso"=> $datos["peso"],
						   "entrega"=> $datos["entrega"],  
						   "imgPortada"=>substr($rutaPortada,3),
						   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
						   "oferta"=>0,
						   "precioOferta"=>0,
						   "descuentoOferta"=>0,
						   "imgOferta"=>"",
						   "finOferta"=>""
					   );

				}

				ModeloCabeceras::mdlIngresarCabecera("cabeceras", $datosProducto);

				$respuesta = ModeloProductos::mdlIngresarProducto("productos", $datosProducto);

				return $respuesta;
				

			}else{

					echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre del producto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';



			}
		
		}

	}

	/*=============================================
	EDITAR PRODUCTOS
	=============================================*/

	static public function ctrEditarProducto($datos){

		if(isset($datos["idProducto"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["tituloProducto"])  && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionProducto"]) ){

				/*=============================================
				ELIMINAR LAS FOTOS DE MULTIMEDIA DE LA CARPETA
				=============================================*/

				if($datos["tipo"] == "fisico"){

					$item = "id";
					$valor = $datos["idProducto"];

					$traerProductos = ModeloProductos::mdlMostrarProductos("productos", $item, $valor);

					foreach ($traerProductos as $key => $value) {
					
						$multimediaBD = json_decode($value["multimedia"],true);
						$multimediaEditar = json_decode($datos["multimedia"],true);

						$objectMultimediaBD = array();
						$objectMultimediaEditar = array();

						foreach ($multimediaBD as $key => $value) {

						  array_push($objectMultimediaBD, $value["foto"]);

						}

						foreach ($multimediaEditar as $key => $value) {

						  array_push($objectMultimediaEditar, $value["foto"]);

						}

						$borrarFoto = array_diff($objectMultimediaBD, $objectMultimediaEditar);

						foreach ($borrarFoto as $key => $value) {
							
							unlink("../".$value);

						}

					}				

				}

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = "../".$datos["antiguaFotoPortada"];

				if(isset($datos["fotoPortada"]["tmp_name"]) && !empty($datos["fotoPortada"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO PORTADA
					=============================================*/

					unlink("../".$datos["antiguaFotoPortada"]);

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPortada"]["tmp_name"]);	

					$nuevoAncho = 1280;
					$nuevoAlto = 720;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPortada"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPortada);

					}

					if($datos["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}

				}

				/*=============================================
				VALIDAR IMAGEN PRINCIPAL
				=============================================*/

				$rutaFotoPrincipal = "../".$datos["antiguaFotoPrincipal"];

				if(isset($datos["fotoPrincipal"]["tmp_name"]) && !empty($datos["fotoPrincipal"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO PRINCIPAL
					=============================================*/

					unlink("../".$datos["antiguaFotoPrincipal"]);

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPrincipal"]["tmp_name"]);	

					$nuevoAncho = 400;
					$nuevoAlto = 450;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPrincipal"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaFotoPrincipal);

					}

					if($datos["fotoPrincipal"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaFotoPrincipal);

					}

				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				=============================================*/

				$rutaOferta = "../".$datos["antiguaFotoOferta"];

				if(isset($datos["fotoOferta"]["tmp_name"]) && !empty($datos["fotoOferta"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO OFERTA
					=============================================*/

					if($datos["antiguaFotoOferta"] != ""){

						unlink("../".$datos["antiguaFotoOferta"]);

					}

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($datos["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}

				}			

				

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTE EN CAMINO
				=============================================*/

				if($datos["selActivarOferta"] == "oferta"){

					$datosProducto = array(
								   "id"=>$datos["idProducto"],
								   "titulo"=>$datos["tituloProducto"],
								   "idCategoria"=>$datos["categoria"],
								   "idSubCategoria"=>$datos["subCategoria"],
								   "tipo"=>$datos["tipo"],
								   "detalles"=>$datos["detalles"],
								   "multimedia"=>$datos["multimedia"],
								   "ruta"=>$datos["rutaProducto"],
								   "estado"=> 1,
								   "idCabecera"=>$datos["idCabecera"],
								   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
								   "descripcion"=> $datos["descripcionProducto"],
								   "palabrasClaves"=> $datos["pClavesProducto"],
								   "precio"=> $datos["precio"],
								   "peso"=> $datos["peso"],
								   "entrega"=> $datos["entrega"],  
								   "imgPortada"=>substr($rutaPortada,3),
								   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
								   "oferta"=>1,
								   "precioOferta"=>$datos["precioOferta"],
								   "descuentoOferta"=>$datos["descuentoOferta"],
								   "imgOferta"=>substr($rutaOferta,3),
								   "finOferta"=>$datos["finOferta"]
								   );

				}else{

					$datosProducto = array(
						 		   "id"=>$datos["idProducto"],
								   "titulo"=>$datos["tituloProducto"],
								   "idCategoria"=>$datos["categoria"],
								   "idSubCategoria"=>$datos["subCategoria"],
								   "tipo"=>$datos["tipo"],
								   "detalles"=>$datos["detalles"],
								   "multimedia"=>$datos["multimedia"],
								   "ruta"=>$datos["rutaProducto"],
								   "estado"=> 1,
								   "idCabecera"=>$datos["idCabecera"],
								   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
								   "descripcion"=> $datos["descripcionProducto"],
								   "palabrasClaves"=> $datos["pClavesProducto"],
								   "precio"=> $datos["precio"],
								   "peso"=> $datos["peso"],
								   "entrega"=> $datos["entrega"],
								   "imgPortada"=>substr($rutaPortada,3),
								   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>""
								   );

				}

				ModeloCabeceras::mdlEditarCabecera("cabeceras", $datosProducto);

				$respuesta = ModeloProductos::mdlEditarProducto("productos", $datosProducto);

				return $respuesta;


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre del producto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';

			}

		}
		
	}

	/*=============================================
	AGREGAR FOTO TAPA
	=============================================*/

	static public function ctrAgregarFotoTapa(){

		
		if(isset($_POST["rutaProducto"])){
		
			if($_POST["tipoFoto"]=="TAPA"){

				$carpeta="tapa";

			}else{

				$carpeta=$_POST["rutaProducto"];

			}

	   	/*=============================================
		VALIDAR IMAGEN
		=============================================*/

		$ruta = "";
		$rutita=str_replace("/", "-", $_POST["rutaProducto"]);

		if(isset($_FILES["fotito"]["tmp_name"])){

			list($ancho, $alto) = getimagesize($_FILES["fotito"]["tmp_name"]);

			$nuevoAncho = 500;
			$nuevoAlto = 500;

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if($_FILES["fotito"]["type"] == "image/jpeg"){

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$aleatorio = mt_rand(100,999);

				$ruta = "vistas/img/listado/".$carpeta."/".$rutita.".jpg";
				echo '<pre>'; print_r($ruta); echo '</pre>';

				$origen = imagecreatefromjpeg($_FILES["fotito"]["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

			}

			if($_FILES["fotito"]["type"] == "image/png"){

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$aleatorio = mt_rand(100,999);


				$ruta = "vistas/img/listado/".$carpeta."/".$rutita.".png";
				echo '<pre>'; print_r($ruta); echo '</pre>';
				// $ruta = "vistas/img/productos/".$carpeta.$rutita.".png";

				$origen = imagecreatefrompng($_FILES["fotito"]["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

			}

		}

		if($_POST["tipoFoto"]=="TAPA"){

			$tabla = "productos";
			$datos = array("id" => $_POST["idProducto"],
				           "imagen_tabla" => $ruta);

			$respuesta = ModeloProductos::mdlAgregarTapa($tabla, $datos);

		}else{

			$tabla = "productos";
			$datos = array("id" => $_POST["idProducto"],
				           "portada" => $ruta,
				           "multimedia" => '[{"foto":"'.$ruta.'"}]',
				           "estado"=>1);

			$respuesta = ModeloProductos::mdlAgregarImagenes($tabla, $datos);

		}

		if($respuesta == "ok"){

				echo'<script>

				window.location = "productos2";

				

				</script>';

			}		


		
	}		
		
	}
	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/

	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$datos = $_GET["idProducto"];

			/*=============================================
			ELIMINAR MULTIMEDIA
			=============================================*/

			$borrar = glob("vistas/img/multimedia/".$_GET["rutaCabecera"]."/*");

				foreach($borrar as $file){

					unlink($file);

				}

			rmdir("vistas/img/multimedia/".$_GET["rutaCabecera"]);

			/*=============================================
			ELIMINAR FOTO PRINCIPAL
			=============================================*/

			if($_GET["imgPrincipal"] != "" && $_GET["imgPrincipal"] != "vistas/img/productos/default/default.jpg"){

				unlink($_GET["imgPrincipal"]);		

			}

			/*=============================================
			ELIMINAR OFERTA
			=============================================*/

			if($_GET["imgOferta"] != ""){

				unlink($_GET["imgOferta"]);		

			}

			/*=============================================
			ELIMINAR CABECERA
			=============================================*/

			if($_GET["imgPortada"] != "" && $_GET["imgPortada"] != "vistas/img/cabeceras/default/default.jpg"){

				unlink($_GET["imgPortada"]);		

			}

			ModeloCabeceras::mdlEliminarCabecera("cabeceras", $_GET["rutaCabecera"]);

			$respuesta = ModeloProductos::mdlEliminarProducto("productos", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "index.php?ruta=productos2&tipo=productos";

								}
							})

				</script>';

			}		



		}

	}

	/*=============================================
	MODIFICAR CATEGORIAS EN PRODUCTOS
	=============================================*/
	static public function ctrAgregarCategoriaAProductos($datos){

		$respuesta = ModeloProductos::mdlAgregarCategoriaAProductos("listado", $datos);

	}

	/*=============================================
	MODIFICAR FECHA DE FIN DE OFERTA
	=============================================*/
	static public function ctrAgregarFinFecha(){

		if(isset($_POST["fechaFinOferta"])){

			$tabla = "productos";
			$item = "finOferta";
			$valor = $_POST["fechaFinOferta"];
			$respuesta = ModeloProductos::mdlAgregarFinFecha($tabla, $item,$valor);

			if($respuesta=="ok"){

				echo "<script>

						window.location = 'index.php?ruta=productos2&tipo=catalogo';

					  </script>";

			}else{

				echo "<script>

						window.location = 'productos2';
						
					  </script>";

			}

		}

	}

	/*=============================================
	MODIFICAR FECHA EL PORCENTAJE
	=============================================*/
	static public function ctrModifcarPorcentaje(){

		if(isset($_POST["porcentajeCatalogo"])){

			$item = "vista";
  			$valor = "catalogo";
			$productos = ControladorProductos::ctrMostrarProductos($item, $valor);

			$tabla="productos";

			foreach ($productos as $key => $value) {
				
				$porcentajeDescuento = $value["precio"]*$_POST["porcentajeCatalogo"];
				$porcentajeDescuento =$porcentajeDescuento/100;

				$precio = $value["precio"] - $porcentajeDescuento;
				$datos = array("id"=>$value["id"],
							   "precioOferta"=>ceil($precio),
							   "descuentoOferta"=>$_POST["porcentajeCatalogo"]);

				$respuesta = ModeloProductos::mdlModifcarPorcentaje($tabla, $datos);

			}

			if($respuesta=="ok"){

				echo "<script>

						window.location = 'index.php?ruta=productos2&tipo=catalogo';

					  </script>";

			}else{

				echo "<script>

						window.location = 'productos2';
						
					  </script>";

			}

		}

	}

	/*=============================================
	AGREGO COMBO
	=============================================*/
	static public function ctrAgregarCombo(){

		if(isset($_POST["codigoCombo"])){

			$tabla = "productos";



			$datos = array( 'id_categoria'=>14,
							'id_subcategoria'=>179	,
							'tipo'=>"fisico",
							'vista'=>"catalogo",
							'estado'=>2,
							'marca'=>'',
							'detalles'=>"",
							'multimedia'=>'[{"foto":"vistas/img/productos/default/default.jpg"}]',
							'portada'=>"vistas/img/productos/default/default.jpg",
							'codigoCombo' => $_POST["codigoCombo"],
							'tituloCombo' => $_POST["tituloCombo"], 
							'importeCombo' => $_POST["importeCombo"], 
							'stockCombo' => $_POST["stockCombo"], 
							'descripcion' => $_POST["tituloCombo"],
							'detalleCombo' =>  $_POST["detalleCombo"]);

			$respuesta = ModeloProductos::mdlAgregarCombo($tabla, $datos);

			if($respuesta=="ok"){

				echo "<script>

						window.location = 'index.php?ruta=productos2&tipo=catalogo';

					  </script>";

					}


		}

	}

	/*=============================================
	MODIFICAR PRECIO PRODUCTO
	=============================================*/
	static public function ctrModificarPrecioProducto(){

		if(isset($_POST["idPrecioProducto"])){

			$tabla = "productos";



			$datos = array('id'=>$_POST["idPrecioProducto"],
						   'precio'=>$_POST["importeProducto"]);

			$respuesta = ModeloProductos::mdlModificarPrecioProducto($tabla, $datos);

			if($respuesta=="ok"){

				echo "<script>

						window.location = 'index.php?ruta=productos2';

					  </script>";

				}


		}

	}

	/*=============================================
	STOCK A CERO
	=============================================*/

	static public function ctrMostrarStockCero($tipovistas){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarStockCero($tabla,$tipovistas);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR STOCK Y PRECIO
	=============================================*/

	static public function ctrActualizarStockyPrecio($datos){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlActualizarStockyPrecio($tabla,$datos);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR STOCK Y PRECIO
	=============================================*/

	static public function ctrAgregarComboOtros(){

		
		if(isset($_POST["idcombo"])){
			

			$productos1=ModeloProductos::mdlMostrarProductos2("productos", "id",$_POST["idcombo"]);
						
			if($_POST["cantidad"]>=2 && $_POST["idcombo2"]==0){
				
				if($_POST["precio"]==0){

					$precioTotal = $productos1["precio"]*$_POST["cantidad"];

				}else{

					$precioTotal = $_POST["precio"];

				}

				$datos = array(
				 		   "id_categoria"=>$productos1["id_categoria"],
						   "id_subcategoria"=>$productos1["id_subcategoria"],
						   "tipo"=>$productos1["tipo"],
						   "ruta"=>$productos1["ruta"]."-".$_POST["cantidad"],
						   'vista'=>"catalogo",
						   'estado'=>2,
						   "titulo"=> "COMBO de " .$_POST["cantidad"]." ".$productos1["titulo"],
						   "titular"=> "COMBO de " .$_POST["cantidad"]." ".$productos1["titulo"],
						   "descripcion"=> $productos1["descripcion"],
						   "multimedia"=>'[{"foto":"vistas/img/productos/default/default.jpg"}]',
						   "detalles"=>$productos1["detalles"],
						   "precio"=> $precioTotal,
						   "portada"=> "vistas/img/productos/default/default.jpg",
						   "oferta"=>$productos1["oferta"],
						   "precioOferta"=>$productos1["precioOferta"],
						   "descuentoOferta"=>$productos1["descuentoOferta"],
						   "imgOferta"=>$productos1["imgOferta"],								   
						   "finOferta"=>$productos1["finOferta"],
						   "peso"=> $productos1["peso"],
						   "entrega"=> $productos1["entrega"],
						   "stock"=> $_POST["stock"]);

				$respuesta=ModeloProductos::mdlAgregarComboFinal("productos", $datos);
				

			}else{

				$productos2=ModeloProductos::mdlMostrarProductos2("productos", "id",$_POST["idcombo2"]);

				if($_POST["precio"]==0){

					$precioTotal = ($productos1["precio"]*$_POST["cantidad"])+($productos2["precio"]*$_POST["cantidad2"]);

				}else{

					$precioTotal = $_POST["precio"];

				}

				$datos = array(
				 		   "id_categoria"=>$productos1["id_categoria"],
						   "id_subcategoria"=>$productos1["id_subcategoria"],
						   "tipo"=>$productos1["tipo"],
						   "ruta"=>$productos1["ruta"]."-".$_POST["cantidad"]."-".$productos2["ruta"]."-".$_POST["cantidad2"],
						   'vista'=>"catalogo",
						   'estado'=>2,
						   "titulo"=> "COMBO ".$productos1["titulo"]." ".$productos2["titulo"],
						   "titular"=> "COMBO ".$productos1["titulo"]." ".$productos2["titulo"],
						   "descripcion"=> $productos1["descripcion"]." ".$productos2["descripcion"],
						   "multimedia"=>'[{"foto":"vistas/img/productos/default/default.jpg"}]',
						   "detalles"=>$productos1["detalles"]." ".$productos1["detalles"],
						   "precio"=> $precioTotal,
						   "portada"=> "vistas/img/productos/default/default.jpg",
						   "oferta"=>$productos2["oferta"],
						   "precioOferta"=>$productos2["precioOferta"],
						   "descuentoOferta"=>$productos2["descuentoOferta"],
						   "imgOferta"=>$productos2["imgOferta"],								   
						   "finOferta"=>$productos2["finOferta"],
						   "peso"=> $productos2["peso"],
						   "entrega"=> $productos2["entrega"],
						   "stock"=> $_POST["stock"]);

				$respuesta=ModeloProductos::mdlAgregarComboFinal("productos", $datos);

			}	
			
			if($respuesta=="ok"){

				echo "<script>

						window.location = 'index.php?ruta=productos2';

					  </script>";

			}

		}

	}




}