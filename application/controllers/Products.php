<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
    $this->load->helper('product_rules');
	}


    public function adminProduct () { 
      
        if ($this->accesscontrol->checkAuth()['correct']) {            
              $this->load->view('shared/headerSuperAdmin');
              $this->load->view('admin/adminProduct');
              $this->load->view('shared/footer');
        }else{
               $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
      }


    // functions web site item Home and services

    public function getProduct(){
      $this->load->model('ProductsModel');
      if($res=$this->ProductsModel->get_products()){
            $this->response->sendJSONResponse($res); 
      }else{
            $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
      }
    }

    // functions web site item Home and services
    public function getFields(){
      $this->load->model('ProductsModel');
      $this->load->model('CategoryModel');

      $suppliers = $this->ProductsModel->get_supplier();
      $category = $this->ProductsModel->get_category();
      $subCategory = $this->ProductsModel->get_sub_category();
      $subSubCategory = $this->ProductsModel->get_sub_sub_category();

      $this->response->sendJSONResponse(array($suppliers, $category, $subCategory, $subSubCategory));
    }

    public function getFieldsUpdate($id)
      {
      $this->load->model('ProductsModel');
      $this->load->model('CategoryModel');

      $product = $this->ProductsModel->get_product($id);
      $suppliers = $this->ProductsModel->get_supplier();
      $category = $this->ProductsModel->get_category();
      $subCategory = $this->ProductsModel->get_sub_category();
      $subSubCategory = $this->ProductsModel->get_sub_sub_category();

      $this->response->sendJSONResponse(array($suppliers, $category, $subCategory, $subSubCategory, $product)); 
    }

    // functions web site item Home and services
    public function adminCreateProduct(){
      $this->load->view('shared/headerSuperAdmin');
      $this->load->view('admin/createProduct');
      $this->load->view('shared/footer');
    }

    // functions web site item Home and services
    public function adminUpdateProduct($id){
      $this->load->view('shared/headerSuperAdmin');
      $this->load->view('admin/updateProduct');
      $this->load->view('shared/footer');
    }

    public function createProduct()
    { 
      if ($this->accesscontrol->checkAuth()['correct']) {  
        /* Datos de formulario*/
        $data = $this->input->post('data');

        /* Cargar datos para la validación de formulario*/
        $rules = get_rules_product_create();
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($rules);

        /*Validación de formulario
        Si el formulario no es valido (sin contar la descr)*/

        if($this->form_validation->run() == FALSE){
          if(form_error('code')) $msg['code'] = form_error('code');
          if(form_error('name')) $msg['name'] = form_error('name');
          if(form_error('price')) $msg['price'] = form_error('price');
          if(form_error('model')) $msg['model'] = form_error('model');
          if(form_error('supplier')) $msg['supplier'] = form_error('supplier');
          if(form_error('category')) $msg['category'] = form_error('category');
          if(form_error('imagenPrincipal')) $msg['imagenPrincipal'] = form_error('imagenPrincipal');
          $this->response->sendJSONResponse(array('msg' => $msg), 400);
        }else{
          if($data['state_descr'] == '1'){
            $this->response->sendJSONResponse(array('msg' => 'errores en la descripcion'), 401);
          }else{
              /*Si el formulario es valido*/
              $this->load->model('ProductsModel');
              $res = $this->ProductsModel->create_product($data);

              /*Ingresada correctamente*/
              if($res['status'] == "success"){
                  $this->response->sendJSONResponse(array('status' => $res['status'], "id" => $res['id']));
                /*Fallo en el ingreso */
              }else if($res['status'] == "repetition") {
                $this->response->sendJSONResponse(array('msg' => 'El producto ya se encuentra registrado.'), 405);
              }
              else {
                $this->response->sendJSONResponse(array('status' => $res['status']), 500);
              }
            } 
          }
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
    }

    public function updateProduct()
    { 
      if ($this->accesscontrol->checkAuth()['correct']) {  
        /* Datos de formulario*/
        $data = $this->input->post('data');

        /* Cargar datos para la validación de formulario*/
        $rules = get_rules_product_update();
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($rules);

        /*Validación de formulario
        Si el formulario no es valido, sin contar descripcion*/
        if($this->form_validation->run() == FALSE){
          if(form_error('code')) $msg['code'] = form_error('code');
          if(form_error('name')) $msg['name'] = form_error('name');
          if(form_error('price')) $msg['price'] = form_error('price');
          if(form_error('model')) $msg['model'] = form_error('model');
          if(form_error('supplier')) $msg['supplier'] = form_error('supplier');
          if(form_error('category')) $msg['category'] = form_error('category');
          $this->response->sendJSONResponse(array('msg' => $msg), 400);
        }else{

          /* Errores en la descripcion */
          if($data['state_descr'] == '1'){
            $this->response->sendJSONResponse(array('msg' => 'errores en la descripcion'), 401);
          }else{
            /*Si el formulario es valido*/
            $this->load->model('ProductsModel'); 
            $res = $this->ProductsModel->update_product($data);
            if($res['status'] == "success"){
                $this->response->sendJSONResponse(array('status' => $res['status'])); 
              /*Fallo en el ingreso */
            }else if($res['status'] == "repetition") {
              $this->response->sendJSONResponse(array('msg' => 'El producto ya se encuentra registrado.'), 405);
            }
            else {
              $this->response->sendJSONResponse(array('status' => $res['status']), 500);
            }
          }
        } 
      }else{
        $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
      }
    }
    
    public function create_uploadImageP($id_product)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('formData');

            $config['upload_path'] = "./assets/images/products/image_first";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 

          try{

            if ($this->upload->do_upload("foto")) {
  
              $data = array('upload_data' => $this->upload->data());
              $url = $data['upload_data']['file_name'];
              $this->load->model('ProductsModel');
              $s = $this->ProductsModel->up_imageP($id_product, $url);
            
                  if ($s == "success") {
                    $this->response->sendJSONResponse(array("msg" =>"Imagen principal añadida con exito."));
                  } else {
                    $this->response->sendJSONResponse(array('status' => "error"), 400);
                  }
            } else {
              $this->response->sendJSONResponse(array('status' => "error"), 400);
            }
          } catch (Exception $e) {
              return $e;
          }
      }
    }

    public function update_uploadImageP($id_product)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('formData');

            $config['upload_path'] = "./assets/images/products/image_first";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 

          try{

            if ($this->upload->do_upload("foto")) {
  
              $data = array('upload_data' => $this->upload->data());
              $url = $data['upload_data']['file_name'];
              $this->load->model('ProductsModel');
              $s = $this->ProductsModel->update_up_imageP($id_product, $url);
                  if ($s == "success") {
                    $this->response->sendJSONResponse(array("msg" =>"Imagen principal añadida con exito."));
                  } else {
                    $this->response->sendJSONResponse(array('status' => "error"), 400);
                  }
            } else {
              $this->response->sendJSONResponse(array('status' => "error"), 400);
            }
          } catch (Exception $e) {
              return $e;
          }
      }
    }

    public function create_uploadImages($id_product)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('formData');

            $config['upload_path'] = "./assets/images/products";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 

          try{
            $images = array();

            for($i = 1; $i <= 3; $i++){

              if ($this->upload->do_upload('foto'.$i)){
                $data = array('upload_data' => $this->upload->data());
                $url = $data['upload_data']['file_name'];
                $urls= array(
                  'imagen'.$i => $url, 
                );
                array_push($images, $urls);
              }else{
                $urls= array(
                  'imagen'.$i => '', 
                );
                array_push($images, $urls);
              };
             
            };
            $this->load->model('ProductsModel');
            $s = $this->ProductsModel->up_images($id_product, $images);
            if ($s == "success") {
              $this->response->sendJSONResponse(array("msg" =>"Producto registrado con éxito."));
            } else {
              $this->response->sendJSONResponse(array('status' => "error"), 400);
            } 
          } catch (Exception $e) {
              return $e;
          }
      }
    }

    public function update_uploadImages($id_product)
    {
      if ($this->accesscontrol->checkAuth()['correct']) {
          try{

            $config['upload_path'] = "./assets/images/products";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $config['encrypt_name'] = TRUE;
  
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 
            $images = array();


            /* Metodo para actualizar las imagenes */

            for($i = 1; $i <= 3; $i++){ 
              /* No hay cambios en la imagen  */

              $foto = $this->input->post('foto'.$i);
              $currentUrl = $this->input->post('foto'.$i.'_url');

              if($foto == "1" || $foto == "2"){
                $urls= array(
                  'imagen'.$i => $currentUrl
                );
                array_push($images, $urls);

                /* Se elimino la imagen */
              }else if($foto == "0"){
                $urls= array(
                  'imagen'.$i => '', 
                );
                unlink("./assets/images/products/".$currentUrl);
                array_push($images, $urls);
              }else{

                /* Se selecciono una imagen */
                if ($this->upload->do_upload('foto'.$i)){
                  $data = array('upload_data' => $this->upload->data());
                  $url = $data['upload_data']['file_name'];

                  /* Se esta reemplazando la imagen */
                  if($currentUrl){
                    $urls= array(
                      'imagen'.$i => $url, 
                    );
                    array_push($images, $urls);
                    unlink("./assets/images/products/".$currentUrl);
                  }else{
                    /* Es primera vez q se sube una imagen  */
                    $urls= array(
                      'imagen'.$i => $url, 
                    );
                    array_push($images, $urls);
                  }
                }else{
                  $urls= array(
                    'imagen'.$i => '', 
                  );
                  array_push($images, $urls);
                };
              }

              var_dump($images);
            };

            
            $this->load->model('ProductsModel');
            $s = $this->ProductsModel->update_up_images($id_product, $images);
            if ($s == "success") {
              $this->response->sendJSONResponse(array("msg" =>"Producto registrado con éxito."));
            } else {
              $this->response->sendJSONResponse(array('status' => "error"), 400);
            } 
          } catch (Exception $e) {
              return $e;
          }
      }
    }

    public function deleteProduct($id_product){

        if ($this->accesscontrol->checkAuth()['correct']) {
          
            $this->load->model('ProductsModel');
            $res = $this->ProductsModel->delete_product($id_product);
            
            if($res['status'] == "success"){
              $this->response->sendJSONResponse(array('msg' => 'El producto se ha eliminado con éxito.')); 
            }else{
              $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
            }
      
        }else{
          $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    }


}
	