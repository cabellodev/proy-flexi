<?php

class ContactModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_contact()
    {   
        $sql= "SELECT * FROM contact";
        return $this->db->query($sql)->result_array();

    }


    public function create_contact($data)
    {   
      
        $contact = array( 
            "name" => $data["name"],
            "city" => $data["city"],
            "phone" => $data["phone"],
            "email" => $data["email"],
            "region" => $data["region"],
            
        );

        try {
          
            $this->db->insert("contact", $contact);
            $id = $this->db->insert_id();
            $s = array(
                "id" => $id,
                "status" => "success"
            );
            return $s;
         
        } catch (Exception $e) {
            $s = array(
                "id" => null,
                "status" => "fail"
            );
            return $s;
        }
    }


    public function update_contact($data)
    {   

        $contact = array(  
                        "name" => $data["name"],
                        "city" => $data["city"],
                        "phone" => $data["phone"],
                        "email" => $data["email"],
                        "region" => $data["region"],
                        "adress" => $data["adress"]
                     );

        try {
            $this->db->where("id", $data['id']);
            $this->db->update("contact", $contact);
            $s = array(
               "id"=>$data['id'],
                "status" => "success"
            );
            return $s;
         
        } catch (Exception $e) {
            $s = array(
                "id" => null,
                "status" => "fail"
            );
            return $s;
        }
    }

    public function up_image($id_image, $url)
    {  

        $data = array(
            'url' => $url, 
        );
    
        try {
            
            $this->db->where("id", $id_image);
            $this->db->update("contact", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }


    public function delete_contact($id_contact)
    {   
        $sql= "DELETE FROM contact WHERE id = ? " ;
        return $this->db->query($sql,array($id_contact));
    }




    


}