<?php defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }

     //get the username & password 
     function get_user($usr, $pwd)
     {
          $sql = "select * from sistemas_users where username = '" . $usr . "' and password = '" . $pwd . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
          
     }
     function get_di($usr, $pwd)
     {
          $sql = "select id from sistemas_users where username = '" . $usr . "' and password = '" . $pwd . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          }
          
     }

     function get_nivel($usr, $id){
          $sql = "select nivel_acceso from sistemas_sistemasxusuario where id_sistema = '" . $id . "'and id_usuario= '" . $usr . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          }

     }

}