<?php

$plantilla = ControladorComercio::ctrSeleccionarPlantilla();

?>

<div class="box box-danger">
	
	<div class="box-header with-border">

		<h3 class="box-title">LANDING</h3>

		<div class="box-tools pull-right">

      		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

        		<i class="fa fa-minus"></i>

        	</button>

        </div>
	
	</div>

	<div class="box-body">
	 	
 		<div class="panel panel-default">
        
      <div class="panel-heading">

        <h4 class="text-uppercase">PRODUCTOS CATALOGO</h4>

      </div>
      
      <div class="panel-body">
        
        <div class="form-group row">
          
          <div class="col-xs-4">
            
            <button class="btn btn-danger"><i class="fa fa-photo"></i> <span>Eliminar Todas</span></button>

          </div>

          <div class="col-xs-4">
            
            <button class="btn btn-success"><i class="fa fa-photo"></i> <span>Agregar Img Catalogo</span></button>

          </div>

          <div class="col-xs-4">

            <button class="btn btn-success"><i class="fa fa-photo"></i> <span>Eliminar Img Tapa</span></button>

          </div>

        </div>
        
        <div class="form-group row">

          <div class="col-xs-4">
            
             <div class="btn-group">

            <?php 

              $item = "nombre";
              $valor = "sectionpromo";
              $verCatalogo = ControladorComercio::ctrMostrarCatalogo($item,$valor);

              if($verCatalogo["valor"]=="mostrar"){

                $icono ="fa-eye";

              }else{

                $icono ="fa-eye-slash";

              }
              
              
             ?>

            <button type="button" class="btn btn-warning"><i class="fa <?php echo $icono; ?>"></i> ||  Section Promo</button>
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>

            <ul class="dropdown-menu" role="menu">
              <li><a href="index.php?ruta=promo&ver=mostrar&tipo=sectionpromo">Mostrar SECTION</a></li>
              <li><a href="index.php?ruta=promo&ver=ocultar&tipo=sectionpromo">Ocultar SECTION</a></li>
            </ul>

          </div>
          </div>
          
          <div class="col-xs-4">

            <div class="btn-group">

            <?php 

              $item = "nombre";
              $valor = "catalogo";
              $verCatalogo = ControladorComercio::ctrMostrarCatalogo($item,$valor);

              if($verCatalogo["valor"]=="mostrar"){

                $icono ="fa-eye";

              }else{

                $icono ="fa-eye-slash";

              }
              
              
             ?>

            <button type="button" class="btn btn-primary"><i class="fa <?php echo $icono; ?>"></i> ||Btn Catalogo</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>

            <ul class="dropdown-menu" role="menu">
              <li><a href="index.php?ruta=promo&ver=mostrar&tipo=btncatalogo">Mostrar Catalogo</a></li>
              <li><a href="index.php?ruta=promo&ver=ocultar&tipo=btncatalogo">Ocultar Catalogo</a></li>
            </ul>

          </div>

        </div>

        <div class="col-xs-4">

          <div class="btn-group">

            <?php 

              $item = "nombre";
              $valor = "productos";
              $verCatalogo = ControladorComercio::ctrMostrarCatalogo($item,$valor);

              if($verCatalogo["valor"]=="mostrar"){

                $icono ="fa-eye";

              }else{

                $icono ="fa-eye-slash";

              }
              
              
             ?>

            <button type="button" class="btn btn-danger"><i class="fa <?php echo $icono; ?>"></i> ||  Productos</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>

            <ul class="dropdown-menu" role="menu">
              <li><a href="index.php?ruta=promo&ver=mostrar&tipo=productostienda">Mostrar Productos</a></li>
              <li><a href="index.php?ruta=promo&ver=ocultar&tipo=productostienda">Ocultar Productos</a></li>
            </ul>

          </div>
          


        </div>

          


        </div>

      </div>

	  </div>

  </div>

	<div class="box-footer">
      
    	
    
  </div>

</div>