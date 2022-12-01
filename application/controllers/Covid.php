<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Covid extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
	}
	
	//Funcion para cargar la vista del login
    public function adminCovid(){
  
        if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminCovid');
          $this->load->view('shared/footer');
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    
    }


	//Funcion para redirigir a los usuarios logeados segun privilegios
	
	
}
