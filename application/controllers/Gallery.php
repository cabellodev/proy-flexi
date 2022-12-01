
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{   

    public function adminGallery()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $url = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url['query'], $params);
            $id = $params['id'];
			$this->load->view('shared/headerSuperAdmin');
            $this->load->view('admin/adminGallery', array ('id'=> $id));
            $this->load->view('shared/footer');
		
        } else {
			redirect('Home/login', 'refresh');
        }
    }


    public function getGallery($id)
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('GalleryModel');
            $datos = $this->GalleryModel->getGallery($id);
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    public function createImage()
	{
		if ($this->accesscontrol->checkAuth()['correct']) {
			$data = $this->input->post("data");
			$this->load->model('GalleryModel');
			$err = "";
			$valid = true;
			
			
			if (empty($data['name'])) {
				$err = "Ingrese un nombre para la imagen.";
				$valid = false;
			}
			
			if (!$valid) {
				$this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
			} else {
				$res = $this->GalleryModel->create_image($data);
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


	
    

	public function editImage()
	{
		
		if ($this->accesscontrol->checkAuth()['correct']) {
			$imagen = $this->input->post("data");
			$this->load->model('GalleryModel');
		
			$valid_image = true;
			$valid_name= true;
			
			if (empty($imagen['name'])) {
				$err = "Ingrese un nombre";
				$valid_image = false;
			}
			
			
			
			if (!$valid_image && !$valid_name) {
				$this->response->sendJSONResponse(array('status' => "fail", "err" => "Edite nombre o archivo"), 500);

			} else {
				$s = $this->GalleryModel->edit_imagen($imagen);
				if ($s['status'] == "success") {
					$this->response->sendJSONResponse(array('status' => $s['status'],"id" => $s['id']));
				} else {
					$this->response->sendJSONResponse(array('status' => $s['status'], "err" => $err), 500);
				}
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
	}


	public function upImage($id_image)
	{
		if ($this->accesscontrol->checkAuth()['correct']) {

					$config['upload_path'] = "./assets/images/gallery_services";
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '10000000';
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

							if ($this->upload->do_upload("file")) {

								$data = array('upload_data' => $this->upload->data());
								$url = $data['upload_data']['file_name'];
								$this->load->model('GalleryModel');
								$s = $this->GalleryModel->up_image($id_image, $url);
							
										if ($s == "success") {
											$this->response->sendJSONResponse(array("msg" =>"Imágen registrada con éxito."));
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









	public function upMultiplesImage($id)
	{
		if ($this->accesscontrol->checkAuth()['correct']) {
			
			$config['upload_path'] = "./assets/upload/";
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10000000';
			$config['encrypt_name'] = TRUE;

            $files= count($_FILES['file']['name'] );
            $aux = $_FILES;
			$msg="";
			$validate = 0;
			for($i=0;$i < $files ;$i++){

				$_FILES['file']['name'] = $aux['file']['name'][$i];
				$_FILES['file']['type']=  $aux['file']['type'][$i];
				$_FILES['file']['tmp_name']=$aux['file']['tmp_name'][$i];
				$_FILES['file']['error']=$aux['file']['error'][$i];
				$_FILES['file']['size']=$aux['file']['size'][$i];
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload("file")) {
					$data = array('upload_data' => $this->upload->data());
					$image = $data['upload_data']['file_name'];
					$this->load->model('GalleryModel');
					$s = $this->GalleryModel->insert_Image($id, $image);
					if ($s == "success") {
		
					    $msg="Imagenes registradas con exito";
					} else {
					    $validate += 1 ;
					}
				} else {
					$validate++;
					$this->response->sendJSONResponse(array(
						"id" => $id, "i" => $this->upload->display_errors(),
						"c" => $config['upload_path']
					));
				}
			}//fin for
			
			    if($validate >0){
                    $this->response->sendJSONResponse(array("msg" => "Uno de los archivos tiene formato no compatible."),400);
				}else{ 
					$this->response->sendJSONResponse(array("msg" => $msg));
				}

		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
	}


	public function editDescription()
	{
		
		if ($this->accesscontrol->checkAuth()['correct']) {
			$data = $this->input->post("data");
			$this->load->model('GalleryModel');
			$err = "";
			$valid = true;
			
			
			if (empty($data['description'])) {
				$err = "Ingrese una descripción del servicio.";
				$valid = false;
			}
			
			if (!$valid) {
				$this->response->sendJSONResponse(array('status' => "fail", "msg" => $err ), 400);
			} else {
				if($res = $this->GalleryModel->edit_description($data)){
					$this->response->sendJSONResponse(array("msg" => "La descripción del servicio se ha editado exitosamente" ), 200);
				}
				
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
			
	}







	public function deleteImage($id)
	{
		
	   if ($this->accesscontrol->checkAuth()['correct']) {
              $this->load->model('GalleryModel');
                 if( $res = $this->GalleryModel->delete_image($id)){
			         $this->response->sendJSONResponse(array('msg'=> 'La imagen se ha eliminado correctamente.'));
		        }else{
			         $this->response->sendJSONResponse(array('msg'=> 'Error al eliminar la imagen.'),400);
		         }		
	    } else {
		    $this->response->sendJSONResponse(array('status' => 'Faltan permisos de usuario.'),400);
	      }
			
	}








}





