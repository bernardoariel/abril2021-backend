<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlMostrarTotalProductos($tabla, $orden){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTOS
	=============================================*/

	static public function mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
	}

	/*=============================================
	ACTUALIZAR OFERTA PRODUCTOS
	=============================================*/
	static public function mdlActualizarOfertaProductos($tabla, $datos, $ofertadoPor, $precioOfertaActualizado, $descuentoOfertaActualizado, $idOferta){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $ofertadoPor = :$ofertadoPor, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, imgOferta = :imgOferta, finOferta = :finOferta WHERE id = :id");

		$stmt->bindParam(":".$ofertadoPor, $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $precioOfertaActualizado, PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $descuentoOfertaActualizado, PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $idOferta, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;


	}

	static public function mdlMostrarProductos2($tabla, $item, $valor){

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
	CREAR PRODUCTO
	=============================================*/

	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_subcategoria, tipo, ruta, estado, titulo, titular, descripcion, multimedia, detalles, precio, portada, oferta, precioOferta, descuentoOferta, imgOferta, finOferta, peso, entrega) VALUES (:id_categoria, :id_subcategoria, :tipo, :ruta, :estado, :titulo, :titular, :descripcion, :multimedia, :detalles, :precio, :portada, :oferta, :precioOferta, :descuentoOferta, :imgOferta, :finOferta,  :peso, :entrega)");

		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgFotoPrincipal"], PDO::PARAM_STR);
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

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_subcategoria = :id_subcategoria, tipo = :tipo, ruta = :ruta, estado = :estado, titulo = :titulo, titular = :titular, descripcion = :descripcion, multimedia = :multimedia, detalles = :detalles, precio = :precio, portada = :portada, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, imgOferta = :imgOferta, finOferta = :finOferta, peso = :peso, entrega = :entrega WHERE id = :id");

		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgFotoPrincipal"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO TAPA
	=============================================*/

	static public function mdlAgregarTapa($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET imagen_tabla = :imagen_tabla WHERE id = :id");

		$stmt-> bindParam(":imagen_tabla", $datos["imagen_tabla"], PDO::PARAM_STR);
		$stmt-> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

   /*=============================================
	EDITAR PRODUCTO IMAGENES
	=============================================*/

	static public function mdlAgregarImagenes($tabla, $datos){
		

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET multimedia = :multimedia,  portada = :portada, estado=:estado WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["portada"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR SUBCATEGORIAS
	=============================================*/

	static public function mdlAgregarCategoriaAProductos($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria WHERE id_subcategoria = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		
		$stmt -> bindParam(":id_categoria",$datos["id_categoria"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
	}

	static public function mdlAgregarFinFecha($tabla, $item,$valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :finOferta,  oferta = 1 WHERE vista = 'catalogo'");

	
		$stmt->bindParam(":finOferta", $valor, PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlModifcarPorcentaje($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precioOferta = :precioOferta,  descuentoOferta = :descuentoOferta WHERE id =:id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":precioOferta",$datos["precioOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function mdlAgregarCombo($tabla, $datos){
		echo '<pre>'; print_r($datos); echo '</pre>';

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_subcategoria, tipo, vista, ruta, codigo, estado, titulo, titular, descripcion, marca, stock, multimedia, detalles, precio, portada) VALUES (:id_categoria, :id_subcategoria, :tipo, :vista, :ruta, :codigo, :estado, :titulo, :titular, :descripcion, :marca, :stock, :multimedia, :detalles, :precio, :portada)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":vista", $datos["vista"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["codigoCombo"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigoCombo"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["tituloCombo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["tituloCombo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stockCombo"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["importeCombo"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["portada"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MODIFICAR PRECIO PRODUCTO
	=============================================*/
	static public function mdlModificarPrecioProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio WHERE id =:id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":precio",$datos["precio"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	STOCK A CERO
	=============================================*/

	static public function mdlMostrarStockCero($tabla,$tipovistas){

		if($tipovistas == "catalogo"){

			$consulta = "UPDATE $tabla SET stock = 0, precio = 0";
			

		}else{

			$consulta = "UPDATE $tabla SET stock = 0, precio = 0, finOferta='0000-00-00 00:00:00' , precioOferta = 0 , descuentoOferta = 0 ,vista = '".$tipovistas."',oferta=0";
		}
		//echo '<pre>'; print_r($consulta); echo '</pre>';
		$stmt = Conexion::conectar()->prepare($consulta);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
	}

	/*=============================================
	MODIFICAR PRECIO PRODUCTO
	=============================================*/
	static public function mdlActualizarStockyPrecio($tabla, $datos){
		

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio, stock = :stock WHERE ruta =:ruta");

		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt -> bindParam(":precio",$datos["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MODIFICAR PRECIO PRODUCTO
	=============================================*/
	static public function mdlCrearProductoNuevoExcel($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
			(id_categoria ,id_subcategoria ,ruta ,codigo,  titulo , titular,descripcion ,estado, stock , marca, precio , peso , entrega ,portada,vista) VALUES
			(:id_categoria,:id_subcategoria,:ruta,:codigo, :titulo, :titular ,:descripcion,:estado, :stock,:marca, :precio, :peso, :entrega,:portada,:vista)");

		
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_INT);

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
	CREAR PRODUCTO
	=============================================*/

	static public function mdlAgregarComboFinal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_subcategoria, tipo, ruta,vista, estado, titulo, titular, descripcion, multimedia, detalles, precio, portada, oferta, precioOferta, descuentoOferta, imgOferta, finOferta, peso, entrega,stock,codigo) VALUES (:id_categoria, :id_subcategoria, :tipo, :ruta,:vista, :estado, :titulo, :titular, :descripcion, :multimedia, :detalles, :precio, :portada, :oferta, :precioOferta, :descuentoOferta, :imgOferta, :finOferta,  :peso, :entrega,:stock,:ruta)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":vista", $datos["vista"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["portada"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}




}
//este es para borrar todos
// UPDATE `productos` SET finOferta = '0000-00-00 00:00:00',oferta=0, descuentoOferta = 0 ,precioOferta=0, vista='productos' WHERE 1


// UPDATE `productos` SET finOferta = '0000-00-00 00:00:00',vista='catalogo', descuentoOferta = 0 , precioOferta=0,  WHERE oferta=1

//UPDATE `productos` SET descuentoOferta = 0 , precioOferta=0 WHERE 1