<?php
class CategoryModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_category()
    {   
        $sql= "SELECT * FROM category";
        return $this->db->query($sql)->result_array();
    }

    public function create_category($name)
    {   
        $name = strtoupper($name);
        $data = array( 
            "name" => $name,
        );

        /* Query para saber si ya se encuentra resgistrado */
        $query= "SELECT * FROM category  WHERE category.name = ?";
        $result= $this->db->query($query, $name);


        if($result->num_rows() > 0){
            $s = array(
                "status" => "repetition"
            );
            return $s;
        }else{
            try {
                $this->db->insert("category", $data);
                $s = array(
                    "status" => "success"
                );
                return $s;
             
            } catch (Exception $e) {
                $s = array(
                    "status" => "fail"
                );
                return $s;
            }
        }
    }


    public function update_category($data)
    {   
        $id = $data['id'];
        $name = strtoupper($data['name']);
        $currentName = $data['currentName'];

        $query= "SELECT * FROM category  WHERE (category.name = ? AND category.name != ?)";
        $result= $this->db->query($query, array($name, $currentName));

        if($result->num_rows() > 0){
            $s = array(
                "status" => "repetition"
            );
            return $s;
        }else{
            $query = "UPDATE category SET category.name= ? WHERE id=?";
            $result= $this->db->query($query, array($name, $id));
            $s = array(
                "status" => "success"
            );
            return $s;
        }
   
    }
    
    public function change_state($id_category, $state)
    {   
        $query = "UPDATE category  SET category.state = ? WHERE id = ?";
        return $this->db->query($query, array($state, $id_category));
    }


}