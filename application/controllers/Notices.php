<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends CI_Controller {

    public function __construct(){
		parent:: __construct(); 
	}

  public function adminNotices () { 
      
    if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminNotice');
          $this->load->view('shared/footer');
    }else{
           $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }


  public function getNotices(){
     
    $this->load->model('NoticesModel');

          if($res=$this->NoticesModel->get_notices()){
              $this->response->sendJSONResponse($res); 
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
      
    }



    public function createNotice()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('NoticesModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])) {
          $err = "Ingrese un nombre para el aviso.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->NoticesModel->create_notice($data);
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
  
  
    
      public function upImage($id_image)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/notices";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('NoticesModel');
                  $s = $this->NoticesModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"Proveedor registrado con éxito."));
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


    
    public function updateNotice(){

      if ($this->accesscontrol->checkAuth()['correct']) {
           $data = $this->input->post("data");
          $this->load->model('NoticesModel');
        
          if($res=$this->NoticesModel->update_notice($data)){
            $this->response->sendJSONResponse(array('msg' => 'El aviso  se ha editado con éxito.')); 
          }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
    
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
  }
  


    public function deleteNotice($id_notice){

      if ($this->accesscontrol->checkAuth()['correct']) {
        
          $this->load->model('NoticesModel');
        
          if($res=$this->NoticesModel->delete_notice($id_notice)){
            $this->response->sendJSONResponse(array('msg' => 'La publicación se ha eliminado con éxito.')); 
          }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
    
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
  }

	

}
