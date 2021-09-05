<?php 

$tienda = Ruta::ctrRuta();
$backend = Ruta::ctrRutaServidor();
$home = Ruta::ctrRutaHome();

 ?>
<!--=====================================
LLAMADAS A URL EXTERNOS
======================================-->
<ul class="nav navbar-nav">
				
	<li class="nav-item">

		<a  href="<?php echo $tienda; ?>" target="_blank"  title="ir a la tienda">
			<i class="fa fa-chrome"></i><span class="label label-danger">tienda</span>
		</a>

	</li>

	<li class="nav-item">

	   <a class="nav-link" href="<?php echo $home; ?>" title="ir a la landing" target="_blank"><i class="fa fa-home"></i><span class="label label-success">home</span></a>
	</li>

</ul>