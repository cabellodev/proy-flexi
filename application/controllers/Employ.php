<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employ extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


    public function cpanelEmploy() { 
      
        if ($this->accesscontrol->checkAuth()['correct']) {
              
              $this->load->view('shared/headerSuperAdmin');
              $this->load->view('admin/adminEmploy');
              $this->load->view('shared/footer');
        }else{
               $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }


   

    // functions web site item Home and services
    public function getNotifications(){

      if ($this->accesscontrol->checkAuth()['correct']) {

           $this->load->model('EmployModel');

          if($res=$this->EmployModel->get_notifications()){
            
                $this->response->sendJSONResponse($res); 
             }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
             }
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
        
    }

    public function getPublications(){

      if ($this->accesscontrol->checkAuth()['correct']) {

           $this->load->model('EmployModel');

          if($res=$this->EmployModel->get_publications()){
            
                $this->response->sendJSONResponse($res); 
             }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
             }
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
        
    }


    public function getCharges(){
     
          if ($this->accesscontrol->checkAuth()['correct']) {

            $this->load->model('EmployModel');

          if($res=$this->EmployModel->get_charges()){
            
                $this->response->sendJSONResponse($res); 
              }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
              }
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
      
  }

 

public function createCharge(){ 


    if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('EmployModel');
        $ok = true;
        
        if(empty($data['name'])){ $ok=false; }
       
        if($ok){

            if($res=$this->EmployModel->create_charge($data)){
      
                $this->response->sendJSONResponse(array("msg"=>"El cargo se ha registrado con existo"),200); 
             }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
             }

        }else{
            $this->response->sendJSONResponse(array('msg' => 'Complete todos los campos.'), 400); 
        }

      
    }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }
  





    public function deleteNotification($id_notification){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->EmployModel->model('EmployModel');
          
            if($res=$this->EmployModel->delete_notifications($id_notification)){
              $this->response->sendJSONResponse(array('msg' => 'La notificación se ha eliminado con éxito.')); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    }
    


    


    


    public function updatePublication($id_publication){

     
      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");
          $this->load->model('EmployModel');
          
              if($res=$this->EmployModel->update_publication($data,$id_publication)){
        
                  $this->response->sendJSONResponse(array("msg"=>"La publicacion se ha actualizado con exito."),200); 
               }else{
                      $this->response->sendJSONResponse(array('msg' => 'No se ha podido publicar.'), 400); 
               }
  
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400); 
          }
  
      
    }



    public function deleteCharge(){

     
      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");
          $this->load->model('EmployModel');
          
              if($res=$this->EmployModel->delete_charge($data)){
        
                  $this->response->sendJSONResponse(array("msg"=>"El cargo se ha elminado con exito"),200); 
               }else{
                      $this->response->sendJSONResponse(array('msg' => 'No se ha podido publicar.'), 400); 
               }
  
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400); 
          }
    }

    public function stateCharge(){

      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");
          $this->load->model('EmployModel');
          
              if($this->EmployModel->state_charge($data)){
        
                  $this->response->sendJSONResponse(array("msg"=>"El estado del cargo se ha actualizado con exito."),200); 
               }else{
                      $this->response->sendJSONResponse(array('msg' => 'No se ha podido publicar.'), 400); 
               }
  
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400); 
          }
    }


    public function changeState($state){
      
     
      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");
          $this->load->model('EmployModel');
          
              if($res=$this->EmployModel->change_state($state)){
        
                  $this->response->sendJSONResponse(array("msg"=>"La publicación se ha actualizado con exito."),200); 
               }else{
                      $this->response->sendJSONResponse(array('msg' => 'No se ha podido publicar.'), 400); 
               }
  
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400); 
          }
  
      
    }
    
    


}
	