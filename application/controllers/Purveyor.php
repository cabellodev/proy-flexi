<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purveyor extends CI_Controller {

    public function __construct(){
		parent:: __construct(); 
	}

  public function adminPurveyor () { 
      
    if ($this->accesscontrol->checkAuth()['correct']) {
          
          $this->load->view('shared/headerSuperAdmin');
          $this->load->view('admin/adminPurveyor');
          $this->load->view('shared/footer');
    }else{
           $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
    }
  }


  public function getPurveyor(){
     
    $this->load->model('PurveyorModel');

      if($res=$this->PurveyorModel->get_supplier()){
          $this->response->sendJSONResponse($res); 
      }else{
          $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      } 

    }


    public function createPurveyor()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('PurveyorModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['name'])) {
          $err = "Ingrese un nombre para el proveedor.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->PurveyorModel->create_supplier($data);
          if ($res['status'] == "success") {
            $this->response->sendJSONResponse(array('status' => $res['status'], "id" => $res['id']));
          } else if($res['status'] == "repetition") {
            $this->response->sendJSONResponse(array('msg' => 'El proveedor ya se encuentra registrado'), 405);
          }
          else {
            $this->response->sendJSONResponse(array('status' => $res['status']), 500);
          }
        }
      } else {
        $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
      }
    }
  
  

    public function updatePurveyor(){

      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");

          $this->load->model('PurveyorModel');
          $res=$this->PurveyorModel->update_supplier($data['id_supplier'], $data);
          if ($res['status'] == "success") {
            $this->response->sendJSONResponse(array("msg" =>"Proveedor actualizado con éxito."));
          } else if($res['status'] == "repetition") {
            $this->response->sendJSONResponse(array('msg' => 'El proveedor ya se encuentra registrado'), 405);
          }
          else {
            $this->response->sendJSONResponse(array('status' => $res['status']), 500);
          }
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
    }


    public function changeState(){

      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");
          $state = $data['state'];
          
          $state_msg = "";
          if($state == "0"){
            $state_msg = "bloqueado";
          }else if($state == "1"){
            $state_msg = "habilitado";
          }


          $this->load->model('PurveyorModel');
          if($res=$this->PurveyorModel->change_state($data['id_supplier'], $state)){
            $this->response->sendJSONResponse(array('msg' => 'El proveedor se ha '.$state_msg.' con éxito')); 
          }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido actualizar el proveedor los datos.'), 400); 
          }
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
    }
}
