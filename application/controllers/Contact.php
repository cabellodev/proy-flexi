<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


    public function cpanelContact(){
  
        if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminContact');
          $this->load->view('shared/footer');
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    
    }

  
  public function getContacts(){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->load->model('ContactModel');
            
            if($res=$this->ContactModel->get_contact()){
      
              $this->response->sendJSONResponse($res); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  }


  public function createContact()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('ContactModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name']) || empty($data['city'])||empty($data['phone'])||empty($data['email'])||empty($data['region'])) {
          $err = "Complete todos los campos. ";
          $valid = false;
        }
      
        
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
           
          $res = $this->ContactModel->create_contact($data);
          if ($res['status'] == "success") {
            $this->response->sendJSONResponse(array('status' => $res['status'], "id" => $res['id']));
          } else {
            $this->response->sendJSONResponse(array('status' => $s['status']), 500);
          }
        }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }





    public function updateContact()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('ContactModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])){ $err = "Complete  todos los campos";  $valid = false;}
        if (empty($data['city'])){ $err = "Complete  todos los campos";   $valid = false;}
        if (empty($data['phone'])){ $err = "Complete  todos los campos";  $valid = false;}
        if (empty($data['region'])){ $err = "Complete  todos los campos"; $valid = false;}
        if (empty($data['email'])){ $err = "Complete  todos los campos";   $valid = false;}
        if (empty($data['adress'])){ $err = "Complete  todos los campos"; $valid = false;}

        
            if (!$valid) {
            $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
            } else {
                    $res = $this->ContactModel->update_contact($data);
                    if ($res['status'] == "success") {
                        $this->response->sendJSONResponse(array('status' => $res['status'], "id" => $res['id']));
                    } else {
                        $this->response->sendJSONResponse(array('status' => $s['status']), 500);
                    }
            }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }
  
  
    
      public function upImage($id_image){
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/contact";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('ContactModel');
                  $s = $this->ContactModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"El contacto se ha registrado con éxito."));
                      } else {
                        $this->response->sendJSONResponse(array('status' => "error"), 400);
                      }
                } else {
                  $this->response->sendJSONResponse(array(
                    "id" => $id, "i" => $this->upload->display_errors(),
                    "c" => $config['upload_path']
                  ));
                }
      
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    
    }


    public function upImageEdit($id_image){
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/contact";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file-edit")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('ContactModel');
                  $s = $this->ContactModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"El contacto se ha editado con éxito."));
                      } else {
                        $this->response->sendJSONResponse(array('status' => "error"), 400);
                      }
                } else {
                  $this->response->sendJSONResponse(array(
                    "id" => $id, "i" => $this->upload->display_errors(),
                    "c" => $config['upload_path']
                  ));
                }
      
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    
    }


  public function deleteContact($id_contact){

    if ($this->accesscontrol->checkAuth()['correct']) {
       
        $this->load->model('ContactModel');
        if($res=$this->ContactModel->delete_contact($id_contact)){
    
          unlink('./assets/images/contact/'.$data['url']);
          $this->response->sendJSONResponse(array('msg' => 'El contacto se ha eliminado con éxito.'),200); 
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
        }
  
    }else{
      $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }
}



	