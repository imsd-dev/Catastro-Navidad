<?php  
	$con = mysqli_connect("localhost", "santodomingo", "Cabildo35", "santodomingo_cl_santodomingo") or die ("Error");
?>
<link href='loguito.png' rel='shortcut icon' type='image/png'>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		
<script type="text/javascript">
//<![CDATA[
// 1000 = 1 segundo
//var mins = 20;
<?php  
	$this->load->driver('session');
	$variable = $this->session->sess_expiration;
	$exp= $this->config->item('sess_expiration');
?>
	var mins = '<?php echo $variable;?>';
	var exp= '<?php echo $exp;?>';
	function minutos(){
	document.getElementById("minutos").innerHTML=mins;

if(mins == 900){
	alert("La Sesión ha expirado");
	var dm = clearInterval(m);
	
 	//window.location = "index.php/blog/user_logout";
	window.location.href = "http://sistemas.santodomingo.cl/navidad/index.php/blog/user_logout";
	m = setInterval('minutos()', 1000);
}

	mins++;
}
 
var m = setInterval('minutos()', 1000);
 
//]]>
</script>
	<div class="container">
		</br>
		<div style="float: left;"  Width="800px">
			<h2>Catastro municipal de niños y niñas Navidad</h2>
			<h4>Ingrese cada niño utilizando el botón correspondiente, puede editar, listar y borrar registros</h4>
			<span id="minutos" hidden=""><script> document.write(mins); </script></span> 
		</div>
		<div style="float: right;" Width="800px">				

		<img src="<?php echo base_url('logo_firma.png'); ?>" Width="100px" />
		</div>
	</div>
<a href="<?php echo base_url('index.php/blog/inde'); ?>" class="btn btn-danger">Volver</a>&nbsp;&nbsp;
<a href="<?php echo base_url('index.php/blog/dExcel'); ?>" class="btn btn-success">Exportar todos los datos a Excel</a>&nbsp;&nbsp;
<a href="<?php echo base_url('index.php/blog/Excel'); ?>"  class="btn btn-success">Exportar tablas Excel</a>
<br/>

 
 <center>
