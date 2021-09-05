<div class="content-wrapper">
    
  <section class="content-header">
    
    <h1>  
      Tabla Import
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Importar Excel</li>
      
    </ol>

  </section>

  <section class="content">
    
     <?php if (!isset($_GET["aplicar"])): ?>

     <div class="box box-success">

      <div class="box-header with-border">

        <h3 class="box-title">IMPORTAR CSV</h3>

 

      </div>
      
      <h4>1.Importar la tabla usando csv _loading data</h4>
      <h4>2.CHEQUEAR LAS Ñ</h4>
      <h4>3.CHEQUEAR''</h4>
      <h4>4.CHEQUEAR Ã</h4> 
      
      <?php 

        $item =  null;
        $valor = null;
        $mostrarDatosImportados = ControladorImportar::ctrMostrarDatosImportados($item,$valor);

       ?>
      <table class="table table-bordered tablaImportar">
    
        <thead>

          <tr>
            <th>#</th>
            <th>codigo</th>
            <th>Subcategoria</th>
            <th>descripcion1</th>
            <th>descripcion2</th>
            <th>marca</th>
            <th>stock</th>
            <th>importe</th>
            <th>acciones</th>
          </tr>

        </thead>

        <tbody>

          <?php foreach ($mostrarDatosImportados as $key => $value): ?>

          <tr>

            <td><?php echo $key+1;?></td>
            <td><?php echo $value["codigo"]; ?></td>
            <td><?php echo $value["subcategoria"]; ?></td>
            <td><?php echo $value["descripcion1"]; ?></td>
            <td><?php echo $value["descripcion2"]; ?></td>
            <td><?php echo $value["marca"]; ?></td>
            <td><?php echo $value["stock"]; ?></td>
            <td><?php echo $value["importe"]; ?></td>
            <td>

              <div class='btn-group'><button class='btn btn-warning btnEditarImportacion' idImportar="<?php echo $value["id"]; ?>" data-toggle='modal' data-target='#modalModificarImportacion'><i class='fa fa-pencil'></i></button>
              <button class='btn btn-danger btnEliminarImportacion' idImportacion="<?php echo $value["id"]; ?>"><i class='fa fa-times'></i></button></div>

            </td>

          </tr>
            
          <?php endforeach ?>
  
        </tbody>
      
      </table>




     </div>

     <div class="box box-success">

        <div class="box-header with-border">
          
          <h3 class="box-title">copiar a la tabla de productos</h3>
        
        </div>

        <div class="box-body with-border">

          <button class="btn btn-danger"><a href="index.php?ruta=csv&aplicar=1">APLICAR</a></button>

        </div>

     </div>
      
    <?php endif ?>

     <?php if (isset($_GET["aplicar"])): ?>

      <div class="box box-danger">

        <div class="box-header with-border">
          
          <h3 class="box-title">COPIANDO</h3>
        
        </div>

        <div class="box-body with-border">

        <?php 

        $item =  null;
        $valor = null;
        $mostrarDatosImportados = ControladorImportar::ctrMostrarDatosImportados($item,$valor);

        ?>

        <?php foreach ($mostrarDatosImportados as $key => $value): ?>

          <?php 
            
            //ESTADO=0 NO ESTA ACTIVO ESTADO=1 ESTA ACTIVO CON FOTO ESTADO 2 ESTA ACTIVO SIN FOTO NO SALE EN LA PORTADA
            if($value["stock"]==0){$estado=0;}else{$estado=2;}
            
            $datos = array("ruta"=>$value["codigo"],
              "codigo"=>$value["codigo"],
                           "titular"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
                           "titulo"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
                           "descripcion"=> $value["descripcion2"],
                           "estado"=> $estado,
                           "marca"=> $value["marca"],
                           "stock"=> $value["stock"],
                           "precio"=>$value["importe"],
                           "peso"=>1,
                           "entrega"=>"25",
                           "portada"=>"25",
                           "vista"=>"productos");

            $subcategoria = $value["subcategoria"];
                  
                      
            ControladorImportar::ctrCrearProductoListado($datos,$subcategoria);

           ?>

        <?php endforeach ?>

        </div>

      </div>
       
     <?php endif ?>

     <div class="box box-info">

      <div class="box-header with-border">

        <h3 class="box-title">MODIFICAR CATEGORIAS DE LOS PRODUCTOS</h3>

      </div>

      <div class="box-body with-border">

        <?php 

          $subCat = ControladorSubCategorias::ctrMostrarSubCategorias("id_categoria",0);
          $categorias = ControladorCategorias::ctrMostrarCategorias(null,null);

          if(!empty($subCat)){


            echo ' <table class="table table-bordered tablaImportar">
      
                    <thead>

                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>categoria</th>
                      </tr>

                    </thead>

                    <tbody>';

                    foreach ($subCat as $key => $value) {
                      # code...
                      echo '<tr>';
                      echo '<td>'.$value["id"].'</td>';
                      echo '<td>'.$value["subcategoria"].'</td>';
                      echo '<td>';

                      echo '<form><div class="input-group">
                              <span class="input-group-addon"></span>
                                <select class="form-control input-lg seleccionarCategoria" name="categoria"  id="'.$value["id"].'" title="Elija la Entidad Financiera" >
                                  <option value="0" >Sin Seleccionar</option>';

                                  foreach ($categorias as $key => $valueCategorias) {
                                    echo '<option value="'.$valueCategorias["id"].'" >'.$valueCategorias["categoria"].'</option>';
                                        
                                  }
           
                                    
                           echo  '</div></form></td>';

                      echo '</tr>';
                    }

                  }else{

                    /*=============================================
                    copiamos en la tabla producto
                    =============================================*/
                     
                    $item = null;
                    $valor = null;
                    $listado = ControladorImportar::ctrMostrarListado($item,$valor);
                    
                    foreach ($listado as $key => $value){

                      $item = "ruta";
                      $valor = $valor["ruta"];

                      $producto=ControladorProductos::ctrMostrarProductos($item,$valor);

                      if(empty($producto)){

                          $datos =array("id_categoria"=>$value["id_categoria"],
                                    "id_subcategoria"=>$value["id_subcategoria"],
                                    "tipo"=>$value["tipo"],
                                    "vista"=>$value["vista"],
                                    "ruta"=>$value["ruta"],
                                    "codigo"=>$value["codigo"],
                                    "estado"=>$value["estado"],
                                    "titulo"=>$value["titulo"],
                                    "titular"=>$value["titular"],
                                    "descripcion"=>$value["descripcion"],
                                    "marca"=>$value["marca"],
                                    "stock"=>$value["stock"],
                                    "multimedia"=>'[{"foto":"vistas/img/productos/default/default.jpg"}]',
                                    "detalles"=>$value["detalles"],
                                    "precio"=>$value["precio"],
                                    "portada"=>"vistas/img/productos/default/default.jpg",
                                    "imagen_tabla"=>$value["imagen_tabla"],
                                    "vistas"=>$value["vistas"],
                                    "ventas"=>$value["ventas"],
                                    "vistasGratis"=>$value["vistasGratis"],
                                    "ventasGratis"=>$value["ventasGratis"],
                                    "ofertadoPorCategoria"=>$value["ofertadoPorCategoria"],
                                    "ofertadoPorSubCategoria"=>$value["ofertadoPorSubCategoria"],
                                    "oferta"=>$value["oferta"],
                                    "precioOferta"=>$value["precioOferta"],
                                    "descuentoOferta"=>$value["descuentoOferta"],
                                    "imgOferta"=>$value["imgOferta"],
                                    "finOferta"=>$value["finOferta"],                                  
                                    "peso"=>$value["peso"],
                                    "entrega"=>$value["entrega"]);

                          $crearProducto = ControladorImportar::ctrCopiarAProductos($datos);
                          echo '<pre>'; print_r($crearProducto); echo '</pre>';

                      }else{


                         $datos =array("id_categoria"=>$value["id_categoria"],
                                    "id_subcategoria"=>$value["id_subcategoria"],
                                    "codigo"=>$value["codigo"],
                                    "stock"=>$value["stock"],
                                    "precio"=>$value["precio"],
                                    "precioOferta"=>0,
                                    "descuentoOferta"=>0);
                          
                          $ActualizarProducto = ControladorImportar::ctrActualizarProductos($datos);

                      }  
                      
                    }
                    
                  }

            ?>

                  </tbody>

        </table>


      </div>

      <div class="box box-info">

      <div class="box-header with-border">

        <h3 class="box-title">MODIFICAR CATEGORIAS DE LOS PRODUCTOS</h3>

      </div>

      <div class="box-body with-border">



      </div>

       
     
     


  </section>

