<?php

class RubrosModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_rubros()
    {   
        $sql= "SELECT * FROM rubros";
        return $this->db->query($sql)->result_array();

    }

    public function delete_rubro($id)
    {   
        $sql= "DELETE FROM rubros WHERE id = ? " ;
        return $this->db->query($sql,array($id));
    }


    public function create_rubro($data)
    {   

        $data = array( 
            "name" => $data["name"],
            
        );
        try {
          
            $this->db->insert("rubros", $data);
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


    public function edit_rubro($data)
    {   

        $name = array( "name" => $data["name"]);
   

        try {
            $this->db->where("id", $data['id_rubro']);
            $this->db->update("rubros", $name);
            $s = array(
               
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
            $this->db->update("rubros", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }



    


}