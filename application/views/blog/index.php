<link href='loguito.png' rel='shortcut icon' type='image/png'>	
<script type="text/javascript">
	$(document).ready(function () {
   		$('#entradafilter').keyup(function () {
     	 var rex = new RegExp($(this).val(), 'i');
        $('.contenidobusqueda tr').hide();
        $('.contenidobusqueda tr').filter(function () {
            return rex.test($(this).text());
        }).show();

     })

	});

	$(document).ready(function() { 
    $("table") 
    .contenidobusqueda({widthFixed: true, widgets: ['zebra']}) 
    .contenidobusquedaPager({container: $("#pager")}); 
	}); 

$(document).ready(function() {

	if (document.getElementById('orga').value == "4" ) {
		document.getElementById("Fecha").setAttribute("min", "1950-01-01");
	} else {
		document.getElementById("Fecha").setAttribute("min", "2000-01-01");
	}
					
})






</script>
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
<?php  
	 $nivel= $this->session->userdata('nivel'); 
	 ?>
	<div class="container">
		</br>
		<div style="float: left;"  Width="800px">
			<h2>Catastro municipal de niños y niñas Navidad</h2>
			<h4>Ingrese cada niño utilizando el botón correspondiente, puede editar, listar y borrar registros</h4>
			<span id="minutos" hidden="" ><script> document.write(mins); </script></span> 
		</div>
		<div style="float: right;" Width="800px">				

		<img src="<?php echo base_url('logo_firma.png'); ?>" Width="100px" />
		</div>
	</div>
	<?php
		if($this->session->flashdata('error_msg')){
	?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('error_msg'); ?>
		</div>
	<?php		
		}
	?>
	<?php
		if($this->session->flashdata('add_msg')){
		?>
			<div class="alert alert-danger">
				<?php echo $this->session->flashdata('add_msg'); ?>
			</div>
		<?php		
			}
		?>	
			<?php
		if($this->session->flashdata('success_msg')){
		?>
			<div class="alert alert-info">
				<?php echo $this->session->flashdata('success_msg'); ?>
			</div>
		<?php		
			}
		?>	
		
	<div >
		<div style="float: left;">
		&nbsp;&nbsp;&nbsp;&nbsp;
		<button class="btn btn-success" data-toggle="modal" data-target="#agregar" <?php if($nivel==1){echo 'style="display:none;"';}?>>Agregar</button>&nbsp;&nbsp;
			<!--<a href="<?php echo base_url('blog/add'); ?>" class="btn btn-success"  >Ingresar Nuevo</a>&nbsp;&nbsp;-->
		</div>	
		<div class="input-group" style="text-align: center;"> 
			<span class="input-group-addon " >Buscar Niños</span>
			 <input id="entradafilter" type="text" class="form-control" style="width: 300px">
			<div style="float: left;">
			&nbsp;&nbsp;
			<a href="<?php echo base_url('index.php/blog/report'); ?>" class="btn btn-info" <?php if($nivel==1||$nivel==2){echo 'style="display:none;"';}?>  >Reporte</a>
				&nbsp;&nbsp;
			<a href="<?php echo base_url('index.php/blog/user_logout');?>" class="btn btn-primary"  >Cerrar Sesión</a>	
			</div>
		</div>
	</div>
<!--Agregar-->	
		<?php
			if($this->session->flashdata('divAgregar')){
		?>	
					<script type="text/javascript"> 
						
						$(document).ready(function() { 
						   $("#agregar").modal("show");
						}); 
					</script>				
		<?php		
				}
		?>
