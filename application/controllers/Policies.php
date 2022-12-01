<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies extends CI_Controller {

    public function __construct(){
		parent:: __construct(); 
	}

  public function cpanelPolicies() { 
      
    if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminPolicies');
          $this->load->view('shared/footer');
    }else{
           $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }


     public function getPolicies(){
     
         $this->load->model('PoliciesModel');

          if($res=$this->PoliciesModel->get_policies()){
              $this->response->sendJSONResponse($res); 
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
      
    }



    public function createPolicies()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('PoliciesModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])||empty($data['description'])) {
          $err = "Complete todos los campos.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
 
          if ($this->PoliciesModel->create_policies($data)) {

              $this->response->sendJSONResponse(array('msg' =>'Se ha creado la política con éxito'), 200);
          } else {
            $this->response->sendJSONResponse(array('status' => $s['status']), 500);
          }
        }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }
  
  
    
  

    
 public function updatePolicies(){

      if ($this->accesscontrol->checkAuth()['correct']) {
           $data = $this->input->post("data");
          $this->load->model('PoliciesModel');
          $valid = true;
          $err="";
           
        if (empty($data['name'])||empty($data['description'])) {
            $err = "Complete todos los campos.";
            $valid = false;
          }


        if($valid){
          if($res=$this->PoliciesModel->update_policies($data)){
            $this->response->sendJSONResponse(array('msg' => 'La política se ha editado con éxito.'),200); 
          }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
        }else{
            $this->response->sendJSONResponse(array('msg' => $err), 400);
        }
    
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
  }
  


    public function deletePolicies($id_policies){

      if ($this->accesscontrol->checkAuth()['correct']) {
        
          $this->load->model('PoliciesModel');
        
          if($res=$this->PoliciesModel->delete_policies($id_policies)){
            $this->response->sendJSONResponse(array('msg' => 'La política se ha eliminado con éxito.'),200); 
          }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
    
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
  }

	

}
