<?php

class ChatModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_messages_id($id){
        $sql= "SELECT * FROM message WHERE chat_id = ?";
        return $this->db->query($sql,array($id))->result_array();
    }




    public function create_chat($data)
    {   
       
        $user = array( 
            "name" => $data["name"],
            "email" => $data["email"],  
            "date"  => date("Y-m-d"),
        );
    
        $this->db->insert("chat", $user);
        $id= $this->db->insert_id();
        $sql= "SELECT * FROM chat WHERE id = ?";
        return $this->db->query($sql,array($id))->result_array();
        
      
    }

    public function close_chat($data)
    {   
      
        $id = array( 
            'id'=>$data["id_chat"],
        );

        try {
          
            return $this->db->delete("chat", $id);
        
        } catch (Exception $e) {
            $s = array(
                "id" => null,
                "status" => "fail"
            );
            return $s;
        }
    }


    public function send_message_client($data){
        
        $message = array( 
            "message" => $data["text"],
            "receive" => true,  
            "date"  => date('Y-m-d H:i:s'),
            "chat_id" => $data['chat_id']
        );

        return $this->db->insert("message",$message);
    }

   


    



   

   



    


}