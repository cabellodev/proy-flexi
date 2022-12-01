<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeSite extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
	}
	
	//Funcion para cargar la vista del login
    
     public function getServices(){
     
        $this->load->model('ServicesModel');

        if($res=$this->ServicesModel->get_services()){
           $this->response->sendJSONResponse($res); 
         }else{
           $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
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

   public function getSupplier(){
     
      $this->load->model('SupplierModel');
      if($res=$this->SupplierModel->get_supplier()){
         $this->response->sendJSONResponse($res); 
       }else{
         $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
       }
    
   }

   public function getSlide(){
     
    $this->load->model('SlideModel');
    if($res=$this->SlideModel->get_slide()){
       $this->response->sendJSONResponse($res); 
     }else{
       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
     }
  
 }


   public function getSupplierSelect(){
     
    $this->load->model('ProductModel');
    if($res=$this->ProductModel->get_supplier()){
       $this->response->sendJSONResponse($res); 
     }else{
       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
     }
  
 }





   public function getNews(){
     
    $this->load->model('NewsModel');

    if($res=$this->NewsModel->get_news()){
       $this->response->sendJSONResponse($res); 
     }else{
       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
     }
  
  }

  public function getRubros(){
     
    $this->load->model('RubrosModel');

    if($res=$this->RubrosModel->get_rubros()){
       $this->response->sendJSONResponse($res); 
     }else{
       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
     }
  
  }

 
  
  public function getPublications(){
     
    $this->load->model('EmployModel');

    if($res=$this->EmployModel->get_publications()){
       $this->response->sendJSONResponse($res); 
     }else{
       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
     }
  
  }

  public function getCharges(){

    $this->load->model('EmployModel');

    if($res=$this->EmployModel->get_charges_enable()){
       $this->response->sendJSONResponse($res); 

     }else{

       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 

     }
  
  }


  public function getCategory(){

      $this->load->model('ProductModel');

      if($res=$this->ProductModel->get_category()){
       $this->response->sendJSONResponse($res); 

     }else{

       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 

     }
  
  }

  public function getSubcategories($id_subcategory){

    $this->load->model('ProductModel');

    if($res=$this->ProductModel->get_subcategory($id_subcategory)){
     $this->response->sendJSONResponse($res); 

   }else{

     $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 

   }

}

public function getSubSubcategories($id_subcategory){

  $this->load->model('SubSubCategoryModel');

  if($res=$this->SubSubCategoryModel->get_sub_category($id_subcategory)){
   $this->response->sendJSONResponse($res); 

 }else{

   $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 

 }

}



  public function getPersonal(){

     
     $this->load->model('AboutModel');

    if($res=$this->AboutModel->get_personal()){
       $this->response->sendJSONResponse($res); 

     }else{
       $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
     }
  
  }


  public function getGallery($id) {

      
       $this->load->model('GalleryModel');
       if( $datos = $this->GalleryModel->getGallery($id)){
          $this->response->sendJSONResponse($datos);
       }else{
        $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      }
  }


  public function createNotification(){
    
        $data = $this->input->post("data");
        $this->load->model('EmployModel');
        $ok = true;
   
        
        if(empty($data['name'])){ $ok=false;}
        if(empty($data['surname'])){ $ok=false; }
        if(empty($data['phone'])){ $ok=false; }
        if(empty($data['charge'])){ $ok=false; }
        if(empty($data['email'])){ $ok=false; }
     
        if($ok){
          
            if($this->EmployModel->create_notification($data)){
      
                $this->response->sendJSONResponse(array("msg"=>"La notificación se ha registrado con éxito"),200); 
             }else{
                    $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
             }

        }else{
            $this->response->sendJSONResponse(array('msg' => 'Complete todos los campos.'), 400); 
        }
   }


 public function getProducts() {
  $data = $this->input->post("data");
   $this->load->model('ProductModel');
        if( $res= $this->ProductModel->get_products($data)){
          $this->response->sendJSONResponse($res);
        }else{
        $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      }
  }



  
  public function getProductId($id) {

      $this->load->model('ProductModel');
          if( $res= $this->ProductModel->get_products_id($id)){
            $this->response->sendJSONResponse($res);
          }else{
          $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
          }
  }


  public function  getAllProducts() {

    $this->load->model('ProductModel');
        if( $res= $this->ProductModel->get_product()){
          $this->response->sendJSONResponse($res);
        }else{
        $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
        }
  }


  public function getContacts() {
       
    $this->load->model('ContactModel');
        if( $res= $this->ContactModel->get_contact()){
          $this->response->sendJSONResponse($res);
        }else{
        $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      }
   }


   public function getSections() {
       
    $this->load->model('SectionsModel');
        if( $res= $this->SectionsModel->get_section()){
          $this->response->sendJSONResponse($res);
        }else{
        $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      }
   }


   public function getPolicies() {
       
    $this->load->model('PoliciesModel');
        if( $res= $this->PoliciesModel->get_policies()){
          $this->response->sendJSONResponse($res);
        }else{
        $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      }
   }





 
  }

  


	
	
