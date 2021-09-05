  <div class="content-wrapper">
      
    <section class="content-header">
        
      <h1>
        Gestor Correcion de Bd
      </h1>
   
      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Gestor Correcion de Bd</li>
        
      </ol>

    </section>

    <section class="content">

      <div class="box-body">

        <div class="col-md-6">

          <div class="box box-primary">

          <?php 

          $ordenar = "id";
          $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);

          $importados = count(ControladorCorrecciones::ctrMostrarTotalImport());

          $todosCatalogo = count(ControladorCorrecciones::ctrProductosTotales("catalogo"));
          $todosProductos = count(ControladorCorrecciones::ctrProductosTotales("productos")); 
          

      

          $ordenar = "id";
          $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);

          $gruposCodigo = array();
          $gruposId = array();

          foreach ($productos as $key => $value) {

            $bsq_sql = strstr($value["ruta"],"-", true);

            if($bsq_sql==true){

              array_push ($gruposCodigo , $value["codigo"]);
              array_push ($gruposId , $value["id"]);
            }

          }

       

          ?>

          <div class="box-header with-border">

            <input type="hidden" name="espacios" val="1">
            
            <h3 class="box-title text-danger">Actualizar precios</h3>

            <div class="box-tools pull-right">

              <span class="label label-danger"><?php echo count($productos); ?> Productos</span>

              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

            </div>

          </div>

          <div class="box-body no-padding">

            <h3>#EN PHPMYADMIN DE LA WEB</h3>
            
            <ol>
              <li class="mt-2"> Descargo  la bd </li>
              <li class="mt-2"> La importo al localhost</li>
            </ol>

            <h3>#TRATAMIENTO DEL ARCHIVO EXCEL</h3>
            
            <ol>
              <li class="mt-2">Quito las 15 filas.</li>
              <li class="mt-2">Elimino columna B</li>
              <li class="mt-2">Elimino Columna E F</li>
              <li class="mt-2">Elimino Columna F</li>
              <li class="mt-2">FORMATEO G CON NUMERO SIN 2 DECXIMALES</li>
              <li class="mt-2">AGREGO LA COLUMNA A con los numeros del 1 al</li>
              
            </ol>

            <h3>#EN PHPMYADMIN</h3>
            
            <ol>

              <li class="mt-2">Limpio la tabla import 
                <span><strong><small class="importados label label-success  ">( <?php echo $importados; ?> registros )</small></strong></span> 
                <br>
                <button class="btn btn-danger btn-xs" id="btnLimpiarTablaImport">Limpiar la tabla </button>
              </li>

              <li class="mt-2">Importo PRIMERO EN LA TABLA  el csv using loading data Y LUEGO TOCO ESTE BOTON
                <br>
                <button class="btn btn-danger btn-xs" id="btnCargarTablaImport">Cargar la tabla</button>
              </li>

              <li class="mt-2">Elimino los espacios en mysql
                
                <span><strong><small class="importados label label-success  ">( <?php echo $importados; ?> registros )</small></strong></span>
                <br>
                <button class="btn btn-danger btn-xs" id="btnEliminarEspacios">Elimino los espacios</button>
              </li>
              
              <br>
              <li class="mt-2">

                <div class="col-md-8">

                  <select id="tipovistas" class="form-control">

                    <option value="0">ELEGIR</option>
                    <option value="catalogo">Mantengo los productos del catalogo</option>
                    <option value="productos">No mantengo los productos del catalogo</option>
                  
                  </select>

                </div>

                <div class="col-md-4">

                  <button  class="btn btn-primary" id="btnStockaCero" disabled>stock a cero</button>

                </div>
                
              </li>

              <br>
              
              <li class="mt-2">
                
                Paso los datos de la tabla import a la tabla nueva

                <?php if ($importados==0): ?>

                  <button  class="btn btn-danger" id="btnActualizarProductos" disabled>Actualizar Productos</button>

                <?php else: ?>

                  <button  class="btn btn-danger" id="btnActualizarProductos">Actualizar Productos</button>
                  
                <?php endif ?>
                
                <br>
                <small class="label label-warning" id="totCatalogo"><?php echo $todosCatalogo; ?> Catalogo</small> 
                <small class="label label-success" id="totProductos"><?php echo $todosProductos; ?> Productos</small> 
                <small class="label label-default" id="totGrupos"><?php echo count($gruposId); ?> Grupos Combos</small> 
                <br>


                <div id="productosNuevos" class="label label-info">----------------------------------------

                  </div>

              </li>
              <li class="mt-2">REVISO SI EXISTEN NUEVOS PRODUCTOS EN TAL CASO... </li>
              <li class="mt-2"> CREO LAS CARPETAS DE LOS MISMOS</li>
              <li class="mt-2">LAS COPIO AL SERVIDOR</li>


            </ol>
          
          </div>

        </div>
        <div class="col-md-12">

          <div class="box box-warning">
            
            <div class="box-header with-border">

              <input type="hidden" name="espacios" val="1">

                <h3 class="box-title text-danger">CARGAR COMBOS</h3>

                  <div class="box-tools pull-right">
                    <?php
                      $todosPromo = count(ControladorCorrecciones::ctrProductosTotales2("promo")); 
                    ?>
                    <span class="label label-danger"><?php echo $todosPromo; ?> Promo</span>

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

                  </div>

            </div>

            <div class="box-body no-padding">
            <button  class="btn btn-danger" id="btnAgregarPromo">AGREGAR PROMOS</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        
        <div class="box box-info">

        

          <div class="box-header with-border">

            <input type="hidden" name="espacios" val="1">
            
            <h3 class="box-title">Revisar los items con guiones</h3>

            <div class="box-tools pull-right">

              <span class="label label-danger"><?php echo count($gruposId); ?> Grupos</span>

              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

            </div>

          </div>

          <div class="box-body no-padding">

            

             <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          
              <thead>
             
                <tr>
                 
                   <th style="width:10px">#</th>
                   <th>Titulo</th>
                   <th>Ruta</th>
                   <th>Descripción</th>
                   <th>Imagen Principal</th>
                   <th>Precio</th>
                  

                </tr> 

              </thead>   

              <tbody>

                <?php

                  foreach ($gruposId as $key => $valueGrupoId) {            
                    
                    $item="id";
                    $valor=$valueGrupoId;

                    $productosGrupos = ModeloProductos::mdlMostrarProductos2("productos",$item, $valor);
                    
                    if($productosGrupos["precio"]==0){$color="danger";}else{$color="success";}
                    echo "<tr>
                            <td><button class='btn btn-".$color." btn-xs btnIdCombo' id='".$productosGrupos["id"]."' codigo='".$productosGrupos["codigo"]."' importe='".$productosGrupos["precio"]."' stock='".$productosGrupos["stock"]."' data-toggle='modal' data-target='#modalEditarCombo' >".$productosGrupos["id"]."</button></td>  
                            <td>".$productosGrupos["titulo"]."</td>
                            <td>".$productosGrupos["ruta"]."</td>
                            <td>".$productosGrupos["descripcion"]."</td>
                            <td><img src='".$productosGrupos["portada"]."' width='50px'></td>
                            <td>".$productosGrupos["precio"]."</td>
                          </tr>";
                  }

                  
                ?>

              </tbody>

              </table>

    
           

          </div>


          <div class="box-footer text-center">
            
            <button  class="btn btn-primary" id="btnCorregir">Eliminar '/' de el titulo</button>

            
          </div>
        
        </div>
        
      </div>

                 
    </div>
          
    </section>

  </div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarCombo" class="modal fade" role="dialog">
  
   <div class="modal-dialog">
     
     <div class="modal-content">

        <form action="" method="post">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Combo</h4>

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

                <input type="hidden" name="idProductoCombo" id="idProductoCombo">

                <input type="text" class="form-control input-lg" name="codigoProductoCombo" id="codigoProductoCombo" placeholder="CODIGO" readonly>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA Precio
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                  <input type="text" class="form-control input-lg" name="importeProducto" id="importeProducto" placeholder="IMPORTE">

                </div>

            </div>

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <input type="text" class="form-control input-lg" name="stockProducto" id="stockProducto" placeholder="stock">

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

  $agregarCombo = new ControladorCorrecciones();
  $agregarCombo -> ctrModificarPrecioCombo();
 

?>


