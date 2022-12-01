<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


	public function cpanelClient(){
         
        if ($this->accesscontrol->checkAuth()['correct']) {
          
			$this->load->view('shared/headerSuperAdmin');
			$this->load->view('admin/adminClient');
			$this->load->view('shared/footer');
		  }else{
			$this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
		  }
	  
	}


	



	
}