</div>


<!--=====================================
      VER HISTORIAL CLIENTE
======================================-->
<div id="modalModificarImportacion" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" >
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">MODIFICAR</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">
              
                <input type="hidden" id="idImportar" name="idImportar">

                <input type="text" class="form-control input-lg" name="codigo" id="codigo">

                <span class="input-group-addon">CODIGO</span>

              </div>

            </div>

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">

                <input type="text" class="form-control input-lg" name="subcategoria" id="subcategoria">

                <span class="input-group-addon">SUBCATEGORIA</span>

              </div>

            </div>

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">        

                <input type="text" class="form-control input-lg" name="descripcion1" id="descripcion1">

                <span class="input-group-addon">DESCRIPCION1</span>      

              </div>

            </div>

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">

                <input type="text" class="form-control input-lg" name="descripcion2" id="descripcion2">

                <span class="input-group-addon">DESCRIPCION2</span>        

              </div>

            </div>

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">
            
                <input type="text" class="form-control input-lg" name="marca" id="marca">

                <span class="input-group-addon">MARCA</span>   

              </div>

            </div>

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">
                
                <input type="text" class="form-control input-lg" name="stock" id="stock">

                <span class="input-group-addon">STOCK</span>        


              </div>

            </div>

            <!-- ENTRADA PARA SU TIPO DE historial -->
            <div class="form-group">
              
              <div class="input-group">

                <input type="text" class="form-control input-lg" name="importe" id="importe">

                <span class="input-group-addon">IMPORTE</span>       

              </div>

            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

      </form>

       <?php

         $modificarImportacion = new ControladorImportar();
         $modificarImportacion -> ctrModificarImportar();

      ?>




    </div>

  </div>

</div>
