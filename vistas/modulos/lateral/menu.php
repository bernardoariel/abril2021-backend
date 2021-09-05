<!--=====================================
MENU
======================================-->	

<ul class="sidebar-menu">

	<li class="active"><a href="inicio"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

  <?php

  if($_SESSION["perfil"] == "administrador"){

	echo '<li><a href="comercio"><i class="fa fa-files-o"></i> <span>Gestor Comercio</span></a></li>';

  }

  ?>

	<li><a href="slide"><i class="fa fa-edit"></i> <span>Gestor Slide</span></a></li>

	<li class="treeview">
      
      <a href="#">
        <i class="fa fa-th"></i>
        <span>Gestor Categorías</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        
        <li><a href="categorias"><i class="fa fa-circle-o"></i> Categorías</a></li>
        <li><a href="subcategorias"><i class="fa fa-circle-o"></i> Subcategorías</a></li>
      
      </ul>

  </li>

  <li class="treeview">
      
      <a href="#">
        <i class="fa fa-circle-o"></i>
        <span>Gestor PRODUCTOS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        
        <li><a href="productos"><i class="fa fa-product-hunt"></i> <span>Gestor Productos</span></a></li>
        <li><a href="productos2"><i class="fa fa-product-hunt"></i> <span>Gestor Productos2</span></a></li>
      
      </ul>

  </li>

 

  <li><a href="banner"><i class="fa fa-map-o"></i> <span>Gestor Banner</span></a></li>

  <?php

  if($_SESSION["perfil"] == "administrador"){

  echo '<li><a href="ventas"><i class="fa fa-shopping-cart"></i> <span>Gestor Ventas</span></a></li>';

  }

  ?>

  <li><a href="visitas"><i class="fa fa-map-marker"></i> <span>Gestor Visitas</span></a></li>

  <li><a href="usuarios"><i class="fa fa-users"></i> <span>Gestor Usuarios</span></a></li>

  <?php

   if($_SESSION["perfil"] == "administrador"){

    echo '<li><a href="perfiles"><i class="fa fa-key"></i> <span>Gestor Perfiles</span></a></li>';
    echo '<li><a href="excel"><i class="fa fa-file-excel-o"></i> <span>Importar Excel</span></a></li>';
    echo '<li><a href="csv"><i class="fa fa-file-excel-o"></i> <span>Importar CSV</span></a></li>';
    echo '<li><a href="bdcorrecciones"><i class="fa fa-database"></i> <span>Correciones</span></a></li>';
  }

  ?>

</ul>	