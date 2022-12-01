<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct(){
		parent:: __construct(); 
	}

  public function adminSupplier () { 
      
    if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminSupplier');
          $this->load->view('shared/footer');
    }else{
           $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }


  public function getSupplier(){
     
    $this->load->model('SupplierModel');

          if($res=$this->SupplierModel->get_supplier()){
              $this->response->sendJSONResponse($res); 
          }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
      
    }



    public function createSupplier()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('SupplierModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])) {
          $err = "Ingrese un nombre para el proveedor.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->SupplierModel->create_supplier($data);
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


    

    public function editSupplier()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('SupplierModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])) {
          $err = "Ingrese un nombre para el proveedor.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->SupplierModel->edit_supplier($data);
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


    public function upImageEdit($id_image)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/supplier";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file-edit")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('SupplierModel');
                  $s = $this->SupplierModel->up_image($id_image, $url);
                
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
  



   
  
  
    
      public function upImage($id_image)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
  
            $config['upload_path'] = "./assets/images/supplier";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('SupplierModel');
                  $s = $this->SupplierModel->up_image($id_image, $url);
                
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
  


    public function deleteSupplier($id_supplier){

      if ($this->accesscontrol->checkAuth()['correct']) {
        
          $this->load->model('SupplierModel');
        
          if($res=$this->SupplierModel->delete_supplier($id_supplier)){
            $this->response->sendJSONResponse(array('msg' => 'El proveedor se ha eliminado con éxito.')); 
          }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
    
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
  }

	

}
