<?php

class ControladorCorrecciones{

	/*=============================================
	CORRECCIONES DE ESPACIOS
	=============================================*/

	public function ctrCorreccionEspacios($tabla,$datos){

		$respuesta = ModeloCorrecciones::mdlCorreccionEspacios($tabla,$datos);
        return $respuesta;
	}

	/*=============================================
	Limpiar la tabla import
	=============================================*/

	static public function ctrLimpiarTablaImport(){

		$tabla ='excel_productos';
		$respuesta = ModeloCorrecciones::mdlLimpiarTablaImport($tabla);

        return $respuesta;
	}

	/*=============================================
	ELIMINAR LOS ESPACIOS
	=============================================*/

	static public function ctrEliminarEspacios(){
		$tabla ='excel_productos';
		$respuesta = ModeloCorrecciones::mdlEliminarEspacios($tabla);
		
        return $respuesta;
	}

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/

	static public function ctrMostrarTotalImport(){

		$tabla = "excel_productos";

		$respuesta = ModeloCorrecciones::mdlMostrarTotalImport($tabla);

		return $respuesta;

	}

	/*=============================================
	Cargar exce
	=============================================*/

	static public function ctrExcelCarga($ruta){

		$tabla = "excel_productos";

		$respuesta = ModeloCorrecciones::mdlExcelCarga($tabla,$ruta);

		return $respuesta;

	}

	/*=============================================
	TOTAL DE PRODUCTOS COMBOS CATALOFO
	=============================================*/

	static public function ctrProductosTotales($tipo){

		$tabla = "productos";

		$respuesta = ModeloCorrecciones::mdlProductosTotales($tabla,$tipo);

		return $respuesta;

	}
	static public function ctrProductosTotales2($tabla){

		$respuesta = ModeloCorrecciones::mdlProductosTotales2($tabla);
		return $respuesta;

	}
	/*=============================================
	ELIMINAR LOS COMBOS
	=============================================*/

	public function ctrEliminarCombo($id){

		$tabla = "productos";
		$respuesta = ModeloCorrecciones::mdlEliminarCombo($tabla,$id);
        return $respuesta;
        
	}
	/*=============================================
	EDITAR LOS COMBOS
	=============================================*/

	public function ctrModificarPrecioCombo(){

		if(isset($_POST["idProductoCombo"])){

			$tabla = "productos";

			$datosProducto = array("id"=>$_POST["idProductoCombo"],
							   "idCategoria"=>$_POST["importeProducto"],
							   "idSubCategoria"=>$_POST["stockProducto"]);

			$respuesta = ModeloCorrecciones::mdlModificarPrecioCombo($tabla,$datosProducto);

	        if($respuesta="ok"){

	        	echo "<script>
	        			window.location = 'bdcorrecciones';
	        		</script>";

	        }

	    }
        
	}
	/*=============================================
	ELIMINAR LOS COMBOS
	=============================================*/

	static public function ctrIngresarPromo($datos){

		$tabla = "productos";
		
		$respuesta = ModeloCorrecciones::mdlIngresarPromo($tabla,$datos);

        return $respuesta;
        
	}

}

