<div class="content-wrapper">
    
  <section class="content-header">
    
    <h1>
      Importar Excel
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Importar Excel</li>
      
    </ol>

  </section>

  <section class="content">
    
    <div class="box box-success">

      
  
      <div class="box-header with-border">

      <?php  if(!isset($_POST["seleccionarListado"])): ?>
          
        <form method="POST" enctype="multipart/form-data">

        <div class="row">

          <div class="col-lg-4">
            <!--=====================================
            ENTRADA PARA SELECCIONAR LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon" style="background: #5cb85c; color:white"><i class="fa fa-file-excel-o"></i></span> 

                <select class="form-control input-lg" name="seleccionarListado" id="seleccionarListado" required>
                  
                  <option value="">Seleccionar EXCEL</option>

                  <option value="productos">PRODUCTOS</option>
                  <option value="listado">LISTADO</option>

                </select>

              </div>

            </div>

          </div>

          <div class="col-lg-8">
            
            <figure width="150px">

              <img src="" alt="" id="imagenexcel">
  
            </figure>
            
          </div>

        </div>

        <div class="row">
        
          <div class="col-lg-12">
           
           <input type="file" class="subirExcel" name="uploadedFile">

           <p class="help-block">Seleccione El Archivo del tipo excel para subir</p>

           <img src="vistas/img/plantilla/excelgris.jpg" class="img-thumbnail previsualizarExcel" width="15%">

          </div>
        
        </div>

        <div class="row">
        
          <div class="col-lg-2">
           
            <button class="btn btn-info btn-lg btn-block">

              <strong><i class="fa fa-cloud-upload pull-left" style="font-size: 22px" aria-hidden="true"></i></strong> SUBIR    

            </button>

          </div>

        </div>

      </form>

      <?php endif ?>

      <?php

        $subirListado = new ControladorImportar();
        $subirListado -> ctrSubirListado();

      ?>
       

      </div>
   

    

      <div class="box-body">

      <?php

       

        if(isset($_POST["seleccionarListado"])){

          require_once 'extensiones/PHPExcel/Classes/PHPExcel.php';

          #seleccionar el listado o los productos
          if($_POST["seleccionarListado"]=="listado"){

            $archivo = "vistas/archivos/listado.xlsx";

            echo ' <table class="table table-bordered tablaImportar">
    
                  <thead>

                    <tr>
                      <th>#</th>
                      <th>A-Cod./Cod.</th>
                      <th>C-SubCat/Nombre</th>
                      <th>D-Medida</th>
                      <th>E-Descripcion</th>
                      <th>H-Marca</th>
                      <th>J-STOCK</th>
                      <th>K-Importe</th>
                    </tr>

                  </thead>

                  <tbody>';

                  $inputFileType = PHPExcel_IOFactory::identify($archivo);
                  $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                  $objPHPExcel = $objReader->load($archivo);
                  $sheet = $objPHPExcel->getSheet(0); 
                  $highestRow = $sheet->getHighestRow(); 
                  $highestColumn = $sheet->getHighestColumn();

                  $num=0;
                  $cant=1;
          
                  for ($row = 2; $row <= $highestRow; $row++){
                    
                    $num++;
                    $celda=$sheet->getCell("A".$row)->getValue();

                    if ($celda!="" && $celda!="Codigo"){ ?>
                  
                     <tr>

                        <th scope='row'><?php echo $cant;$cant++;?></th>
                        <td><?php echo $sheet->getCell("A".$row)->getValue();?></td>
                        <td><?php echo $sheet->getCell("C".$row)->getValue();?></td>
                        <td><?php echo $sheet->getCell("D".$row)->getValue();?></td>
                        <td><?php echo $sheet->getCell("E".$row)->getValue();?></td>
                        <td><?php echo $sheet->getCell("H".$row)->getValue();?></td>
                        <td><?php echo $sheet->getCell("J".$row)->getValue();?></td>
                        <td><?php echo $sheet->getCell("K".$row)->getValue();?></td>
                      </tr>

                  

                  <?php 
                    //ESTADO=0 NO ESTA ACTIVO ESTADO=1 ESTA ACTIVO CON FOTO ESTADO 2 ESTA ACTIVO SIN FOTO NO SALE EN LA PORTADA
                    ($sheet->getCell("J".$row)->getValue()>=0) ? $estado = 2: $estado = 0;
                      $datos = array("ruta"=>$sheet->getCell("A".$row)->getValue(),
                                     "titular"=>mb_convert_encoding($sheet->getCell("C".$row)->getValue()." ".$sheet->getCell("D".$row)->getValue(),"UTF-8"),
                                     "titulo"=>$sheet->getCell("C".$row)->getValue()." ".$sheet->getCell("D".$row)->getValue(),
                                     "descripcion"=> $sheet->getCell("E".$row)->getValue(),
                                     "estado"=> $estado,
                                     "marca"=> $sheet->getCell("H".$row)->getValue(),
                                     "stock"=>$sheet->getCell("J".$row)->getValue(),
                                     "precio"=>$sheet->getCell("K".$row)->getValue(),
                                     "peso"=>1,
                                     "entrega"=>"25",
                                     "portada"=>"25",
                                     "vista"=>"productos");

                    $subcategoria = mb_convert_encoding($sheet->getCell("C".$row)->getValue(),"UTF-8");
                  
                      
                    ControladorImportar::ctrCrearProductoListado($datos,$subcategoria);


                    }//IF

                  }//FOR



           

          }else{

            $archivo = "vistas/archivos/productos.xlsx";  

              echo ' <table class="table table-bordered tablaImportar">
    
                      <thead>

                        <tr>
                          <th>#</th>
                          <th>Codigo</th>
                          <th>Nombre</th>
                          <th>Marca</th>
                          <th>Precio</th>
                        </tr>

                      </thead>

                      <tbody>';

              $inputFileType = PHPExcel_IOFactory::identify($archivo);
              $objReader = PHPExcel_IOFactory::createReader($inputFileType);
              $objPHPExcel = $objReader->load($archivo);
              $sheet = $objPHPExcel->getSheet(0); 
              $highestRow = $sheet->getHighestRow(); 
              $highestColumn = $sheet->getHighestColumn();

              $num=0;
              $cant=1;
              $bndPrimerRow = 0;
          
              for ($row = 2; $row <= $highestRow; $row++){
                
                $num++;
                $celda=$sheet->getCell("B".$row)->getValue();

                if ($celda!="" && $celda!="COD.Z. 1"){

                  if($celda=="SUCURSALES ABRIL AMOBLAMIENTOS"){
                    break;
                  }else{
                    $bndPrimerRow = 1;
                  }
                 

                }else{

                  $bndPrimerRow = 0;

                }

                  if($bndPrimerRow==1){

                    $letra = substr($sheet->getCell("G".$row)->getValue(),0,1);
                    if($letra == "="){

                      // $importe=$letra;
                      // $restarPrimeraLetra = substr($sheet->getCell("G".$row)->getValue(), 1);  
                      // print_r(explode('+',$restarPrimeraLetra,0));
                      $importe = 0;//$rest;//$sheet->getCell("G".$row)->getValue();

                    }else{

                       $importe = $sheet->getCell("G".$row)->getValue();
                    }
                ?>

                  <tr>

                    <th scope='row'><?php echo $cant;$cant++;?></th>
                    <td><?php echo $sheet->getCell("B".$row)->getValue();?></td>
                    <td><?php echo $sheet->getCell("D".$row)->getValue();?></td>
                    <td><?php echo $sheet->getCell("E".$row);?></td>
                    <td><?php echo $importe;?></td>
                    
                  </tr>
              
                <?php

       

                  }//bndPrimerRow

                ?>
              
                 
          <?php 

             

              }//FOR

          }
          
          ?>
          
         
          
      

          

         </tbody>

        </table>
          
       <?php } 

      
        

          $subCat = ControladorSubCategorias::ctrMostrarSubCategorias("id_categoria",0);
          $categorias = ControladorCategorias::ctrMostrarCategorias(null,null);
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


          

                  ?>

                  </tbody>

        </table>


      </div>

    </div>

  </section>

</div>
