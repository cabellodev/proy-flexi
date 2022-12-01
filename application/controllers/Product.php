<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
		
	}


    public function adminProduct () { 
      
        if ($this->accesscontrol->checkAuth()['correct']) {
              
              $this->load->view('shared/headerSuperAdmin');
              $this->load->view('admin/adminNews');
              $this->load->view('shared/footer');
        }else{
               $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }


      public function sectionProduct () { 
      
        if ($this->accesscontrol->checkAuth()['correct']) {
              
              $this->load->view('shared/headerSuperAdmin');
              $this->load->view('admin/sectionProduct');
              $this->load->view('shared/footer');
        }else{
               $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }



      public function Products(){
     
        $this->load->model('ProductModel');

        if($res=$this->ProductModel->get_products()){
          
              $this->response->sendJSONResponse($res); 
           }else{
                  $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
           }
      
      }



   

    // functions web site item Home and services
    public function getProducts(){
     
          $this->load->model('ProductModel');
  
          if($res=$this->ProductModel->get_products()){
            
                $this->response->sendJSONResponse($res); 
             }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
             }
        
    }



    public function deleteProduct($id_news){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->load->model('NewsModel');
          
            if($res=$this->NewsModel->delete_news($id_news)){
              $this->response->sendJSONResponse(array('msg' => 'La noticia se ha eliminado con éxito.')); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    }



}
	