<?php

if(isset($_GET)){

	/*=============================================
	BOTON PARA VER CATALOGO
	=============================================*/

	if($_GET["tipo"]=="btncatalogo"){
		
		$datos = array("nombre"=>"catalogo",
				   "valor"=>$_GET["ver"]);

		$actualizarCatalogo = ControladorComercio::ctrUpdateCatalogo($datos);
	}

	/*=============================================
	BOTON PARA VER CATALOGO
	=============================================*/

	if($_GET["tipo"]=="productostienda"){
		
		$datos = array("nombre"=>"productos",
				   "valor"=>$_GET["ver"]);

		$actualizarCatalogo = ControladorComercio::ctrUpdateCatalogo($datos);
	}

	/*=============================================
	BOTON PARA VER CATALOGO
	=============================================*/

	if($_GET["tipo"]=="sectionpromo"){
		
		$datos = array("nombre"=>"sectionpromo",
				   "valor"=>$_GET["ver"]);

		$actualizarCatalogo = ControladorComercio::ctrUpdateCatalogo($datos);
	}

}




?>