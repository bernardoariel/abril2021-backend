<?php

require_once "conexion.php";

class ModeloImportar{

	static function mdlMostrarDatosImportados($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();
		
		$stmt = null;
	

	}

	/*=============================================
	CREAR PRODUCTO DEL LISTADO
	=============================================*/


	static public function mdlCrearProductoListado($tabla, $datos,$categoria,$subcategoria){

		if($subcategoria==null){$subcategoria=0;}
		if($categoria==null){$categoria=0;}
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
			(id_categoria ,id_subcategoria ,ruta ,codigo,  titulo , titular,descripcion ,estado, stock , marca, precio , peso , entrega ,portada,vista) VALUES
			(:id_categoria,:id_subcategoria,:ruta,:codigo, :titulo, :titular ,:descripcion,:estado, :stock,:marca, :precio, :peso, :entrega,:portada,:vista)");

		
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $categoria, PDO::PARAM_INT);
		$stmt->bindParam(":id_subcategoria", $subcategoria, PDO::PARAM_INT);

		$stmt->bindParam(":codigo", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		

		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["portada"], PDO::PARAM_STR);
		
		$stmt->bindParam(":vista", $datos["vista"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlModificarImportar($tabla,$datos){
		echo '<pre>'; print_r($datos); echo '</pre>';
		echo '<pre>'; print_r($tabla); echo '</pre>';
		
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo =:codigo, subcategoria =:subcategoria, descripcion1 =:descripcion1, descripcion2 =:descripcion2, marca =:marca, stock =:stock, importe =:importe WHERE id=:id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":subcategoria", $datos["subcategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion1", $datos["descripcion1"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion2", $datos["descripcion2"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

	}

	static function mdlMostrarListado($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();
		
		$stmt = null;
	

	}

	/*=============================================
	COPIAR A PRODUCTOS
	=============================================*/	

	static public function mdlCopiarAProductos($tabla,$datos){

	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
			(id_categoria, id_subcategoria, tipo, vista, ruta, codigo, estado, titulo, titular, descripcion, marca, stock, multimedia, detalles, precio, portada, imagen_tabla, vistas, ventas, vistasGratis, ventasGratis, ofertadoPorCategoria, ofertadoPorSubCategoria, oferta, precioOferta, descuentoOferta, imgOferta, finOferta, peso, entrega) VALUES
			(:id_categoria, :id_subcategoria, :tipo, :vista, :ruta, :codigo, :estado, :titulo, :titular, :descripcion, :marca, :stock, :multimedia, :detalles, :precio, :portada, :imagen_tabla, :vistas, :ventas, :vistasGratis, :ventasGratis, :ofertadoPorCategoria, :ofertadoPorSubCategoria, :oferta, :precioOferta, :descuentoOferta, :imgOferta, :finOferta, :peso, :entrega)");

		
		
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":vista", $datos["vista"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":vista", $datos["vista"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		
		
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["portada"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_tabla", $datos["imagen_tabla"], PDO::PARAM_STR);
		$stmt->bindParam(":vistas", $datos["vistas"], PDO::PARAM_INT);
		$stmt->bindParam(":ventas", $datos["ventas"], PDO::PARAM_INT);
		$stmt->bindParam(":vistasGratis", $datos["vistasGratis"], PDO::PARAM_INT);
		$stmt->bindParam(":ventasGratis", $datos["ventasGratis"], PDO::PARAM_INT);
		$stmt->bindParam(":ofertadoPorCategoria", $datos["ofertadoPorCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":ofertadoPorSubCategoria", $datos["ofertadoPorSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);



		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}


	static public function mdlActualizarProductos($tabla,$datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria =:id_categoria, id_subcategoria =:id_subcategoria, stock =:stock, precio =:precio, marca =:marca, stock =:stock, precioOferta =:precioOferta,descuentoOferta =:descuentoOferta WHERE codigo=:codigo");

		$stmt -> bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

	}



}

