<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubros extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}

  
  public function getRubros(){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->load->model('RubrosModel');
            
            if($res=$this->RubrosModel->get_rubros()){
      
              $this->response->sendJSONResponse($res); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  }


  public function createRubros()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('RubrosModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])) {
          $err = "Ingrese un nombre para el rubro.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->RubrosModel->create_rubro($data);
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


    public function editRubros()
  
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        
        $data = $this->input->post("data");
        $this->load->model('RubrosModel');
        unlink('./assets/images/rubros/'.$data['url']);
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])) {
          $err = "Introduzca nombre a la imagen.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->RubrosModel->edit_rubro($data);
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
  
  
    
      public function upImage($id_image)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/rubros";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('RubrosModel');
                  $s = $this->RubrosModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"Rubro registrado con éxito."));
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

  public function deleteRubro($id_rubro){

    if ($this->accesscontrol->checkAuth()['correct']) {
      
        $this->load->model('RubrosModel');
      
        if($res=$this->RubrosModel->delete_rubro($id_rubro)){
          $this->response->sendJSONResponse(array('msg' => 'El rubro se ha eliminado con éxito.')); 
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
        }
  
    }else{
      $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
}


}
	