<div style=" width: 1000px">
	<div style="float: left; width: 450px">		
		 <table name="ReporteEdad" class="table table-bordered table-responsive btn-default ng-table-responsive" style="width: 500px; height: 10px; text-align: center;" AllowPaging="True"">
			 <thead>
			 
			 	<tr style="font-weight: bold;">
			 		<td style="text-align: center;">Edad</td>
					<th style="text-align: center;">Hombres</th>
					<th style="text-align: center;">Mujeres</th>
					<th style="text-align: center;">Total</th>
			 	</tr>
			</thead>
			<!--___________________________________________________________________ Hombres de 0 años-->
			 	<?php 
					if($hom0){
						foreach($hom0 as $blog){
							$hom0 = $blog->Hombres0;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Femenino de 0 años-->	
			<?php 
					if($muj0){
						foreach($muj0 as $blog){
							$muj0 = $blog->Mujeres0;
							?>			
				<?php
						}
					}
					$total0=$hom0+ $muj0;
				?>
			<!--___________________________________________________________________ Hombres de 1 años  -->
				<?php 
					if($hom1){
						foreach($hom1 as $blog){
							$hom1 = $blog->Hombres1;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Hombres de 1 años  -->
			<?php 
					if($muj1){
						foreach($muj1 as $blog){
							$muj1 = $blog->Mujeres1;
							?>			
				<?php
						}
					}
					$total1=$hom1+ $muj1;
				?>
			<!--___________________________________________________________________ Hombres de 2 años  -->
				<?php 
					if($hom2){
						foreach($hom2 as $blog){
							$hom2 = $blog->Hombres2;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Hombres de 2 años  -->
			<?php 
					if($muj2){
						foreach($muj2 as $blog){
							$muj2 = $blog->Mujeres2;
							?>			
				<?php
						}
					}
					$total2=$hom2+ $muj2;
				?>
			<!--___________________________________________________________________ Hombres de 3 años  -->
				<?php 
					if($hom3){
						foreach($hom3 as $blog){
							$hom3 = $blog->Hombres3;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Hombres de 3 años -->
			<?php 
					if($muj3){
						foreach($muj3 as $blog){
							$muj3 = $blog->Mujeres3;
							?>			
				<?php
						}
					}
					$total3=$hom3+ $muj3;
				?>
			<!--___________________________________________________________________ Hombres de 4 años  -->
				<?php 
					if($hom4){
						foreach($hom4 as $blog){
							$hom4 = $blog->Hombres4;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Hombres de 4 años -->
			<?php 
					if($muj4){
						foreach($muj4 as $blog){
							$muj4 = $blog->Mujeres4;
							?>			
				<?php
						}
					}
					$total4=$hom4+ $muj4;
				?>
			<!--___________________________________________________________________ Hombres de 5 años -->
				<?php 
					if($hom5){
						foreach($hom5 as $blog){
							$hom5 = $blog->Hombres5;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 5 años -->
			<?php 
					if($muj5){
						foreach($muj5 as $blog){
							$muj5= $blog->Mujeres5;
							?>			
				<?php
						}
					}
					$total5=$hom5+ $muj5;
				?>
			<!--___________________________________________________________________ Hombres de 6 años -->
				<?php 
					if($hom6){
						foreach($hom6 as $blog){
							$hom6 = $blog->Hombres6;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 6 años -->
			<?php 
					if($muj6){
						foreach($muj6 as $blog){
							$muj6= $blog->Mujeres6;
							?>			
				<?php
						}
					}
					$total6=$hom6+ $muj6;
				?>
			<!--___________________________________________________________________ Hombres de 7 años -->
				<?php 
					if($hom7){
						foreach($hom7 as $blog){
							$hom7 = $blog->Hombres7;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 7 años -->
			<?php 
					if($muj7){
						foreach($muj7 as $blog){
							$muj7= $blog->Mujeres7;
							?>			
				<?php
						}
					}
					$total7=$hom7+ $muj7;
				?>
			<!--___________________________________________________________________ Hombres de 8 años -->
				<?php 
					if($hom8){
						foreach($hom8 as $blog){
							$hom8 = $blog->Hombres8;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 8 años -->
			<?php 
					if($muj8){
						foreach($muj8 as $blog){
							$muj8= $blog->Mujeres8;
							?>			
				<?php
						}
					}
					$total8=$hom8+ $muj8;
				?>
			<!--___________________________________________________________________ Hombres de 9 años -->
				<?php 
					if($hom9){
						foreach($hom9 as $blog){
							$hom9 = $blog->Hombres9;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 9 años -->
			<?php 
					if($muj9){
						foreach($muj9 as $blog){
							$muj9= $blog->Mujeres9;
							?>			
				<?php
						}
					}
					$total9=$hom9+ $muj9;
				?>
			<!--___________________________________________________________________ Hombres de 10 años -->
				<?php 
					if($hom10){
						foreach($hom10 as $blog){
							$hom10 = $blog->Hombres10;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 10 años -->
			<?php 
					if($muj10){
						foreach($muj10 as $blog){
							$muj10= $blog->Mujeres10;
							?>			
				<?php
						}
					}
					$total10=$hom10+ $muj10;
				?>
			<!--___________________________________________________________________ Hombres de 11 años -->
				<?php 
					if($hom11){
						foreach($hom11 as $blog){
							$hom11 = $blog->Hombres11;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 11 años -->
			<?php 
					if($muj11){
						foreach($muj11 as $blog){
							$muj11= $blog->Mujeres11;
							?>			
				<?php
						}
					}
					$total11=$hom11+ $muj11;
				?>
			<!--___________________________________________________________________ Hombres de 12 años -->
				<?php 
					if($hom12){
						foreach($hom12 as $blog){
							$hom12 = $blog->Hombres12;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 12 años -->
			<?php 
					if($muj12){
						foreach($muj12 as $blog){
							$muj12= $blog->Mujeres12;
							?>			
				<?php
						}
					}
					$total12=$hom12+ $muj12;
				?>
			<!--___________________________________________________________________ Hombres de 13 años  -->
				<?php 
					if($hom13){
						foreach($hom13 as $blog){
							$hom13 = $blog->Hombres13;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Hombres de 13 años -->
			<?php 
					if($muj13){
						foreach($muj13 as $blog){
							$muj13 = $blog->Mujeres13;
							?>			
				<?php
						}
					}
					$total13=$hom13+ $muj13;
				?>
			<!--___________________________________________________________________ Hombres de 14 años  -->
				<?php 
					if($hom14){
						foreach($hom14 as $blog){
							$hom14 = $blog->Hombres14;
							?>			
				<?php
						}
					}
				?>
			<!--___________________________________________________________________ Hombres de 14 años -->
			<?php 
					if($muj14){
						foreach($muj14 as $blog){
							$muj14 = $blog->Mujeres14;
							?>			
				<?php
						}
					}
					$total14=$hom14+ $muj14;
				?>
			<!--___________________________________________________________________ Hombres de 15 años -->
				<?php 
					if($hom15){
						foreach($hom15 as $blog){
							$hom15 = $blog->Hombres15;
							?>			
				<?php
						}
					}
				?>
			<!---___________________________________________________________________ Hombres de 15 años -->
			<?php 
					if($muj15){
						foreach($muj15 as $blog){
							$muj15= $blog->Mujeres15;
							?>			
				<?php
						}
					}
					$total15=$hom15+ $muj15;
				?>	
		<tbody class="contenidobusqueda">
		<h3>Cantidad de hombres y mujeres por edad</h3> 
			 	 <tr align="center">
					<td>0</td>
			 	 	<td><?php echo $hom0; ?></td>
			 	 	<td><?php echo $muj0; ?></td>	
			 	 	<td><?php echo $total0; ?></td>
			 	 </tr>
			 	  <tr align="center">
					<td>1</td>
			 	 	<td><?php echo $hom1; ?></td>
			 	 	<td><?php echo $muj1; ?></td>	
			 	 	<td><?php echo $total1; ?></td>
			 	 </tr>		
			 	  <tr align="center">
					<td>2</td>
			 	 	<td><?php echo $hom2; ?></td>
			 	 	<td><?php echo $muj2; ?></td>	
			 	 	<td><?php echo $total2; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>3</td>
			 	 	<td><?php echo $hom3; ?></td>
			 	 	<td><?php echo $muj3; ?></td>	
			 	 	<td><?php echo $total3; ?></td>		
			 	 </tr>
			 	  <tr align="center">
					<td>4</td>
			 	 	<td><?php echo $hom4; ?></td>
			 	 	<td><?php echo $muj4; ?></td>	
			 	 	<td><?php echo $total4; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>5</td>
			 	 	<td><?php echo $hom5; ?></td>
			 	 	<td><?php echo $muj5; ?></td>	
			 	 	<td><?php echo $total5; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>6</td>
			 	 	<td><?php echo $hom6; ?></td>
			 	 	<td><?php echo $muj6; ?></td>	
			 	 	<td><?php echo $total6; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>7</td>
			 	 	<td><?php echo $hom7; ?></td>
			 	 	<td><?php echo $muj7; ?></td>	
			 	 	<td><?php echo $total7; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>8</td>
			 	 	<td><?php echo $hom8; ?></td>
			 	 	<td><?php echo $muj8; ?></td>	
			 	 	<td><?php echo $total8; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>9</td>
			 	 	<td><?php echo $hom9; ?></td>
			 	 	<td><?php echo $muj9; ?></td>	
			 	 	<td><?php echo $total9; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>10</td>
			 	 	<td><?php echo $hom10; ?></td>
			 	 	<td><?php echo $muj10; ?></td>	
			 	 	<td><?php echo $total10; ?></td>	
			 	 </tr>	 	 
			 	  <tr align="center">
					<td>11</td>
			 	 	<td><?php echo $hom11; ?></td>
			 	 	<td><?php echo $muj11; ?></td>	
			 	 	<td><?php echo $total11; ?></td>
			 	 </tr>		
			 	  <tr align="center">
					<td>12</td>
			 	 	<td><?php echo $hom12; ?></td>
			 	 	<td><?php echo $muj12; ?></td>	
			 	 	<td><?php echo $total12; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>13</td>
			 	 	<td><?php echo $hom13; ?></td>
			 	 	<td><?php echo $muj13; ?></td>	
			 	 	<td><?php echo $total13; ?></td>		
			 	 </tr>
			 	  <tr align="center">
					<td>14</td>
			 	 	<td><?php echo $hom14; ?></td>
			 	 	<td><?php echo $muj14; ?></td>	
			 	 	<td><?php echo $total14; ?></td>	
			 	 </tr>
			 	  <tr align="center">
					<td>15</td>
			 	 	<td><?php echo $hom15; ?></td>
			 	 	<td><?php echo $muj15; ?></td>	
			 	 	<td><?php echo $total15; ?></td>	
			 	 </tr>
			 	 <?php 
			 	    $result=mysqli_query( $con  ,"select count(*) as total from ninos" );
					$data=mysqli_fetch_assoc($result);									
					$todos= $data['total'];  
				  ?>

			 	  <tr style="font-weight: bold;">
			 	 	<td style="text-align: left;">Total</td>
			 	 	<td></td>
			 	 	<td></td>
			 	 	<td><?php echo $todos;?></td>
			 	 </tr>		
		</tbody>
			 	 <?php  ?>
			 </table>
	</div>
&nbsp;&nbsp;&nbsp;
	<div style="float: right; width: 450px">
		<table name="ReporteEdad" class="table table-bordered table-responsive btn-default ng-table-responsive" style="width: 500px; height: 10px; text-align: center;" AllowPaging="True" >
			 <thead>
			 	<tr style="font-weight: bold;">
			 		<td style="text-align: left;">Organizacion</td>
					<th style="text-align: center;">Hombres</th>
					<th style="text-align: center;">Mujeres</th>
					<th style="text-align: center;">Total</th>
			 	</tr>
			</thead>
			
		<h3>Hombres y mujeres por organizacion</h3>
		<tbody class="contenidobusqueda">		 	
			 	 <?php 
						
					foreach($orga as $fila)
						{
							$orga = $fila->organizacion;
							$id= $fila->id;	

						?>  
						<tr align="center">
						<td style="text-align: left;"> <?php echo $orga;?></td>
						

						<?php 					
						
							$resultH=mysqli_query( $con  ,"select count(*) as hombres from ninos where sexo= 'Masculino' and id_organizacion = '".$id."'" );
							$dataH=mysqli_fetch_assoc($resultH);						
							$ninos= $dataH['hombres'];
						?>
							<td> <?php echo $dataH['hombres'];?></td>
						<?php 					
						
							$resultM=mysqli_query( $con  ,"select count(*) as mujeres from ninos where sexo= 'Femenino' and id_organizacion = '".$id."'" );
							$dataM=mysqli_fetch_assoc($resultM);						
							$ninas= $dataM['mujeres'];
							$total= $ninos + $ninas;

						?>

							<td> <?php echo $dataM['mujeres'];?></td>
							<td> <?php echo $total;?></td>

						<?php						
						}							
						?>	
						 	 	
			 	 </tr>	
			 	 <tr style="font-weight: bold;">
			 	 	<td style="text-align: left;">Total</td>
			 	 	<td></td>
			 	 	<td></td>
			 	 	<td><?php echo $todos;?></td>
			 	 </tr>	
			 	 
		</tbody>
			 	 <?php   ?>
		</table>
			 <!--<ul class="pagination">
			            <?php
			              /* Se imprimen los números de página */           
			             // echo $this->pagination->create_links();
			            ?>
			 </ul>   -->
		</div>
	</div>
</center>