<div class="modal fade"  id="agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Añadir Niños</h4>
			
			<?php
		if($this->session->flashdata('add_msg')){
		?>
			<div class="alert alert-danger">
				<?php echo $this->session->flashdata('add_msg'); ?>
			</div>
		<?php		
			}
		?>

		<?php
			if($this->session->flashdata('success_msg')){
		?>
			<div class="alert alert-info">
				<?php echo $this->session->flashdata('success_msg'); ?>
			</div>
		<?php		
			}
		?>


		<?php
			if($this->session->flashdata('error_msg')){
		?>
			<div class="alert alert-danger">
				<?php echo $this->session->flashdata('error_msg'); ?>
			</div>
		<?php		
			}
		?>

		</div>
			<form action="<?php echo base_url('index.php/blog/submit') ?>" method="post" >
			<div class="modal-body">
				<div class="form-group">
					<label>Organizacion</label>&nbsp;

					<select name="txtorga" id="orga" onchange="discapacitados()" class="btn btn-default dropdown-toggle"   > 
					
					
					<?php 		foreach($orga as $fila)
								{						
								   if ($datito){
								    	 foreach($datito as $dat){	
						?>
								      		  <option value="<?php echo $fila->id;?>" <?php if($dat->id_organizacion== $fila->id){echo "selected";} ?>> <?php echo $fila->organizacion; ?></option>
						<?php
								   		}
								 	}
								 	if ($datito==false) { ?>
								 		<option value="<?php echo $fila->id;?>"  > <?php echo $fila->organizacion; ?></option>
						<?php		 	}
								} 	
						?>	
					</select>
							
				</div>	
				<script type="text/javascript">

					function discapacitados(){
						if (document.getElementById('orga').value == "4" || document.getElementById('orga').value == "48" ) {
							document.getElementById("Fecha").setAttribute("min", "1950-01-01");
						} else {
							document.getElementById("Fecha").setAttribute("min", "2000-01-01");
						}
					}
				</script>

				<div class="form-group" style="text-align: left;">								
						<div class="col-md-5">
							<label>Rut</label>&nbsp;
							<input type="text" name="txtrut" class="form-control" style="width: 200px"  required pattern="^([0-9]+-[0-9kK])$" Title="El formato del rut debe ser 12345678-9">
						</div>	
				</div>			 
				<div class="form-group">								
						<label >Nombres</label>
						<input name="txtnombres"  class="form-control" style="width: 200px" required pattern="[a-zA-ZñÑ\s\W]+"
         title=" El nombre debe ser solo letras"></input>			
				</div>		
				<div class="form-group" style="text-align: left;">
					<div class="col-md-5">
						<label for="description" >Apellido P</label>			
						<input name="txtAp" class="form-control" style="width: 200px" required pattern="[a-zA-ZñÑ\s\W]+"
         title=" El Apellido Paterno debe ser solo letras" ></input>
					</div>
				</div>
				<div class="form-group">
						<label for="description" >Apellido M</label>			
						<input name="txtAm" class="form-control" style="width: 200px"  required pattern="[a-zA-ZñÑ\s\W]+"
         title=" El Apellido Materno debe ser solo letras"></input>		
				</div>
				<div class="form-group" style="text-align: left;">
					<div class="col-md-5">
						<label for="precio">Fecha de naciminiento</label>			
						<input name="txtFecha"  id="Fecha" type="date" class="form-control"  min= "2000-01-01" max="2100-01-01" placeholder="dd/mm/yyyy" style="width: 200px" required  oninvalid="setCustomValidity('La fecha de nacimiento no corresponde a menor de edad')" oninput="setCustomValidity('')"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" title="El formato de la fecha debe ser dd/mm/aaaa"></input>	
					</div>	
				</div>	
				<div class="form-group">
					<label for="precio" >Sexo</label></br>			
					<input type="radio" name="txtsexo" id="male" value="Masculino" required=""> Masculino<br>
		  			<input type="radio" name="txtsexo" value="Femenino" required="" > Femenino<br>				
				</div>	
				<div class="form-group" style="text-align: left;">
					<div class="col-md-5">
						<label for="precio" >Direccion</label>			
						<input name="txtdire"  class="form-control" style="width: 200px" required></input>
					</div>	
				</div>	
			</div></br></br></br>

				<div class="modal-footer">		
						 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<!--<a href="<?php echo base_url('blog/index'); ?>" class="btn btn-danger">Cancelar</a>&nbsp;&nbsp;-->
						<input type="submit" name="btnSave" class="btn btn-info" value="Guardar" style="width: 90px">
				</div> 
			</form>
		</div>
	</div>
