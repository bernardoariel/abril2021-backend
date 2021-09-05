<?php

require_once "conexion.php";

class ModeloCorrecciones{

	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlCorreccionEspacios($tabla,$datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

	/*=============================================
	Limpiar la tabla import
	=============================================*/

	static public function mdlLimpiarTablaImport($tabla){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla ");
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

	/*=============================================
	ELIMINAR LOS ESPACIOS
	=============================================*/

	static public function mdlEliminarEspacios($tabla){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE subcategoria=''");
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/	

	static public function mdlMostrarTotalImport($tabla){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	Cargar exceL
	=============================================*/	

	static public function mdlExcelCarga($tabla,$ruta){

	

	}

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/	

	static public function mdlProductosTotales($tabla,$tipo){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where vista=:tipo");

		$stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/	

	static public function mdlProductosTotales2($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
		$stmt -> execute();
		return $stmt -> fetchAll();


	}
	
	/*=============================================
	ELIMO LOS PRODUCTOS DE LA RUTA
	=============================================*/	

	static public function mdlEliminarCombo($tabla,$id){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


	}

	/*=============================================
	EDITAR LOS COMBOS
	=============================================*/

	static public function mdlModificarPrecioCombo($tabla,$datosProducto){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio, stock = :stock WHERE id = :id");

		$stmt -> bindParam(":id", $datosProducto["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":precio", $datosProducto["idCategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datosProducto["idSubCategoria"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
	}

	/*=============================================
	EDITAR LOS COMBOS
	=============================================*/

	static public function mdlIngresarPromo($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`id_categoria`, `id_subcategoria`, `tipo`, `vista`, `ruta`, `codigo`, `estado`,
		 `titulo`, `titular`, `descripcion`, `marca`, `stock`, 
		`multimedia`, `detalles`, `precio`,`portada`,`imagen_tabla`,
		`vistas`,`ventas`,`vistasGratis`,`ventasGratis`,`ofertadoPorCategoria`,`ofertadoPorSubCategoria`,
		`oferta`,`precioOferta`,`descuentoOferta`,`imgOferta`,`peso`,`entrega`) VALUES (:id_categoria, :id_subcategoria, :tipo, :vista, :ruta, :codigo, :estado, :titulo,
		 :titular, :descripcion, :marca, :stock, :multimedia, :detalles, 
		 :precio,:portada,:imagen_tabla,:vistas,:ventas,:vistasGratis,:ventasGratis,:ofertadoPorCategoria,:ofertadoPorSubCategoria,
		:oferta,:precioOferta,:descuentoOferta,:imgOferta,:peso,:entrega)");
		
		$stmt -> bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":vista", $datos["vista"], PDO::PARAM_STR);
		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt -> bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt -> bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":portada", $datos["portada"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen_tabla", $datos["imagen_tabla"], PDO::PARAM_STR);

		$stmt -> bindParam(":vistas", $datos["vistas"], PDO::PARAM_INT);
		$stmt -> bindParam(":ventas", $datos["ventas"], PDO::PARAM_INT);
		$stmt -> bindParam(":vistasGratis", $datos["vistasGratis"], PDO::PARAM_INT);
		$stmt -> bindParam(":ventasGratis", $datos["ventasGratis"], PDO::PARAM_INT);
		$stmt -> bindParam(":ofertadoPorCategoria", $datos["ofertadoPorCategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":ofertadoPorSubCategoria", $datos["ofertadoPorSubCategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":peso", $datos["peso"], PDO::PARAM_INT);
		$stmt -> bindParam(":entrega", $datos["entrega"], PDO::PARAM_INT);
		

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}
		
	}


}