
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->library('form_validation');
		$this->load->library('Export_excel');
		$this->load->model('blog_m', 'm');	
		$this->load->model('login_model');
		$this->load->database();
         
		//load the session library
		$this->load->driver('session');
		
		$id= $this->session->mark_as_flash('item');
		$nivel= $this->session->userdata('nivel'); 

	}


	
public function index()
     {
          //get the posted values
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");

          //set validations
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $this->load->view('layout/header');
               $this->load->view('blog/login_view');
          }
          else
          {
             
               if ($this->input->post('btn_login') == "Iniciar Sesion")
               {
                    
                    $usr_result = $this->login_model->get_user($username, $password);
                    $resu_id = $this->login_model->get_di($username, $password); 

                    $id = $resu_id['id'];
                    $sistema= 'CatastroNavidad';
                    $permiso= $this->login_model->get_nivel($id,$sistema);

                    
	                 
	                 if ($usr_result) 
		              {
		              	if ($permiso) 
	                 	 {		                 
		                   $sessiondata = array(
		                        'username' => $username,
		                        'loginuser' => TRUE,
		                        'id_usuario'=> $id
		                   );
		                   $this->session->set_userdata('nivel',$permiso['nivel_acceso']);
		                   $this->session->set_userdata('username',$sessiondata['username']);
		                   $this->session->set_userdata('id_usuario',$sessiondata['id_usuario']);	

		                   redirect(base_url('index.php/blog/inde'),'refresh');

		                    }else{
			                  $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usted no tiene permisos para ingresar a este tramite!</div>');
			                  
			                   redirect(base_url('index.php/blog/index'),'refresh');
	                 	  }
	                 
		              }else{
		                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Nombre de usuario o contraseña invalidos!</div>');
		                   redirect(base_url('index.php/blog/index'),'refresh');		                   
		              }
                   
               }
               else

               {  echo "<script>alert('Falló el ingreso');</script>";
                   redirect(base_url('index.php/blog/index'),'refresh');
               }
          }
     }    

      public function user_logout(){

      $this->session->sess_destroy();
      redirect(base_url('index.php/blog/index'),'refresh');
     }

	function inde(){
		$variable = $this->session->userdata('username');
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Algo ocurrio!</div>');
			redirect(base_url('index.php/blog/index'),'refresh');
		}else{


		$data['orga'] = $this->m->organizaciones();			
		$data['blog'] = null;
		$data['datito']= $this->m->organi();
		
//---------------------------------------------------------------
		
	 	
	    /* Se inicializa la paginacion*/
	  
	    /* Se obtienen los registros a mostrar*/
	    $data['blogs'] = $this->m->getBlog();  
	    //$data['blogs']  =$this->m->getedad();
	    /*Se llama a la vista para mostrar la información*/
	    
	    $this->load->view('layout/header');			
		$this->load->view('blog/index', $data);
		}
	}

	public function agregarPermisos(){
     $permi=	$this->m->agregarPermisos();
	     if ($permi) {
	     	  $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Permiso agregado</div>');
			redirect(base_url('index.php/blog/index'),'refresh');
	     }else{
	       $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Permiso no agregado</div>');
				                  
			redirect(base_url('index.php/blog/index'),'refresh');	
	     }
     }	
     public function agregarUsuarios(){
     $usu=	$this->m->agregarUsuarios();
	     if ($usu) {
	     	  $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usuario agregado</div>');
			redirect(base_url('index.php/blog/index'),'refresh');
	     }else{
	       $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usuario no agregado</div>');
				                  
			redirect(base_url('index.php/blog/index'),'refresh');	
	     }
     }	

	public function edite($rut){
		$variable = $this->session->userdata('username');
		if (is_null($variable)) {
			 redirect(base_url('index.php/blog/index'),'refresh');
		}else{


		$data['orga'] = $this->m->organizaciones();		
		//$data['blogs'] = $this->m->getBlog();
		$data['blog'] = $this->m->getBlogId($rut);

		$data['datito']= $this->m->organi();	
		
	    /* Se obtienen los registros a mostrar*/
	    $table['blogs'] = $this->m->getBlog();  
	      

		$this->session->set_flashdata('modificar', 'Modificar agregado');
		$this->load->view('layout/header',$table);			
		$this->load->view('blog/index', $data);
		
		}
	}
	//Lammar mantenedores
	public function submit(){
		
		$resu =$this->m->getBlogById();	
			if($resu){
				$this->session->set_flashdata('add_msg', 'Registro ya existe');
				$this->session->set_flashdata('divAgregar', ' ');
				redirect(base_url('index.php/blog/inde'));
				
			}else{
				$result = $this->m->submit();
					if($result){ 
						$this->session->set_flashdata('success_msg', 'Registro agregado');
					}else{
						$this->session->set_flashdata('error_msg', 'Registro No agregado');
					}
						$this->session->set_flashdata('divAgregar', ' ');
						redirect(base_url('index.php/blog/inde'), 'refresh');

			}			
	}

	public function update(){
		$result = $this->m->update();
		if($result){
			$this->session->set_flashdata('success_msg', 'Modificado Correctamente');
		}else{
			$this->session->set_flashdata('error_msg', 'Fallo la modificacion');
		}
		redirect(base_url('index.php/blog/inde'));
	}

	public function delete($codigo){
		$nivel= $this->session->userdata('nivel'); 
		$variable = $this->session->userdata('username');
		if (is_null($variable)||$nivel==1||$nivel==2) {			
			redirect(base_url('index.php/blog/index'),'refresh');
		}else{
			$result = $this->m->delete($codigo);
			if($result){
				$this->session->set_flashdata('success_msg', 'Registro Eliminado');
			}else{
				$this->session->set_flashdata('error_msg', 'Registro No Eliminado');
			}
			redirect(base_url('index.php/blog/inde'));
		}
	}
	//Lamar libreria de excel 
	public function dExcel(){
		$result = $this->m->getNinos();
		$this->export_excel->to_excel($result, 'lista_de_niños');
	}
	//Exportar tabla de datos por edad a excel
	public function Excel(){
		$nivel= $this->session->userdata('nivel'); 
		$variable = $this->session->userdata('username');
		if (is_null($variable)||$nivel==1||$nivel==2) {			
			redirect(base_url('index.php/blog/index'),'refresh');
		}else{
		$counts['hom0'] = $this->m->getHombres0();	
		$counts['muj0'] = $this->m->getMujeres0();

		$counts['hom1'] = $this->m->getHombres1();	
		$counts['muj1'] = $this->m->getMujeres1();

		$counts['hom2'] = $this->m->getHombres2();	
		$counts['muj2'] = $this->m->getMujeres2();

		$counts['hom3'] = $this->m->getHombres3();	
		$counts['muj3'] = $this->m->getMujeres3();

		$counts['hom4'] = $this->m->getHombres4();	
		$counts['muj4'] = $this->m->getMujeres4();

		$counts['hom5'] = $this->m->getHombres5();	
		$counts['muj5'] = $this->m->getMujeres5();	


		$counts['hom6'] = $this->m->getHombres6();	
		$counts['muj6'] = $this->m->getMujeres6();


		$counts['hom7'] = $this->m->getHombres7();	
		$counts['muj7'] = $this->m->getMujeres7();


		$counts['hom8'] = $this->m->getHombres8();	
		$counts['muj8'] = $this->m->getMujeres8();


		$counts['hom9'] = $this->m->getHombres9();	
		$counts['muj9'] = $this->m->getMujeres9();


		$counts['hom10'] = $this->m->getHombres10();	
		$counts['muj10'] = $this->m->getMujeres10();


		$counts['hom11'] = $this->m->getHombres11();	
		$counts['muj11'] = $this->m->getMujeres11();


		$counts['hom12'] = $this->m->getHombres12();	
		$counts['muj12'] = $this->m->getMujeres12();


		$counts['hom13'] = $this->m->getHombres13();	
		$counts['muj13'] = $this->m->getMujeres13();


		$counts['hom14'] = $this->m->getHombres14();	
		$counts['muj14'] = $this->m->getMujeres14();


		$counts['hom15'] = $this->m->getHombres15();	
		$counts['muj15'] = $this->m->getMujeres15();	
		$counts['orga'] = $this->m->organizaciones();		
		
		$this->load->view('blog/excel',$counts);
		}
	}
	//-------------------Reportes-----------------------------------------------------------------------------
	public function report(){
		$nivel= $this->session->userdata('nivel'); 
		$variable = $this->session->userdata('username');
		if (is_null($variable)) {
			 redirect(base_url('index.php/blog/index'),'refresh');
		}else{


		//-------------------------------------------------- Por Edad
		$counts['hom0'] = $this->m->getHombres0();	
		$counts['muj0'] = $this->m->getMujeres0();

		$counts['hom1'] = $this->m->getHombres1();	
		$counts['muj1'] = $this->m->getMujeres1();

		$counts['hom2'] = $this->m->getHombres2();	
		$counts['muj2'] = $this->m->getMujeres2();

		$counts['hom3'] = $this->m->getHombres3();	
		$counts['muj3'] = $this->m->getMujeres3();

		$counts['hom4'] = $this->m->getHombres4();	
		$counts['muj4'] = $this->m->getMujeres4();

		$counts['hom5'] = $this->m->getHombres5();	
		$counts['muj5'] = $this->m->getMujeres5();	


		$counts['hom6'] = $this->m->getHombres6();	
		$counts['muj6'] = $this->m->getMujeres6();


		$counts['hom7'] = $this->m->getHombres7();	
		$counts['muj7'] = $this->m->getMujeres7();


		$counts['hom8'] = $this->m->getHombres8();	
		$counts['muj8'] = $this->m->getMujeres8();


		$counts['hom9'] = $this->m->getHombres9();	
		$counts['muj9'] = $this->m->getMujeres9();


		$counts['hom10'] = $this->m->getHombres10();	
		$counts['muj10'] = $this->m->getMujeres10();


		$counts['hom11'] = $this->m->getHombres11();	
		$counts['muj11'] = $this->m->getMujeres11();


		$counts['hom12'] = $this->m->getHombres12();	
		$counts['muj12'] = $this->m->getMujeres12();


		$counts['hom13'] = $this->m->getHombres13();	
		$counts['muj13'] = $this->m->getMujeres13();


		$counts['hom14'] = $this->m->getHombres14();	
		$counts['muj14'] = $this->m->getMujeres14();


		$counts['hom15'] = $this->m->getHombres15();	
		$counts['muj15'] = $this->m->getMujeres15();	
		$counts['orga'] = $this->m->organizaciones();		
		$this->load->view('layout/header',$counts);	
		$this->load->view('blog/report');
		}
	}	
	
}