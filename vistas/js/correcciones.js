$("#btnCorregir").on("click", function(){

	var datos = new FormData();
 	datos.append("correccion", 1);

  	$.ajax({

	  url:"ajax/correcciones.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      // dataType: "json",
      success: function(respuesta){

      	console.log("respuesta", respuesta);

      }

  	})

})

$("#tipovistas").change(function(event) {
 
  let nuevoValor = $(this).val();
  $("#btnStockaCero").attr("valor",nuevoValor);

  if(nuevoValor==0){

    $('#btnStockaCero').prop('disabled', true);

  }else{

    $('#btnStockaCero').prop('disabled', false);

  }
                

});


$("#btnStockaCero").on("click", function(){
  
  $("#btnStockaCero").attr("valor");
  $("#btnStockaCero").append('<span class="fa fa-refresh fa-spin"></span>');
 
  var datos = new FormData();
  datos.append("stockcero", 1);
  datos.append("tipovistas", $("#btnStockaCero").attr("valor"));

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
      
      if(respuesta=="ok"){// hizo el stock a cero

        //consulto
        var datosTotales = new FormData();
        datosTotales.append("totales", 1);
        datosTotales.append("vistasTotales", $("#btnStockaCero").attr("valor"));
        $.ajax({

          url:"ajax/correcciones.ajax.php",
          method: "POST",
          data: datosTotales,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",  
          success: function(respuesta2){
           console.log("respuesta2", respuesta2);
            $("#totCatalogo").html(respuesta2[0]+" Catalogo");
            $("#totProductos").html(respuesta2[1]+" Productos");
            $("#totGrupos").html(respuesta2[2]+" Grupos Combos");
            $("#btnStockaCero").children().fadeOut(1000);
          }

        })
          

      }

    }

  })

})


/*=============================================
CARGAR TABLA
=============================================*/
$("#btnCargarTablaImport").on("click", function(){

  $('#btnActualizarProductos').prop('disabled', false);

  var datos = new FormData();
  datos.append("ExcelCarga", 1);

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
      console.log("respuesta", respuesta);
      
      var datos = new FormData();
      datos.append("totalImport", 1);

      $.ajax({

        url:"ajax/correcciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
          
        success: function(respuesta2){
          
          $(".importados").html(respuesta2+" registros");

        }

      })

    }

  })

})
/*=============================================
  LIMPIAR LA TABLA IMPORT
  =============================================*/
$("#btnLimpiarTablaImport").on("click", function(){

  $('#btnActualizarProductos').prop('disabled', true);

  $("#btnLimpiarTablaImport").append('<span class="fa fa-refresh fa-spin"></span>');

  var datos = new FormData();
  datos.append("limpiarTablaImport", 1);

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
      console.log("respuesta", respuesta);

      var datos = new FormData();
      datos.append("totalImport", 1);

      $.ajax({

        url:"ajax/correcciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
          
        success: function(respuesta2){
          $(".importados").fadeIn(1000);
          $(".importados").html(respuesta2+" registros");
          $("#btnLimpiarTablaImport").children().fadeOut(1000);

        }

      })
      
      

    }

  })

})

/*=============================================
ELIMINAR LOS ESPACIOS
=============================================*/
$("#btnEliminarEspacios").on("click", function(){

  $("#btnEliminarEspacios").append('<span class="fa fa-refresh fa-spin"></span>');

  var datos = new FormData();
  datos.append("eliminarEspacios", 1);

   $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){

      var datos = new FormData();
      datos.append("totalImport", 1);

      $.ajax({

          url:"ajax/correcciones.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
            
          success: function(respuesta2){
            
            $(".importados").html(respuesta2+" registros");
      
            $("#btnEliminarEspacios").children().fadeOut(1000);

          }

        })

    }

  })

})

$("#btnActualizarProductos").on("click", function(){
  $("#btnActualizarProductos").append('<span class="fa fa-refresh fa-spin"></span>');
  var datos = new FormData();
  datos.append("actualizarProductos", 1);

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
      // console.log("respuesta", respuesta.length);
    
      
      if(respuesta.length == 2){

        $("#productosNuevos").html("No existen Productos Nuevos");

      }else{

        $("#productosNuevos").html("Productos Nuevos: "+respuesta);

      }
      $("#btnActualizarProductos").children().fadeOut(1000);
      // $("#productosNuevos").val(respuesta);
      // console.log("respuesta", respuesta);

     

    }

  })

})
$("#btnAgregarPromo").on("click", function(){
  $("#btnAgregarPromo").append('<span class="fa fa-refresh fa-spin"></span>');
  var datos = new FormData();
  datos.append("agregarPromo", 1);

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
       console.log("respuesta", respuesta);
    
      
      $("#btnAgregarPromo").fadeOut(1000);
      // $("#productosNuevos").val(respuesta);
      // console.log("respuesta", respuesta);

     

    }

  })

})

/*=============================================
muestro el combo para editar el precio
=============================================*/
$('.tablaProductos tbody').on("click", ".btnIdCombo", function(){

  var idProducto = $(this).attr("id");
  console.log("idProducto", idProducto);
  var codigo = $(this).attr("codigo");
  console.log("codigo", codigo);
  var importe = $(this).attr("importe");
  console.log("importe", importe);
  var stock = $(this).attr("stock");
  console.log("stock", stock);
  $("#idProductoCombo").val(idProducto);
  $("#codigoProductoCombo").val(codigo);
  $("#importeProducto").val(importe);
  $("#stockProducto").val(stock);
  
})

