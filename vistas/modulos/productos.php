<div class="content-wrapper">

  <section class="content-header">

   <h1>
      Gestor Productos
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
       
      <div class="box-header with-border">
         
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar Producto

        </button>



      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
        
          <thead>
         
            <tr>
             
               <th style="width:10px">#</th>
               <th>Titulo</th>
               <th>Categoria</th>
               <th>Subcategoria</th>
               <th>Ruta</th>
               <th>Estado</th>
               <th>Tipo</th>
               <th>Descripción</th>
               <th>Palabras claves</th>
               <th>Portada</th>
               <th>Imagen Principal</th>
               <th>Multimedia</th>
               <th>Detalles</th>
               <th>Precio</th>
               <th>Peso</th>
               <th>Tiempo de Entrega</th>
               <th>Tipo de Oferta</th>
               <th>Valor Oferta</th>
               <th>Imagen Oferta</th>
               <th>Fin Oferta</th>
               <th>Acciones</th>

            </tr> 

          </thead>   

          <tbody>
          
          <?php 

            $item = null;
            $valor = null;

            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

            /*=============================================
            TRAER LAS CATEGORÍAS
            =============================================*/
            foreach ($productos as $key => $value) {

              $item = "id";
              $valor = $value["id_categoria"];

              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

              if($categorias["categoria"] == ""){

                $categoria = "SIN CATEGORÍA";
              
              }else{

                $categoria = $categorias["categoria"];
              } 

              /*=============================================
              TRAER LAS SUBCATEGORÍAS
              =============================================*/

              $item2 = "id";
              $valor2 = $value["id_subcategoria"];

              $subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item2, $valor2);
              
              

              if($subcategorias[0]["subcategoria"] == ""){

                $subcategoria = "SIN SUBCATEGORÍA";
              
              }else{

                $subcategoria = $subcategorias[0]["subcategoria"];
              }

              /*=============================================
              AGREGAR ETIQUETAS DE ESTADO
              =============================================*/

              if($value["estado"] == 0){

                $colorEstado = "btn-danger";
                $textoEstado = "Desactivado";
                $estadoProducto = 1;

              }else{

                $colorEstado = "btn-success";
                $textoEstado = "Activado";
                $estadoProducto = 0;

              }

              $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$value["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";
                  
              /*=============================================
                TRAER LAS CABECERAS
                =============================================*/

              $item3 = "ruta";
              $valor3 = $value["ruta"];

              $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item3, $valor3);

              if($cabeceras["portada"] != ""){

                  $imagenPortada = "<img src='".$cabeceras["portada"]."' class='img-thumbnail imgPortadaProductos' width='100px'>";

                }else{

                  $imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
                }

              /*=============================================
              TRAER IMAGEN PRINCIPAL
              =============================================*/

              $imagenPrincipal = "<img src='".$value["portada"]."' class='img-thumbnail imgTablaPrincipal' width='100px'>";

              /*=============================================
              TRAER MULTIMEDIA
              =============================================*/

              if($value["multimedia"] != null){

                $multimedia = json_decode($value["multimedia"],true);

                if($multimedia[0]["foto"] != ""){

                  $vistaMultimedia = "<img src='".$multimedia[0]["foto"]."' class='img-thumbnail imgTablaMultimedia' width='100px'>";

                }else{

                  $vistaMultimedia = "<img src='http://i3.ytimg.com/vi/".$value["multimedia"]."/hqdefault.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

                }


              }else{

                $vistaMultimedia = "<img src='vistas/img/multimedia/default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

              } 
              /*=============================================
              TRAER DETALLES
              =============================================*/

              $detalles = json_decode($value["detalles"],true);

              if($value["tipo"] == "fisico"){

                $talla = json_encode($detalles["Talla"]);
                $color = json_encode($detalles["Color"]);
                $marca = json_encode($detalles["Marca"]);

              $vistaDetalles = "Talla: ".str_replace(array("[","]",'"'), "", $talla)." - Color: ".str_replace(array("[","]",'"'), "", $color)." - Marca: ".str_replace(array("[","]",'"'), "", $marca);


              }else{


              $vistaDetalles = "Clases: ".$detalles["Clases"].", Tiempo: ".$detalles["Tiempo"].", Nivel: ".$detalles["Nivel"].", Acceso: ".$detalles["Acceso"].", Dispositivo: ".$detalles["Dispositivo"].", Certificado: ".$detalles["Certificado"];

              }

              /*=============================================
              TRAER PRECIO
              =============================================*/

              if($value["precio"] == 0){

                $precio = "Gratis";
              
              }else{

                $precio = "$ ".number_format($value["precio"],2);

              }

              /*=============================================
              TRAER ENTREGA
              =============================================*/

              if($value["entrega"] == 0){

                $entrega = "Inmediata";
              
              }else{

                $entrega = $value["entrega"]. " días hábiles";

              }

              /*=============================================
              REVISAR SI HAY OFERTAS
              =============================================*/
              
            if($value["oferta"] != 0){

              if($value["precioOferta"] != 0){  

                $tipoOferta = "PRECIO";
                $valorOferta = "$ ".number_format($value["precioOferta"],2);

              }else{

                $tipoOferta = "DESCUENTO";
                $valorOferta = $value["descuentoOferta"]." %";  

              } 

            }else{

              $tipoOferta = "No tiene oferta";
              $valorOferta = 0;
              
            }

              /*=============================================
              TRAER IMAGEN OFERTA
              =============================================*/

              if($value["imgOferta"] != ""){

                $imgOferta = "<img src='".$value["imgOferta"]."' class='img-thumbnail imgTablaProductos' width='100px'>";

              }else{

                $imgOferta = "<img src='vistas/img/ofertas/default/default.jpg' class='img-thumbnail imgTablaProductos' width='100px'>";

              }    

              /*=============================================
              TRAER LAS ACCIONES
              =============================================*/

              $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$value["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$value["id"]."' imgOferta='".$value["imgOferta"]."' rutaCabecera='".$value["ruta"]."' imgPortada='".$cabeceras["portada"]."' imgPrincipal='".$value["portada"]."'><i class='fa fa-times'></i></button><button class='btn btn-success btnAgregarTapa' idProducto='".$value["id"]."' data-toggle='modal' data-target='#modalAgregarTapa'><i class='fa fa-file-photo-o '></i></button></div>";

              ?>

              <tr>
                <td><?php echo  ($key+1);?></td>
                <td><?php echo  $value["titulo"];?></td>
                <td><?php echo  $categoria;?></td>
                <td><?php echo  $subcategoria;?></td>
                <td><?php echo  $value["ruta"];?></td>
                <td><?php echo  $estado;?></td>
                <td><?php echo  $value["tipo"];?></td>
                <td><?php echo  $cabeceras["descripcion"];?></td>
                <td><?php echo  $cabeceras["palabrasClaves"];?></td>
                <td><?php echo  $imagenPortada;?></td>
                <td><?php echo  $imagenPrincipal;?></td>
                <td><?php echo  $vistaMultimedia;?></td>
                <td><?php echo  $vistaDetalles;?></td>
                <td><?php echo  $precio;?></td>
                <td><?php echo  $value["peso"];?></td>
                <td><?php echo  $entrega;?></td>
                <td><?php echo  $tipoOferta;?></td>
                <td><?php echo  $valorOferta;?></td>
                <td><?php echo  $imgOferta;?></td>
                <td><?php echo  $value["finOferta"];?></td>
                <td>
                  <div class='btn-group'>



                    <button class='btn btn-warning btnEditarProducto' idProducto='<?php echo $value["id"]; ?>' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button>

                    <button class='btn btn-danger btnEliminarProducto' idProducto='<?php echo $value["id"]; ?>' imgOferta='<?php echo $value["imgOferta"]; ?>' rutaCabecera='<?php echo $value["ruta"]; ?>' imgPortada='<?php echo $cabeceras["portada"]; ?>' imgPrincipal='<?php echo $value["portada"]; ?>'><i class='fa fa-times'></i></button>

                    
                    <button class='btn btn-success btnAgregarFotoProducto' idProducto='<?php echo $value["id"]; ?>' data-toggle='modal' data-target='#modalAgregarTapa'><i class='fa fa-file-photo-o '></i></button>

                  </div>

                </td>

              </tr>


        

              <?php



}
           


           ?>


          </tbody>
     
        </table>
          
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
   <div class="modal-dialog">
     
     <div class="modal-content">
       
       <!-- <form role="form" method="post" enctype="multipart/form-data"> -->
         
         <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EL TÍTULO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg validarProducto tituloProducto"  placeholder="Ingresar título producto">

                </div>

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DEL PRODUCTO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                  <input type="text" class="form-control input-lg rutaProducto" placeholder="Ruta url del producto" readonly>

                </div>

            </div>

           <!--=====================================
            ENTRADA PARA LA RUTA DEL PRODUCTO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span> 

                  <select class="form-control input-lg seleccionarTipo">
                    
                    <option value="">Selecionar tipo de producto</option>

                    <option value="virtual">Virtual</option>

                    <option value="fisico">Físico</option>            
    
                  </select>

                </div>

            </div>

            <!--=====================================
            ENTRADA PARA AGREGAR MULTIMEDIA
            ======================================-->

            <div class="form-group agregarMultimedia"> 

              <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO VIRTUAL
              ======================================-->
              
              <div class="input-group multimediaVirtual" style="display:none">
                
                <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span> 
              
                 <input type="text" class="form-control input-lg multimedia" placeholder="Ingresar código video youtube">

              </div>

              <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO FÍSICO
              ======================================-->
              
              <div class="multimediaFisica needsclick dz-clickable" style="display:none">

                <div class="dz-message needsclick">
                  
                  Arrastrar o dar click para subir imagenes.

                </div>

              </div>

            </div>

            <!--=====================================
            AGREGAR DETALLES VIRTUALES
            ======================================-->

            <div class="detallesVirtual" style="display:none">
              
              <div class="panel">DETALLES</div>

                <!-- CLASES -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Clases" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleClases" placeholder="Descripción">
                  </div>

                </div>

                <!-- TIEMPO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Tiempo" readonly>
                  </div>

                  <div class="col-xs-9">
                    <input type="text" class="form-control input-lg detalleTiempo" placeholder="Descripción">
                  </div>

                </div>

                <!-- NIVEL -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Nivel" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleNivel" placeholder="Descripción">
                  </div>

                </div>

                <!-- ACCESO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Acceso" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleAcceso" placeholder="Descripción">
                  </div>

                </div>

                <!-- DISPOSITIVO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Dispositivo" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleDispositivo" placeholder="Descripción">
                  </div>

                </div>

                <!-- CERTIFICADO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Certificado" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleCertificado" placeholder="Descripción">
                  </div>

                </div>

            </div>

            <!--=====================================
            AGREGAR DETALLES FÍSICOS
            ======================================-->  

            <div class="detallesFisicos" style="display:none">
              
              <div class="panel">DETALLES</div>

              <!-- TALLA -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Talla" readonly>
                  </div>

                  <div class="col-xs-9">
                    <input class="form-control input-lg tagsInput detalleTalla" data-role="tagsinput" type="text" placeholder="Separe valores con coma">
                  </div>

              </div>

              <!-- COLOR -->

              <div class="form-group row">

                <div class="col-xs-3">
                  <input class="form-control input-lg" type="text" value="Color" readonly>
                </div>

                <div class="col-xs-9">
                    <input class="form-control input-lg tagsInput detalleColor" data-role="tagsinput" type="text" placeholder="Separe valores con coma">
                </div>

              </div>

              <!-- MARCA -->

              <div class="form-group row">

                <div class="col-xs-3">
                  <input class="form-control input-lg" type="text" value="Marca" readonly>
                </div>

                <div class="col-xs-9">
                    <input class="form-control input-lg tagsInput detalleMarca" data-role="tagsinput" type="text" placeholder="Separe valores con coma">
                </div>

              </div>

            </div> 

           <!--=====================================
            AGREGAR CATEGORÍA
            ======================================-->

            <div class="form-group">
                
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarCategoria">
                  
                    <option value="">Selecionar categoría</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    foreach ($categorias as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                    }

                    ?>

                  </select>

                </div>

            </div>

            <!--=====================================
            AGREGAR SUBCATEGORÍA
            ======================================-->

            <div class="form-group  entradaSubcategoria" style="display:none">
              
               <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarSubCategoria">

                  </select>

                </div>

            </div>

           <!--=====================================
            AGREGAR DESCRIPCIÓN
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span> 

                <textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto" placeholder="Ingresar descripción producto"></textarea>

              </div>

            </div>

            <!--=====================================
            AGREGAR PALABRAS CLAVES
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                  <input type="text" class="form-control input-lg tagsInput pClavesProducto" data-role="tagsinput"  placeholder="Ingresar palabras claves">

                </div>

            </div>

            <!--=====================================
            AGREGAR FOTO DE PORTADA
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

              <input type="file" class="fotoPortada">

              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            AGREGAR FOTO DE MULTIMEDIA
            ======================================-->

            <div class="form-group">
                
              <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

              <input type="file" class="fotoPrincipal">

              <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">

            </div>

            <!--=====================================
            AGREGAR PRECIO, PESO Y ENTREGA
            ======================================-->

            <div class="form-group row">
               
              <!-- PRECIO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PRECIO</div>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                  <input type="number" class="form-control input-lg precio" min="0" step="any">

                </div>

              </div>

              <!-- PESO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PESO</div>
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 

                  <input type="number" class="form-control input-lg peso" min="0" step="any" value="0">

                </div>

              </div>

              <!-- ENTREGA -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">DÍAS DE ENTREGA</div>
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-truck"></i></span> 

                  <input type="number" class="form-control input-lg entrega" min="0" value="0">

                </div>

              </div>

            </div>

            <!--=====================================
            AGREGAR OFERTAS
            ======================================-->

            <div class="form-group">
              
              <select class="form-control input-lg selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
               
              </select>

            </div>

            <div class="datosOferta" style="display:none">
            
              <!--=====================================
              VALOR OFERTAS
              ======================================-->

              <div class="form-group row">
                  
                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                    
                    <input class="form-control input-lg valorOferta precioOferta" tipo="oferta" type="number" value="0"   min="0" placeholder="Precio">

                  </div>

                </div>

                <div class="col-xs-6">
                     
                  <div class="input-group">
                       
                    <input class="form-control input-lg valorOferta descuentoOferta" tipo="descuento" type="number" value="0"  min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              FECHA FINALIZACIÓN OFERTA
              ======================================-->

              <div class="form-group">
                  
                <div class="input-group date">
                      
                  <input type='text' class="form-control datepicker input-lg valorOferta finOferta">
                      
                  <span class="input-group-addon">
                          
                      <span class="glyphicon glyphicon-calendar"></span>
                      
                  </span>
                 
                </div>
              
              </div>

              <!--=====================================
              FOTO OFERTA
              ======================================-->

              <div class="form-group">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                <input type="file" class="fotoOferta valorOferta">

                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

            </div>
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
  
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary guardarProducto">Guardar producto</button>

        </div>

       <!-- </form> -->

     </div>

   </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
   <div class="modal-dialog">
     
     <div class="modal-content">
          
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EL TÍTULO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg validarProducto tituloProducto" readonly>

                  <input type="hidden" class="idProducto">
                  <input type="hidden" class="idCabecera">

                </div>

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DEL PRODUCTO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                  <input type="text" class="form-control input-lg rutaProducto" readonly>

                </div>

            </div>

           <!--=====================================
            ENTRADA PARA SELECCIONAR EL TIPO DEL PRODUCTO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span> 

                   <input type="text" class="form-control input-lg seleccionarTipo" readonly>

                </div>

            </div>

            <!--=====================================
            ENTRADA PARA AGREGAR MULTIMEDIA
            ======================================-->

            <div class="form-group agregarMultimedia"> 

              <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO VIRTUAL
              ======================================-->
              
              <div class="input-group multimediaVirtual" style="display:none">
                
                <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span> 
              
                 <input type="text" class="form-control input-lg multimedia">

              </div>

              <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO FÍSICO
              ======================================-->

              <div class="row previsualizarImgFisico"></div>
              
              <div class="multimediaFisica needsclick dz-clickable" style="display:none">

                <div class="dz-message needsclick">
                  
                  Arrastrar o dar click para subir imagenes.

                </div>

              </div>
   
            </div>

            <!--=====================================
            AGREGAR DETALLES VIRTUALES
            ======================================-->

            <div class="detallesVirtual" style="display:none">
              
              <div class="panel">DETALLES</div>

                <!-- CLASES -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Clases" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleClases" placeholder="Descripción">
                  </div>

                </div>

                <!-- TIEMPO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Tiempo" readonly>
                  </div>

                  <div class="col-xs-9">
                    <input type="text" class="form-control input-lg detalleTiempo" placeholder="Descripción">
                  </div>

                </div>

                <!-- NIVEL -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Nivel" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleNivel" placeholder="Descripción">
                  </div>

                </div>

                <!-- ACCESO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Acceso" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleAcceso" placeholder="Descripción">
                  </div>

                </div>

                <!-- DISPOSITIVO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Dispositivo" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleDispositivo" placeholder="Descripción">
                  </div>

                </div>

                <!-- CERTIFICADO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Certificado" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleCertificado" placeholder="Descripción">
                  </div>

                </div>

            </div>

            <!--=====================================
            AGREGAR DETALLES FÍSICOS
            ======================================-->  

            <div class="detallesFisicos" style="display:none">
              
              <div class="panel">DETALLES</div>

              <!-- TALLA -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Talla" readonly>
                  </div>

                  <div class="col-xs-9 editarTalla">
                   <!--  <input class="form-control input-lg tagsInput detalleTalla" data-role="tagsinput" type="text" placeholder="Separe valores con coma"> -->
                  </div>

              </div>

              <!-- COLOR -->

              <div class="form-group row">

                <div class="col-xs-3">
                  <input class="form-control input-lg" type="text" value="Color" readonly>
                </div>

                <div class="col-xs-9 editarColor">
                  <!--   <input class="form-control input-lg tagsInput detalleColor" data-role="tagsinput" type="text" placeholder="Separe valores con coma"> -->
                </div>

              </div>

              <!-- MARCA -->

              <div class="form-group row">

                <div class="col-xs-3">
                  <input class="form-control input-lg" type="text" value="Marca" readonly>
                </div>

                <div class="col-xs-9 editarMarca">
                  <!--   <input class="form-control input-lg tagsInput detalleMarca" data-role="tagsinput" type="text" placeholder="Separe valores con coma"> -->
                </div>

              </div>

            </div> 

           <!--=====================================
            AGREGAR CATEGORÍA
            ======================================-->

            <div class="form-group">
                
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarCategoria">
                  
                    <option class="optionEditarCategoria"></option>

                    <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    foreach ($categorias as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                    }

                    ?>

                  </select>

                </div>

            </div>

            <!--=====================================
            AGREGAR SUBCATEGORÍA
            ======================================-->

            <div class="form-group entradaSubcategoria">
                
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarSubCategoria">
                  
                    <option class="optionEditarSubCategoria"></option>

                  </select>

                </div>

            </div>

           <!--=====================================
            AGREGAR DESCRIPCIÓN
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span> 

                <textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto"></textarea>

              </div>

            </div>

            <!--=====================================
            AGREGAR PALABRAS CLAVES
            ======================================-->

            <div class="form-group editarPalabrasClaves">
              
              <!--   <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                  <input type="text" class="form-control input-lg tagsInput pClavesProducto" data-role="tagsinput"  placeholder="Ingresar palabras claves">

                </div> -->

            </div>

            <!--=====================================
            AGREGAR FOTO DE PORTADA
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

              <input type="file" class="fotoPortada">
              <input type="hidden" class="antiguaFotoPortada">

              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            AGREGAR FOTO DE MULTIMEDIA
            ======================================-->

            <div class="form-group">
                
              <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

              <input type="file" class="fotoPrincipal">
              <input type="hidden" class="antiguaFotoPrincipal">

              <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">

            </div>

            <!--=====================================
            AGREGAR PRECIO, PESO Y ENTREGA
            ======================================-->

            <div class="form-group row">
               
              <!-- PRECIO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PRECIO</div>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                  <input type="number" class="form-control input-lg precio" min="0" step="any">

                </div>

              </div>

              <!-- PESO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PESO</div>
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 

                  <input type="number" class="form-control input-lg peso" min="0" step="any" value="0">

                </div>

              </div>

              <!-- ENTREGA -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">DÍAS DE ENTREGA</div>
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-truck"></i></span> 

                  <input type="number" class="form-control input-lg entrega" min="0" value="0">

                </div>

              </div>

            </div>

            <!--=====================================
            AGREGAR OFERTAS
            ======================================-->

            <div class="form-group">
              
              <select class="form-control input-lg selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
               
              </select>

            </div>

            <div class="datosOferta" style="display:none">
            
              <!--=====================================
              VALOR OFERTAS
              ======================================-->

              <div class="form-group row">
                  
                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                    
                    <input class="form-control input-lg valorOferta precioOferta" tipo="oferta" type="number" value="0" min="0" placeholder="Precio">

                  </div>

                </div>

                <div class="col-xs-6">
                     
                  <div class="input-group">
                       
                    <input class="form-control input-lg valorOferta descuentoOferta" tipo="descuento" type="number" value="0"  min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              FECHA FINALIZACIÓN OFERTA
              ======================================-->

              <div class="form-group">
                  
                <div class="input-group date">
                      
                  <input type='text' class="form-control datepicker input-lg valorOferta finOferta">
                      
                  <span class="input-group-addon">
                          
                      <span class="glyphicon glyphicon-calendar"></span>
                      
                  </span>
                 
                </div>
              
              </div>

              <!--=====================================
              FOTO OFERTA
              ======================================-->

              <div class="form-group">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                <input type="file" class="fotoOferta valorOferta">
                <input type="hidden" class="antiguaFotoOferta">

                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

           

            </div>
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
  
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary guardarCambiosProducto">Guardar cambios</button>

        </div>

     </div>

   </div>

</div>

<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>


<!--=====================================
MODAL AGREGAR TAPA
======================================-->

<div id="modalAgregarTapa" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar FOTO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" name="tipoFoto">
                  
                    <option id="tapa">TAPA</option>

                    <option id="producto" selected>PRODUCTO</option>

                  </select>

               

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO TAPA</div>

              <input type="file" class="fotoTapa" name="fotito">
              <input type="hidden" id="idProducto" name="idProducto">
              <input type="hidden" id="rutaProducto" name="rutaProducto">

              <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarTapa" width="50%">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Producto</button>

        </div>

        <?php

          $AgregarTapa = new ControladorProductos();
          $AgregarTapa -> ctrAgregarFotoTapa();

        ?>

      </form>

    </div>

  </div>
  