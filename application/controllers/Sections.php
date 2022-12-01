<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


  public function sectionHome() { 
      
    if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/sectionHome');
          $this->load->view('shared/footer');
    }else{
           $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }

  
  public function getSections(){

        if ($this->accesscontrol->checkAuth()['correct']) {
      
             $data = $this->input->post("data");
            $this->load->model('SectionsModel');
            
            if($res=$this->SectionsModel->get_sections($data)){
      
              $this->response->sendJSONResponse($res); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  }


  public function updateNotImage()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('SectionsModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['title'])) {
          $err = "Ingrese un título";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
         
       
          if ($res = $this->SectionsModel->update_not_image($data)) {
           
            $this->response->sendJSONResponse(array('status' => 'success'),200);
          } else {
            $this->response->sendJSONResponse(array('status' => $s['status']), 500);
          }
        }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }


 
    public function updateSection()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('SectionsModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['title'])||empty($data['description'])) {
          $err = "Complete título y descripción";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
         
       
          if ($res = $this->SectionsModel->update_section($data)) {
           
            $this->response->sendJSONResponse(array('status' => 'success'),200);
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
    
              $config['upload_path'] = "./assets/images/sections";
              $config['allowed_types'] = 'jpg|png|jpeg';
              $config['max_size'] = '10000000';
              $config['encrypt_name'] = TRUE;
    
              $this->load->library('upload', $config);
              $this->upload->initialize($config);
    
                  if ($this->upload->do_upload("file-section")) {
    
                    $data = array('upload_data' => $this->upload->data());
                    $url = $data['upload_data']['file_name'];
                    $this->load->model('SectionsModel');
                    $s = $this->SectionsModel->up_image($id_image, $url);
                  
                        if ($s == "success") {
                          $this->response->sendJSONResponse(array("msg" =>"La sección se ha actualizado con éxito."));
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
  
  
  
    

}
	