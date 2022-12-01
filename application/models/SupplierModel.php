<?php
class SupplierModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_supplier()
    {   
        $sql= "SELECT * FROM brands";
        return $this->db->query($sql)->result_array();
    }

    public function delete_supplier($id_supplier)
    {   
        $sql= "DELETE FROM brands WHERE id = ? " ;
        return $this->db->query($sql,array($id_supplier));
    }


    public function create_supplier($data)
    {   

        $data = array( 
            "name" => $data["name"]
        );
        try {
          
            $this->db->insert("brands", $data);
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


    public function edit_supplier($data)
    {   

        $name = array( 
            "name" => $data["name"]
        );
        try {
            $this->db->where("id", $data['id']);
            $this->db->update("brands", $name);
            
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
            'image' => $url, 
        );
    
        try {
            
            $this->db->where("id", $id_image);
            $this->db->update("brands", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }


    


}