$(".tablaImportar").DataTable({
	
	 "deferRender": true,
	 "retrieve": true,
	 "processing": true,
	 "language": {

	 	"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	 }

});

// $("#seleccionarListado").change(function(){
	
// 	if($("#seleccionarListado").val()=="productos"){

// 		rutaImagen = "vistas/img/plantilla/excel_productos.jpg";

// 	}else{

// 		rutaImagen = "vistas/img/plantilla/excel_listado.jpg";

// 	}

// 	$("#imagenexcel").attr("src", rutaImagen);

// })

// var archivoExcel = null;

// $(".subirExcel").change(function(){

// 	archivoExcel = this.files[0];
// 	console.log("archivoExcel", archivoExcel);
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	// if(archivoExcel["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){

  	// 	$(".archivoExcel").val("");

  	// 	 swal({
		 //      title: "Error al subir el Archivo",
		 //      text: "¡Deberá ser un archivo excel!",
		 //      type: "error",
		 //      confirmButtonText: "¡Cerrar!"
		 //    });

  	// }else{

  		// $(".previsualizarExcel").attr("src",  "vistas/img/plantilla/excelcolor.jpg");



  	// }

// })
$(".tablaImportar tbody").on("change", ".seleccionarCategoria", function(){
// $(".seleccionarCategoria").change(function(){

	let idSubcategoria = $(this).attr("id");//seria el id del select
	console.log("idSubcategoria", idSubcategoria);
	if(idSubcategoria!=0){
		let opcionesCat = $('select[id='+idSubcategoria+']').val();

	var datos = new FormData();

	datos.append("idSubcategoria", idSubcategoria);
	datos.append("opcionesCat", opcionesCat);


	$.ajax({

		url:"ajax/modificar-subcategorias.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		success: function(respuesta){
			window.location ="excel";
			

		}

	});

	console.log("opciones", opcionesCat);
	console.log("idSubcategoria", idSubcategoria);

	}
	
})


$(".tablaImportar tbody").on("click", ".btnEditarImportacion", function(){

	var idImportar = $(this).attr("idImportar");
	var datosImportacion = new FormData();
	
	datosImportacion.append("idImportar", idImportar);
	
	$.ajax({

		url:"ajax/importar-excel.ajax.php",
		method: "POST",
		data: datosImportacion,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			
			$("#idImportar").val(respuesta["id"]);
			$("#codigo").val(respuesta["codigo"]);
			$("#subcategoria").val(respuesta["subcategoria"]);
			$("#descripcion1").val(respuesta["descripcion1"]);
			$("#descripcion2").val(respuesta["descripcion2"]);
			$("#marca").val(respuesta["marca"]);
			$("#stock").val(respuesta["stock"]);
			$("#importe").val(respuesta["importe"]);

						  
		}
		

	})


});

