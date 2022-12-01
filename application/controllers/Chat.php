<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

    public function getMessageById($id){

        $this->load->model('ChatModel');
        if($res=$this->ChatModel->get_messages_id($id)){
            $this->response->sendJSONResponse($res);
        }else{
            $this->response->sendJSONResponse(array('msg' => 'Falla al cargar mensajes'), 400);
        }


    }
    
    public function closeChat(){

        $data = $this->input->post('data');
        $this->load->model('ChatModel');

        if($this->ChatModel->close_chat($data)){
            $this->response->sendJSONResponse(array('msg' => 'success'), 200);
        }else{
            $this->response->sendJSONResponse(array('msg' => 'Falla al cargar la validación'), 400);
        }


    }
    public function validateChat()
    {
    
           $data = $this->input->post('data');
         
           $this->load->model('ChatModel');
           
        if( $auth_user = $this->ChatModel->create_chat($data)){
                    $this->response->sendJSONResponse($auth_user);
                }else{
                    $this->response->sendJSONResponse(array('msg' => 'Falla al cargar la validación'), 400);
                }
    }


    public function messageClient(){

        $data = $this->input->post('data');
        $this->load->model('ChatModel');
     
        if( $this->ChatModel->send_message_client($data)){
            $this->response->sendJSONResponse(array('msg'=>'success'), 200);
        }else{
            $this->response->sendJSONResponse(array('msg' => 'Falla al cargar la validación'), 400);
        }


    }

    public function messageAdmin(){

        $data = $this->input->post('data');
        $this->load->model('ChatModel');

        if( $this->ChatModel->send_message_admin($data)){
            $this->response->sendJSONResponse(array('msg' => 'success'), 200);
        }else{
            $this->response->sendJSONResponse(array('msg' => 'Falla al cargar la validación'), 400);
        }


    }




  

    
   


    
}
