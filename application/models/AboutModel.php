<?php

class AboutModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_personal()
    {   
        $sql= "SELECT * FROM personal";
        return $this->db->query($sql)->result_array();

    }

    public function get_identity($id)
    {   
        $sql= "DELETE FROM entity WHERE id = ? " ;
        return $this->db->query($sql,array($id));
    }


    public function create_personal($data)
    {   

        $data = array( 
            "name" => $data["name"],
            "area" => $data["area"],
            "phrase" => $data["phrase"],
            
        );

        try {
          
            $this->db->insert("personal", $data);
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


    public function update_personal($data)
    {   

        $personal = array( "name" => $data["name"],
        "area" => $data["area"],
        "phrase" => $data["phrase"],
        
    );
   

        try {
            $this->db->where("id", $data['id']);
            $this->db->update("personal", $personal);
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
            $this->db->update("personal", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }


    public function delete_personal($id_personal)
    {   
        $sql= "DELETE FROM personal WHERE id = ? " ;
        return $this->db->query($sql,array($id_personal));
    }




    


}