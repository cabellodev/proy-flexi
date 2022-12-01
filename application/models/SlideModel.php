<?php
class SlideModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_slide()
    {   
        $sql= "SELECT * FROM slides";
        return $this->db->query($sql)->result_array();
    }

    public function delete_slide($id_supplier)
    {   
        $sql= "DELETE FROM slides WHERE id = ? " ;
        return $this->db->query($sql,array($id_supplier));
    }


    public function create_slide($data)
    {   

        $data = array( 
            "name" => $data["name"]
        );
        try {
          
            $this->db->insert("slides", $data);
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


    public function edit_slide($data)
    {   

        $name = array( 
            "name" => $data["name"]
        );
        try {
            $this->db->where("id", $data['id']);
            $this->db->update("slides", $name);
            
            $s = array(
                "id" => $data['id'],
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
            $this->db->update("slides", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }

    public function  changeState($data)
    {   
        $state = array( 
            "state" => $data["state"]
        );
     
        try {
            $this->db->where("id", $data['id']);
           return $this->db->update("slides", $state);
            
   
         
        } catch (Exception $e) {
            $s = array(
            
                "status" => "fail"
            );
            return $s;
        }
    }




    


}