</div>
</br>





<!--Modificar-->

	<?php
			if($this->session->flashdata('modificar')){
	?>	
				<script type="text/javascript"> 
					
					$(document).ready(function() { 
					   $("#modificar").modal("show");
					}); 
				</script>				
	<?php		
			}
	?>

<?php 
if($blog!=null){					
?>	
			
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modificar Niños</h4>
			</div>
			<?php
		if($this->session->flashdata('add_msg')){
		?>
			<div class="alert alert-danger">
				<?php echo $this->session->flashdata('add_msg'); ?>
			</div>
		<?php		
			}
		?>

		<?php
			if($this->session->flashdata('success_msg')){
		?>
			<div class="alert alert-info">
				<?php echo $this->session->flashdata('success_msg'); ?>
			</div>
		<?php		
			}
		?>


		<?php
			if($this->session->flashdata('error_msg')){
		?>
			<div class="alert alert-danger">
				<?php echo $this->session->flashdata('error_msg'); ?>
			</div>
		<?php		
			}
		?>

			<form action="<?php echo base_url('index.php/blog/update') ?>" method="post" >
			<div class="modal-body">
				<div class="form-group">
					<label>Organizacion</label>&nbsp;
					<select name="txtorga" id="orgaU" class="btn btn-default dropdown-toggle" onchange="disca()" >					
						<?php 
						$dat= $blog->id_organizacion;
						foreach($orga as $fila)
						{
						?>   
							<option value="<?php echo $fila->id;?>" <?php if($dat== $fila->id){echo "selected";} ?>> <?php echo $fila->organizacion; ?></option>
						<?php
						}
						?>		
					</select>
						<script type="text/javascript">

					function disca(){
						if (document.getElementById('orgaU').value == "4" || document.getElementById('orga').value == "48") {
							document.getElementById("FechaU").setAttribute("min", "1950-01-01");
						} else {
							document.getElementById("FechaU").setAttribute("min", "2000-01-01");
						}
					}
				</script>

					
				</div>	
				<!-------------------------------------------------->
				<div class="form-group" style="text-align: left;">	
							<div class="col-md-5" hidden="">
							<label>Rut</label>&nbsp;
							<input type="text" name="txtid" value="<?php echo $blog->id; ?>"  class="form-control" style="width: 200px">
						</div>					
						<div class="col-md-5">
							<label>Rut</label>&nbsp;
							<input type="text" name="txtrut" value="<?php echo $blog->rut; ?>"  class="form-control" style="width: 200px"   required pattern="^([0-9]+-[0-9kK])$" Title="El formato del rut debe ser 12345678-9">
						</div>	
				</div>			 
				<div class="form-group">								
						<label >Nombres</label>
						<input name="txtnombres" value="<?php echo $blog->nombres;?>"  class="form-control" style="width: 200px"  required pattern="[a-zA-ZñÑ\s\W]+" title=" El nombre debe ser solo letras" ></input>			
				</div>		
				<div class="form-group" style="text-align: left;">
					<div class="col-md-5">
						<label for="description" >Apellido P</label>			
						<input name="txtAp" value="<?php echo $blog->apellido_paterno; ?>" class="form-control" style="width: 200px" required pattern="[a-zA-ZñÑ\s\W]+" title=" El Apellido Paterno debe ser solo letras"  ></input>
					</div>
				</div>
				<div class="form-group">
						<label for="description" >Apellido M</label>			
						<input name="txtAm" value="<?php echo $blog->apellido_materno; ?>" class="form-control" style="width: 200px"   required pattern="[a-zA-ZñÑ\s\W]+"
         title=" El Apellido Materno debe ser solo letras"></input>		
				</div>
				<div class="form-group" style="text-align: left;">
					<div class="col-md-5" onclick="disca()">
						<label for="precio">Fecha de naciminiento</label>			
						<input name="txtFecha" id="FechaU" type="date" value="<?php echo $blog->fecha; ?>" class="form-control" placeholder="<?php echo $blog->fecha_nacimiento; ?>" style="width: 200px"  min="2000-01-01" max="2100-01-01" oninvalid="setCustomValidity('La fecha de nacimiento no corresponde a menor de edad')"  required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" title="El formato de la fecha debe ser dd/mm/aaaa"  ></input>	
					</div>	
				</div>	
				<div class="form-group">
					<label for="precio" >Sexo</label></br>			
					<?php 
					$sex = $blog->sexo;

					 ?> 					
					<input type="radio" name="txtsexo" value="Masculino"<?php if($sex=="Masculino"){echo "checked";}?>> Masculino<br>
					<input type="radio" name="txtsexo" value="Femenino" <?php if($sex=="Femenino"){echo "checked";}?>> Femenino<br>					
				</div>	
				<div class="form-group" style="text-align: left;">
					<div class="col-md-5">
						<label for="precio" >Direccion</label>			
						<input name="txtdire" value="<?php echo $blog->direccion;?>"  class="form-control" style="width: 200px" required></input>
					</div>	
				</div>	
			</div></br></br></br>
				<!-------------------------------------------------->
				
				<div class="modal-footer">		
						<a href="<?php echo base_url('index.php/blog/inde'); ?>" class="btn btn-danger">Cancelar</a>&nbsp;&nbsp;					
						<input type="submit" name="btnSave" class="btn btn-info" value="Guardar" style="width: 90px">
				</div> 
			</form>
		</div>
	</div>
</div>
</br>





		<?php
				
			}
		?>








