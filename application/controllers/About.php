<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


    public function cpanelAbout(){
  
        if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminAbout');
          $this->load->view('shared/footer');
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    
    }

  
  public function getPersonal(){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->load->model('AboutModel');
            
            if($res=$this->AboutModel->get_personal()){
      
              $this->response->sendJSONResponse($res); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  }


  public function createPersonal()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('AboutModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name']) || empty($data['area'])||empty($data['phrase'])) {
          $err = "Complete la información en todos los campos. ";
          $valid = false;
        }
      
        
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->AboutModel->create_personal($data);
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


    public function updatePersonal()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('AboutModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])|| empty($data['name'])||empty($data['name']) ) {
          $err = "Complete información en todos los campos.";
          $valid = false;
        }

        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->AboutModel->update_personal($data);
          if ($res['status'] == "success") {
            $this->response->sendJSONResponse(array('status' => $res['status'],));
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
  
            $config['upload_path'] = "./assets/images/personal";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('AboutModel');
                  $s = $this->AboutModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"El personal se ha registrado con éxito."));
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

  public function deletePersonal($id_personal){

    if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");

        $this->load->model('AboutModel');
        if($res=$this->AboutModel->delete_personal($id_personal)){
    
          unlink('./assets/images/personal/'.$data['url']);
          $this->response->sendJSONResponse(array('msg' => 'El personal se ha eliminado con éxito.'),200); 
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
        }
  
    }else{
      $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }


}
	