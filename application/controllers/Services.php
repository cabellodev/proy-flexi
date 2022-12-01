<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}

  

  public function cpanelServices(){
  
    if ($this->accesscontrol->checkAuth()['correct']) {
      
      $this->load->view('shared/headerSuperAdmin');
      $this->load->view('admin/galleriesService');
      $this->load->view('shared/footer');
    }else{
      $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }

}


  public function adminServices(){
  
        if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminService');
          $this->load->view('shared/footer');
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  
  }

  public function getServices(){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->load->model('ServicesModel');
          
            if($res=$this->ServicesModel->get_services()){
              $this->response->sendJSONResponse($res); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  }


  public function createService()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('ServicesModel');
       
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])|| empty($data['title'])){
          $err = "Complete ambos campos de titulo y breve descripción.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->ServicesModel->create_service($data);
          if ($res['status'] == "success") {
            $this->response->sendJSONResponse(array('status' => $res['status'],'id'=>$res['id']));
          } else {
            $this->response->sendJSONResponse(array('status' => $s['status']), 500);
          }
        }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }

 
    
    public function  updateService()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('ServicesModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])|| empty($data['title'])){
          $err = "Complete ambos campos de titulo y breve descripción.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
         
          if ( $res = $this->ServicesModel->update_service($data)) {
            $this->response->sendJSONResponse(array('status' => 'success'),200);
          } else {
            $this->response->sendJSONResponse(array('status' => $s['status']), 500);
          }
        }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }
  
    
      public function upImage($id_image)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/services_home";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('ServicesModel');
                  $s = $this->ServicesModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"Servicio registrado con éxito."));
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

    public function upImageUpload($id_image)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/services_home";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file-edit")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('ServicesModel');
                  $s = $this->ServicesModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"Servicio registrado con éxito."));
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



  public function deleteService($id_service){

    if ($this->accesscontrol->checkAuth()['correct']) {
      
        $this->load->model('ServicesModel');
      
        if($res=$this->ServicesModel->delete_service($id_service)){
          $this->response->sendJSONResponse(array('msg' => 'El servicio se ha eliminado con éxito.')); 
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
        }
  
    }else{
      $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
}


public function changeState(){
      
     
  if ($this->accesscontrol->checkAuth()['correct']) {
      $data = $this->input->post("data");
      $this->load->model('ServicesModel');
      
          if($res=$this->ServicesModel->change_state($data)){
    
              $this->response->sendJSONResponse(array("msg"=>"El servicio ha cambiado de estado con exito."),200); 
           }else{
                  $this->response->sendJSONResponse(array('msg' => 'No se ha podido publicar.'), 400); 
           }

      }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400); 
      }

  
}



}
	