<!--tabla-->

 <div style="float: left;" class="container" >
 <center>
	 <table class="table table-bordered table-responsive table-hover btn-default ng-table-responsive" AllowPaging="True" >
	 <thead>
	 	<tr style="font-weight: bold; text-align: center; vertical-align: super;">
	 		<td>Edad</td>
	 		<td>Rut</td>
			<th>Nombres</th>			
			<th>Apellidos</th>
			<th>Fecha Nacimiento</th>
			<th>Sexo</th>
			<th>Direccion</th>
			<th>Oganizacion</th>
			<th <?php if($nivel==1){echo 'hidden=""';}?>>Editar</th>
			<th <?php if($nivel==1||$nivel==2){echo 'hidden=""';}?>>Eliminar</th>
	 	</tr>
	</thead>
	

	
<tbody class="contenidobusqueda">
	 	<?php 

			if($blogs){
				foreach($blogs as $blogg){
					$rut = $blogg->rut;
					$id= $blogg->id;
		?>	
			<tr>
				<td><?php echo $blogg->edad; ?></td>
				<td><?php echo $blogg->rut; ?></td>
				<td><?php echo $blogg->nombres; ?></td>
				<td><?php echo $blogg->apellido_paterno.' '.$blogg->apellido_materno; ?></td>
				<td><?php echo $blogg->fecha_nacimiento; ?></td>
				<td><?php echo $blogg->sexo; ?></td>
				<td><?php echo $blogg->direccion; ?></td>
				<td><?php echo $blogg->organizacion; ?></td>
				

				<td <?php if($nivel==1){echo 'hidden=""';}?> >
					
					<a href="<?php echo base_url('index.php/blog/edite/'.$id); ?>" onclick="discapacitados();" class="btn btn-warning" <?php if($nivel==1){echo 'hidden=""';}?>>Actualizar</a>
					
				</td>
				<td <?php if($nivel==1||$nivel==2){echo 'hidden=""';}?>>
					<a href="<?php echo base_url('index.php/blog/delete/'.$blogg->rut); ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar Registro? ');">Eliminar</a>
				</td>
			</tr>
		<?php
				}
			}
		?>
</tbody>
	 	 
	 </table>
	

</div>
