<?php
class NoticesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_notices()
    {   
        $sql= "SELECT * FROM notices";
        return $this->db->query($sql)->result_array();
    }

    public function delete_notice($id_supplier)
    {   
        $sql= "DELETE FROM notices WHERE id = ? " ;
        return $this->db->query($sql,array($id_supplier));
    }


    public function create_notice($data)
    {   

        $data = array( 
            "name" => $data["name"]
        );
        try {
          
            $this->db->insert("notices", $data);
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

    public function update_notice($data)
    {   

        $notice = array( 
            "name" => $data["name"]
        );
        try {
            $this->db->where("id", $data['id']);
            return $this->db->update("notices", $notice);
         
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
            'image' => $url, 
        );
    
        try {
            
            $this->db->where("id", $id_image);
            $this->db->update("notices", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }


    


}