<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_m extends CI_Model{
   
	//Mantenedores

	public function submit(){	
		$fecha_original= $this->input->post('txtFecha');
		$FechaMySQL = implode( '-', array_reverse( explode( '/', $fecha_original ) ) ) ;
			$field = array(
			'rut'=>$this->input->post('txtrut'),
			'nombres'=>$this->input->post('txtnombres'),			
			'apellido_paterno'=>$this->input->post('txtAp'),
			'apellido_materno'=>$this->input->post('txtAm'),
			'fecha_nacimiento'=>$fecha_original,
			'sexo'=>$this->input->post('txtsexo'),
			'direccion'=>$this->input->post('txtdire'),
			'id_organizacion'=>$this->input->post('txtorga')
			);
		$this->db->insert('ninos', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	public function update(){
		$fecha_original= $this->input->post('txtFecha');
		$FechaMySQL = implode( '-', array_reverse( explode( '/', $fecha_original ) ) ) ;
		$id = $this->input->post('txtid');
		$rut = $this->input->post('txtrut');
		$field = array(
			'rut'=>$this->input->post('txtrut'),
			'nombres'=>$this->input->post('txtnombres'),			
			'apellido_paterno'=>$this->input->post('txtAp'),
			'apellido_materno'=>$this->input->post('txtAm'),
			'fecha_nacimiento'=>$FechaMySQL,
			'sexo'=>$this->input->post('txtsexo'),
			'direccion'=>$this->input->post('txtdire'),
			'id_organizacion'=>$this->input->post('txtorga')
			);
		//$this->db->where('rut', $rut);
		$this->db->where('id', $id);
		$this->db->update('ninos', $field);
		//$this->db->last_query();extit;
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


	public function delete($rut){

		$this->db->where('rut', $rut);
		$this->db->delete('ninos');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
		// ----------- Gets

	public function getBlog(){	
		$this->db->select('TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) AS edad');
		$this->db->select("DATE_FORMAT( a.fecha_nacimiento, '%d/%m/%Y' ) as fecha_nacimiento",  FALSE );
		$this->db->select('a.id as id, 
			a.rut as rut, 
			a.nombres as nombres , 
			a.apellido_paterno as apellido_paterno, 
			a.apellido_materno as apellido_materno, 
			a.sexo as sexo, a.direccion as direccion,
			a.id_organizacion as id_organizacion, 
			b.organizacion as organizacion' );
		$this->db->join('organizacion b', 'a.id_organizacion= b.id', 'left');
		$this->db->order_by('id','desc');
		$query = $this->db->get('ninos a');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function getBlogById(){	
		$rut = $this->input->post('txtrut');
		$this->db->where('rut', $rut);
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function getBlogId($id){
		$this->db->select("DATE_FORMAT( fecha_nacimiento, '%d/%m/%Y' ) as fecha_nacimiento",  FALSE );
		$this->db->select('fecha_nacimiento as fecha,id, rut, nombres , apellido_paterno, apellido_materno, sexo, direccion, id_organizacion');
		$this->db->where('id', $id);
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	public function organizaciones()
	{
		$this->db->select('id , organizacion');
		$this->db->order_by('organizacion','asc');
		$query = $this->db->get('organizacion');
		if($query->num_rows()>0)
		{
			return $query->result();
		}else{
			return false;
		}
	}
	public function organi(){	
		//$myDateTime->format('y-m-d');	
		//$fecha= DATE_FORMAT('fecha_original', '%y-%m-%d');  
		$this->db->select('id_organizacion');
		$this->db->order_by('id','DESC' );
		$this->db->limit('1');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function orga()	{
					
	$organizacion= $this->input->post('txtorga');
			
		
		if($organizacion!=null)
		{
			return $organizacion;
		}else{
			return false;
		}
	}
	public function getOrga(){
		$this->db->order_by('organizacion');
		$query = $this->db->get('organizacion');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}



	public function get()
	{
		$fields = $this->db->field_data('ninos');
		$query = $this->db->select('*')->get('ninos');
		return array("fields" => $fields, "query" => $query);
	}

	
	public function getNinos(){
		$this->db->select('TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) AS edad');
		$this->db->select('
			a.id as id,
			a.rut as Rut, 
			a.nombres as Nombres , 
			a.apellido_paterno as Apellido Paterno, 
			a.apellido_materno as Apellido Materno, 
			a.sexo as Sexo, 
			a.direccion as Dirección,
			b.organizacion as Organización' );
		$this->db->join('organizacion b', 'a.id_organizacion= b.id', 'left');
		$this->db->order_by('id','desc');
		$query = $this->db->get('ninos a');			
		return $query;
	}
	///---------------------------------------------------------------------------------------------------------Paginacion

 
	  function get_total_ninos(){
	    return $this->db->count_all('ninos');
	  }


	///---------------------------------------------------------------------------------------------------------REPORTES
	//-----------------------------------------------------------------------------------Hombres de 0 año
	  public function getedad(){
	  	$this->db->select('TIMESTAMPDIFF(YEAR,`fecha_nacimiento`,CURDATE()) AS edad');
	  	$query = $this->db->get('ninos');			
		return $query;
	  
	  }
	public function getHombres0()
	{
		
		$this->db->select(' COUNT(rut) as Hombres0');		
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','0');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 0 año
	public function getMujeres0()
	{
		$this->db->select('COUNT(rut) as Mujeres0');	
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','0');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 1 año
	public function getHombres1()
	{
		
		$this->db->select(' COUNT(rut) as Hombres1');		
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','1');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 1 año
	public function getMujeres1()
	{
		$this->db->select('COUNT(rut) as Mujeres1');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','1');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 2 año
	public function getHombres2()
	{
		
		$this->db->select(' COUNT(rut) as Hombres2');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','2');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 2 año
	public function getMujeres2()
	{
		$this->db->select('COUNT(rut) as Mujeres2');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','2');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	//-----------------------------------------------------------------------------------Hombres de 3 año
	public function getHombres3()
	{
		
		$this->db->select(' COUNT(rut) as Hombres3');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','3');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 3 año
	public function getMujeres3()
	{
		$this->db->select('COUNT(rut) as Mujeres3');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','3');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	//-----------------------------------------------------------------------------------Hombres de 4 año
	public function getHombres4()
	{
		
		$this->db->select(' COUNT(rut) as Hombres4');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','4');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 4 año
	public function getMujeres4()
	{
		$this->db->select('COUNT(rut) as Mujeres4');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','4');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	//-----------------------------------------------------------------------------------Hombres de 5 año
	public function getHombres5()
	{
		
		$this->db->select(' COUNT(rut) as Hombres5');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','5');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 5 año
	public function getMujeres5()
	{
		$this->db->select('COUNT(rut) as Mujeres5');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','5');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	//-----------------------------------------------------------------------------------Hombres de 6 año
	public function getHombres6()
	{
		
		$this->db->select(' COUNT(rut) as Hombres6');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','6');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 6 años
	public function getMujeres6()
	{
		$this->db->select('COUNT(rut) as Mujeres6');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','6');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	//-----------------------------------------------------------------------------------Hombres de 7 añoss
	public function getHombres7()
	{
		
		$this->db->select(' COUNT(rut) as Hombres7');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','7');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 7 años
	public function getMujeres7()
	{
		$this->db->select('COUNT(rut) as Mujeres7');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','7');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 8 años
	public function getHombres8()
	{
		
		$this->db->select(' COUNT(rut) as Hombres8');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','8');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 8 año
	public function getMujeres8()
	{
		$this->db->select('COUNT(rut) as Mujeres8');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','8');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 9 año
	public function getHombres9()
	{
		
		$this->db->select(' COUNT(rut) as Hombres9');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','9');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 9 año
	public function getMujeres9()
	{
		$this->db->select('COUNT(rut) as Mujeres9');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','9');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 10 año
	public function getHombres10()
	{
		
		$this->db->select(' COUNT(rut) as Hombres10');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','10');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 10 año
	public function getMujeres10()
	{
		$this->db->select('COUNT(rut) as Mujeres10');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','10');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//H-----------------------------------------------------------------------------------ombres de 11 año
	public function getHombres11()
	{
		
		$this->db->select(' COUNT(rut) as Hombres11');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','11');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 11 año
	public function getMujeres11()
	{
		$this->db->select('COUNT(rut) as Mujeres11');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','11');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 12 año
	public function getHombres12()
	{
		
		$this->db->select(' COUNT(rut) as Hombres12');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','12');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 12 año
	public function getMujeres12()
	{
		$this->db->select('COUNT(rut) as Mujeres12');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','12');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 13 año
	public function getHombres13()
	{
		
		$this->db->select(' COUNT(rut) as Hombres13');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','13');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 13 año
	public function getMujeres13()
	{
		$this->db->select('COUNT(rut) as Mujeres13');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','13');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 14 año
	public function getHombres14()
	{
		
		$this->db->select(' COUNT(rut) as Hombres14');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','14');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 14 año
	public function getMujeres14()
	{
		$this->db->select('COUNT(rut) as Mujeres14');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','14');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Hombres de 15 año
	public function getHombres15()
	{
		
		$this->db->select(' COUNT(rut) as Hombres15');
		$this->db->where('sexo', 'Masculino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','15');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	//-----------------------------------------------------------------------------------Mujeres de 15 año
	public function getMujeres15()
	{
		$this->db->select('COUNT(rut) as Mujeres15');
		$this->db->where('sexo', 'Femenino');
		$this->db->where('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) =','15');
		$query = $this->db->get('ninos');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
}

