<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


    public function adminNews () { 
      
        if ($this->accesscontrol->checkAuth()['correct']) {
              
              $this->load->view('shared/headerSuperAdmin');
              $this->load->view('admin/adminNews');
              $this->load->view('shared/footer');
        }else{
               $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }


   

    // functions web site item Home and services
    public function getNews(){
     
          $this->load->model('NewsModel');
  
          if($res=$this->NewsModel->get_news()){
            
                $this->response->sendJSONResponse($res); 
             }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
             }
        
    }


    public function deleteNews(){

        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post("data");
            $this->load->model('NewsModel');
          
            if($this->NewsModel->delete_new($data)){
           
              unlink('./assets/images/news/'.$data['url']);
              $this->response->sendJSONResponse(array('msg' => 'La noticia se ha eliminado con éxito.'),200); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    }


    
    public function createNew()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('NewsModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['title'])||empty($data['description'])) {
          $err = "Complete todos los campos.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          $res = $this->NewsModel->create_new($data);
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

     
    public function updateNews()
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post("data");
        $this->load->model('NewsModel');
        $err = "";
        $valid = true;
        
        
        if (empty($data['title'])||empty($data['description'])) {
          $err = "Complete todos los campos.";
          $valid = false;
        }
        
        if (!$valid) {
          $this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
        } else {
          
          if ($this->NewsModel->update_new($data)) {
            $this->response->sendJSONResponse(array('msg'=>'Noticia editada con éxito.'),200);
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
  
            $config['upload_path'] = "./assets/images/news";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
  
                if ($this->upload->do_upload("file")) {
  
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];
                  $this->load->model('NewsModel');
                  $s = $this->NewsModel->up_image($id_image, $url);
                
                      if ($s == "success") {
                        $this->response->sendJSONResponse(array("msg" =>"Noticia registrada con éxito."));
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



    public function changeState(){
  

      if ($this->accesscontrol->checkAuth()['correct']) {
          $data = $this->input->post("data");
          $this->load->model('NewsModel');
          
            if($res=$this->NewsModel->changeState($data)){
              $this->response->sendJSONResponse(array('msg' => 'El cambiado estado con éxito.')); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido cambiar estado.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
  
     }
  





/*
    public function get_images(){

    }

    // function panel de control 

    public function create_service(){


    }

    public function edit_services(){

    }

    public function delete_service(){

    }


*/


}
	