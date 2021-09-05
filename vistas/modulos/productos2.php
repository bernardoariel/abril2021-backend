<?php 

$select = 0;
if(!isset($_GET["tipo"])){

  $item = null;
  $valor = null;
 

  }else{

  $item = "vista";
  $valor = $_GET["tipo"];

  $select=$_GET["tipo"];

}


?>
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

        <div class="col-lg-1">

          <button class="btn btn-primary btn-lg btnCombo" data-toggle="modal" data-target="#modalAgregarCombo">
          
              Combo

          </button>

        </div>

        <div class="col-lg-1">

          <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarProducto">
          
              Producto

          </button>

        </div>

        <div class="col-lg-2">
 
          <select class="form-control input-lg"  name="listadoProductos" id="listadoProductos">

            
            <option value="productos" <?php if ($select == "productos"){ echo "selected"; } ?>>Productos</option>
            <option value="catalogo" <?php if ($select == "catalogo"){ echo "selected"; } ?>>Catalogo</option>
            <option value="0" selected>Todos los Productos</option>
          </select>

        </div>

        <form action="" method="post">

          <div class="col-lg-2">

          <!--=====================================
          FECHA FINALIZACIÓN OFERTA
          ======================================-->
            <div class="form-group">
                
              <div class="input-group date">
                    
                <input type='text' class="form-control datepicker input-lg" name="fechaFinOferta">
                    
                <span class="input-group-addon">
                        
                    <span class="glyphicon glyphicon-calendar"></span>
                    
                </span>
               
              </div>
            
            </div>

          </div>

          <div class="col-lg-2">

            <button type="submit" class="btn btn-success input-lg">
            
                AgregarFin OFERTA

            </button>

          </div>

        </form>

       
        <?php

          $agregarFinFecha = new ControladorProductos();
          $agregarFinFecha -> ctrAgregarFinFecha();

        ?>

        <form action="" method="post">

          <div class="col-lg-2">

            <div class="input-group">
                       
              <input class="form-control input-lg"  placeholder="Descuento" name="porcentajeCatalogo">

                <span class="input-group-addon"><i class="fa fa-percent"></i></span>

             </div>

          </div>

          <div class="col-lg-2">

            <button type="submit" class="btn btn-warning btn-lg">
            
                Sacar precio Oferta

            </button>

          </div>

        </form>

         <?php

          $modificarPorcentaje = new ControladorProductos();
          $modificarPorcentaje -> ctrModifcarPorcentaje();

        ?>


      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%" style="font-size: 12px">
        
          <thead>
         
            <tr>
             
               <th style="width:50px">Foto</th>
               <th>Codigo</th>
               <th style="width:160px">Titulo</th>
               <th style="width:160px">Cat-Sub</th>            
               <th>Estado</th>
               <th>Vista</th>
               <th>Cant.</th>
               <th>Precio</th>
               <th>%</th>
               <th>Valor Oferta</th>
               <th>Fin Oferta</th>
               <th>Acciones</th>

            </tr> 

          </thead>   

          <tbody>
          
          <?php 
  

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
              
              if(empty($subcategoria)){

                $subcategoria = $subcategorias[0]["subcategoria"];

              }else{

                $subcategoria = "SIN CATEGORIA";

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

              /*=============================================
              AGREGAR ETIQUETAS DE ESTADO
              =============================================*/

              if($value["vista"] == "productos"){

                $colorVista = "btn-danger";
                $textoVista = "Productos";
                $VistaProducto = "productos";

              }else{

                
                $colorVista = "btn-success";
                $textoVista = "Catalogo";
                $VistaProducto = "catalogo";

              }

              $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$value["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

              $vista = "<button class='btn btn-xs btnVista ".$colorVista."' idProducto='".$value["id"]."' vistaProducto='".$VistaProducto."'>".$textoVista."</button>";
                  
              /*=============================================
                TRAER LAS CABECERAS
                =============================================*/

              $item3 = "ruta";
              $valor3 = $value["ruta"];

              $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item3, $valor3);
              if($cabeceras){

                if(is_null($cabeceras["portada"])){
                

                  $imagenPortada = "<img src='".$cabeceras["portada"]."' class='img-thumbnail imgPortadaProductos' width='100px'>";

                }else{

                  $imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
                }

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

                if($detalles){

                  $talla = json_encode($detalles["Talla"]);
                  $color = json_encode($detalles["Color"]);
                  $marca = json_encode($detalles["Marca"]);

                  $vistaDetalles = "Talla: ".str_replace(array("[","]",'"'), "", $talla)." - Color: ".str_replace(array("[","]",'"'), "", $color)." - Marca: ".str_replace(array("[","]",'"'), "", $marca);
                }
                

                


              }else{


              // $vistaDetalles = "Clases: ".$detalles["Clases"].", Tiempo: ".$detalles["Tiempo"].", Nivel: ".$detalles["Nivel"].", Acceso: ".$detalles["Acceso"].", Dispositivo: ".$detalles["Dispositivo"].", Certificado: ".$detalles["Certificado"];

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

              $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$value["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$value["id"]."' rutaCabecera='".$value["ruta"]."' imgPrincipal='".$value["portada"]."'><i class='fa fa-times'></i></button><button class='btn btn-success btnAgregarTapa' idProducto='".$value["id"]."' data-toggle='modal' data-target='#modalAgregarTapa'><i class='fa fa-file-photo-o '></i></button></div>";

              ?>

              <tr>
                
                <td><img src="<?php echo  $value["portada"];?>" width="50px"></td>
                <td><?php echo  $value["ruta"];?></td>
                <td><?php echo  $value["titulo"];?></td>
                <td><?php echo  $categoria."-".$subcategoria;?></td>
                
                <td><?php echo  $estado;?></td>
                <td><?php echo  $vista;?></td>
                <td><?php echo  $value["stock"];?></td>
                
                <td><?php echo  $precio;?></td>
               
                <td><?php echo  $value["descuentoOferta"];?></td>
                <td><?php echo  $valorOferta;?></td>
                <td><?php echo  substr($value["finOferta"], 0, 10);?></td>
                <td>
                  <div class='btn-group'>



                    <button class='btn btn-warning btnEditarPrecioProducto' idPrecioProducto='<?php echo $value["id"]; ?>' codigo='<?php echo $value["ruta"]; ?>' precio='<?php echo $value["precio"]; ?>'  data-toggle='modal' data-target='#modalEditarPrecioProducto'><i class='fa fa-pencil'></i></button>

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

<!--=====================================
MODAL AGREGAR COMBO
======================================-->

<div id="modalAgregarCombo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar COMBO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div id="tablita"> 
            
              <table class="table table-bordered table-striped dt-responsive tablaProductos" id="tablaCombos" width="100%" style="font-size: 12px">
          
                <thead>
               
                  <tr>
                   
                     <th style="width:50px">id</th>
                     <th>Codigo</th>
                     <th style="width:160px">Titulo</th>
                     <th>Acciones</th>

                  </tr> 

                </thead>   

                <tbody>

                  <?php foreach ($productos as $key => $value): ?>
                    
                    <tr>
                    
                      <td><?php echo $value["id"];?></td>
                      <td><?php echo $value["ruta"];?></td>
                      <td><?php echo $value["titulo"];?></td>
                      <td><button class="btn btn-warning btnSeleccionarCombo" id="<?php echo $value['id'];?>" producto1="<?php echo $value['ruta'].' '.$value['titulo'];?>" precio="<?php echo $value['precio'];?>" >Seleccionar</button></td>

                    </tr>

                  <?php endforeach ?>

                </tbody>

              </table>

              </div>

            <div id="tablita2">
              
            
              <table class="table table-bordered table-striped dt-responsive tablaProductos" id="tablaCombos2" width="100%" style="font-size: 12px">
          
                <thead>
               
                  <tr>
                   
                     <th style="width:50px">id</th>
                     <th>Codigo</th>
                     <th style="width:160px">Titulo</th>
                     <th>Acciones</th>

                  </tr> 

                </thead>   

                <tbody>

                  <?php foreach ($productos as $key => $value): ?>
                    
                    <tr>
                    
                      <td><?php echo $value["id"];?></td>
                      <td><?php echo $value["ruta"];?></td>
                      <td><?php echo $value["titulo"];?></td>
                      <td><button class="btn btn-danger btnSeleccionarCombo2" id="<?php echo $value['id'];?>" producto2="<?php echo $value['ruta'].' '.$value['titulo'];?>" precio="<?php echo $value['precio'];?>">Seleccionar</button></td>

                    </tr>

                  <?php endforeach ?>

                </tbody>

              </table>

              </div>

            <form role="form" method="post" enctype="multipart/form-data"> 
              
              <div id="datoscombo">

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">
              
                      <div class="input-group">

                        <label for="idcombo">Id 1</label>

                        <input type="text" id="idcombo" name="idcombo" class="form-control">

                      </div>

                    </div>
                  
                  </div>

                  <div class="col-md-5">
                      
                      <div class="form-group">
              
                        <div class="input-group">

                          <label for="producto1">PRODUCTO</label>

                          <input type="text" id="producto1" name="producto1" class="form-control">

                        </div>

                      </div>

                  </div>

                  <div class="col-md-2">
                    
                    <div class="form-group">
              
                      <div class="input-group">

                        <label for="cantidad">Cant. 1</label>

                        <input type="number" class="form-control" name="cantidad" id="cantidad" value="1">

                      </div>

                    </div>

                  </div>

                  <div class="col-md-3">
                    
                    <div class="form-group">
              
                      <div class="input-group">

                        <label for="precio1">Total</label>

                        <input type="hidden" name="precio1_oculto" id="precio1_oculto">
                        <input type="number" class="form-control" name="precio1"  id="precio1" value="1">

                      </div>

                    </div>

                  </div>

                </div>

                <div class="row">

                  <div class="col-md-2">

                  <div class="form-group">
            
                    <div class="input-group">

                      <label for="idcombo2">Id 2</label>

                      <input type="text" id="idcombo2" name="idcombo2" class="form-control">

                    </div>

                  </div>
                
                </div>

                <div class="col-md-5">
                    
                    <div class="form-group">
            
                      <div class="input-group">

                        <label for="producto3">PRODUCTO</label>

                        <input type="text" id="producto3" name="producto3" class="form-control">

                      </div>

                    </div>

                </div>

                <div class="col-md-2">
                  
                  <div class="form-group">
            
                    <div class="input-group">

                      <label for="cantidad">Cant. 2</label>

                      <input type="number" class="form-control" name="cantidad2" id="cantidad2" value="1">

                    </div>

                  </div>

                </div>

                <div class="col-md-3">
                    
                    <div class="form-group">
              
                      <div class="input-group">

                        <label for="precio2">Total</label>

                        <input type="hidden" name="precio2_oculto" id="precio2_oculto">
                        <input type="number" class="form-control" name="precio2" id="precio2" value="1">

                      </div>

                    </div>

                  </div>

              </div>

              <div class="row">

                <div class="col-md-4">
                  
                  <div class="form-group">
            
                    <div class="input-group">

                      <label for="stock">STOCK</label>

                      <input type="text" class="form-control" name="stock" value="1">

                    </div>

                  </div>

                </div>

                 <div class="col-md-4">
                  
                  <div class="form-group">
            
                    <div class="input-group">

                      <label for="stock">PRECIO AUTOMATICO</label>

                      <input type="text" class="form-control" id="precioautomatico" name="precioautomatico" value="1">

                    </div>

                  </div>

                </div>

                <div class="col-md-4">
                  
                  <div class="form-group">
            
                    <div class="input-group">

                      <label for="precio">PRECIO</label>

                      <input type="text" class="form-control" name="precio" value="0">

                    </div>

                  </div>

                </div>
                
              </div>
                
                



              <button type="submit" class="btn btn-primary" id="btnComboNuevo">Guardar Producto</button>
               <?php

                $agregarComboOtros= new ControladorProductos();
                $agregarComboOtros -> ctrAgregarComboOtros();

                ?>
              </form>
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          

        </div>


    </div>

</div>



<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarPrecioProducto" class="modal fade" role="dialog">
  
   <div class="modal-dialog">
     
     <div class="modal-content">

        <form action="" method="post">
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

                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="hidden" name="idPrecioProducto" id="idPrecioProducto">

                <input type="text" class="form-control input-lg" name="codigoProducto" id="codigoProducto" placeholder="CODIGO" readonly>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA Precio
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-dollar "></i></span> 

                  <input type="text" class="form-control input-lg" name="importeProducto" id="importeProducto" placeholder="IMPORTE">

                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
  
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ">Guardar cambios</button>

        </div>

      </form>

     </div>

   </div>

</div>

<?php

  $agregarCombo = new ControladorProductos();
  $agregarCombo -> ctrModificarPrecioProducto();

?>




<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalAgregarCombo" class="modal fade" role="dialog">
  
   <div class="modal-dialog modal-lg">
     
     <div class="modal-content">

        <form action="" method="post">
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

            <div class="col-lg-8">

              <?php 

              $item = null;
              $valor = null;
              $miProductos = ControladorProductos::ctrMostrarProductos($item, $valor);

              ?>
              <table class="table table-bordered table-striped dt-responsive tablaProductosModal" width="100%" style="font-size: 12px">
        
                <thead>
               
                  <tr>
                   
                   <th>Codigo</th>
                   <th style="width:100px">Titulo</th>
                   <th>Precio</th>
                   <th>Acciones</th>

                  </tr> 

                </thead>   

                <tbody>

                  <?php foreach ($miProductos as $key => $valueProductos): ?>

                    <tr>
                      <td><?php echo $valueProductos["ruta"]; ?></td>
                      <td><?php echo $valueProductos["titulo"]; ?></td>
                      <td><?php echo $valueProductos["precio"]; ?></td>
                      <td><button class="btn btn-danger btnGrupoAsignar"  codigo="<?php echo $valueProductos["ruta"]; ?>" detalle="<?php echo $valueProductos["titulo"]; ?> " precio="<?php echo $valueProductos["precio"]; ?>">Asignar</button></td>
                    </tr>
                    
                  <?php endforeach ?>


                </tbody>


              </table>
            </div>

            <div class="col-lg-4">
              <!--=====================================
              ENTRADA PARA EL TÍTULO
              ======================================-->

              <div class="form-group">
                
                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                    <input type="text" class="form-control input-lg" name="codigoCombo" id="codigoCombo" placeholder="CODIGO">

                  </div>

              </div>

              <!--=====================================
              ENTRADA PARA EL TÍTULO
              ======================================-->

              <div class="form-group">
                
                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                    <input type="text" class="form-control input-lg" name="tituloCombo" id="tituloCombo" placeholder="TITULO DEL PRODUCTO">

                  </div>

              </div>

              <!--=====================================
              ENTRADA PARA Precio
              ======================================-->

              <div class="form-group">
                
                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-dollar "></i></span> 

                    <input type="text" class="form-control input-lg" name="importeCombo" id="importeCombo" placeholder="IMPORTE">

                  </div>

              </div>
               <!--=====================================
              ENTRADA PARA Precio
              ======================================-->

              <div class="form-group">
                
                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 

                    <input type="text" class="form-control input-lg" name="stockCombo" id="stockCombo" placeholder="STOCK">

                  </div>

              </div>

              <!--=====================================
              ENTRADA PARA Precio
              ======================================-->

              <div class="form-group">
                
                  <div class="input-group">

                    <textarea name="detalleCombo" id="" cols="40" rows="10"></textarea>

                  </div>

              </div>

            </div>


        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
  
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ">Guardar cambios</button>

        </div>

      </form>

     </div>

   </div>

</div>

<?php

  $agregarCombo = new ControladorProductos();
  $agregarCombo -> ctrAgregarCombo();

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
  

