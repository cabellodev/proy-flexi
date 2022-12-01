<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function adminCategory()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $rango = $_SESSION['rango'];
            if($rango == 1){
                $this->load->view('shared/headerSuperAdmin');
                $this->load->view('admin/adminCategory');
                $this->load->view('shared/footer');
            }else if($rango == 2){
                $this->load->view('shared/headerAdmin');
                $this->load->view('admin/adminCategory');
                $this->load->view('shared/footer');
            }
        } else {
            redirect('Home/login', 'refresh');
        }
    }
    public function getCategory()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {

            $this->load->model('CategoryModel');
            $datos = $this->CategoryModel->get_category();
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    public function createCategory()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            $name = $data['name'];
            
            $ok = true;
            $err = array();

            if ($name == "") {
                $ok = false;
                $err['name']  = "Ingrese un nombre.";
            }
          
           
            if ($ok) {
                $this->load->model('CategoryModel');
                $res=$this->CategoryModel->create_category($name);
                if($res['status'] == "success"){ 
                    $this->response->sendJSONResponse(array('msg' => "Categoria creada.")); 
                } else if($res['status'] == "repetition") {
                    $this->response->sendJSONResponse(array('msg' => 'El nombre ya existe. Reintente con otro'), 405);
                }
            } else {
                $this->response->sendJSONResponse(array('msg' => "Ingrese un nombre" ,'err'=>'Ingrese un nombre'), 400);
            }
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }
  

    
    public function updateCategory(){
		if ($this->accesscontrol->checkAuth()['correct']) {
			$data = $this->input->post('data');
			$name = $data['name'];
			$ok = true;
			$err = array();

			if ($name == "") {
				$ok = false;
				$err['name']  = "Ingrese un nombre de categoria.";
			}
		
		
			if ($ok) {
				$this->load->model('CategoryModel');
				$res = $this->CategoryModel->update_category($data);
				if($res['status'] == "success"){ 
					$this->response->sendJSONResponse(array('msg' => "Categoria modificada."));
				} else if($res['status'] == "repetition") {
                    $this->response->sendJSONResponse(array('msg' => 'El nombre ya existe. Reintente con otro'), 405);
                }
			} else {
                $this->response->sendJSONResponse(array('msg' => "Ingrese un nombre" ,'err'=>'Ingrese un nombre'), 400);
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
    }


    public function changeState()
    {

        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post("data");
            $state = $data['state'];
            
            $state_msg = "";
            if($state == "0"){
              $state_msg = "bloqueado";
            }else if($state == "1"){
              $state_msg = "habilitado";
            }
  
  
            $this->load->model('CategoryModel');
            if($res=$this->CategoryModel->change_state($data['id_category'], $state)){
              $this->response->sendJSONResponse(array('msg' => 'La categoria se ha '.$state_msg.' con éxito')); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido actualizar la categoria.'), 400); 
            }
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }
  
  
}
