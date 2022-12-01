<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcategory extends CI_Controller
{
    public function adminSubCategory($id_category)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $rango = $_SESSION['rango'];


            $this->load->model('SubCategoryModel');
            $datos = $this->SubCategoryModel->get_name_category($id_category);
            $data['Subtarea'] = $datos[0]['name'];

            if($rango == 1){
                $this->load->view('shared/headerSuperAdmin');
                $this->load->view('admin/adminSubcategory', $data);
                $this->load->view('shared/footer');
            }else if($rango == 2){
                $this->load->view('shared/headerAdmin');
                $this->load->view('admin/adminSubcategory', $data);
                $this->load->view('shared/footer');
            }
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function getSubCategory()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            $id_category = $data['id'];
            $this->load->model('SubCategoryModel');
            $datos = $this->SubCategoryModel->get_sub_category($id_category);
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    public function createSubCategory()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            $name = $data['name'];
            $id = $data['id'];
            
            $ok = true;
            $err = array();

            if ($name == "") {
                $ok = false;
                $err['name']  = "Ingrese un nombre.";
            }
          
           
            if ($ok) {
                $this->load->model('SubCategoryModel');
                $res=$this->SubCategoryModel->create_sub_category($name, $id);
                if($res['status'] == "success"){ 
                    $this->response->sendJSONResponse(array('msg' => "Subcategoria creada.")); 
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
  

    
    public function updateSubCategory(){
		if ($this->accesscontrol->checkAuth()['correct']) {
			$data = $this->input->post('data');
			$name = $data['name'];
			$ok = true;
			$err = array();

			if ($name == "") {
				$ok = false;
				$err['name']  = "Ingrese un nombre de subcategoria.";
			}
		
		
			if ($ok) {
				$this->load->model('SubCategoryModel');
				$res = $this->SubCategoryModel->update_sub_category($data);
				if($res['status'] == "success"){ 
					$this->response->sendJSONResponse(array('msg' => "Subcategoria modificada."));
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
  
  
            $this->load->model('SubCategoryModel');
            if($res=$this->SubCategoryModel->change_state($data['id_category'], $state)){
              $this->response->sendJSONResponse(array('msg' => 'La Subcategoria se ha '.$state_msg.' con éxito')); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido actualizar la subcategoria.'), 400); 
            }
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }
  
  
}
