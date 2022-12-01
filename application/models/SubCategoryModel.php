<?php
class SubCategoryModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_sub_category($id_category)
    {       
        $query= "SELECT * FROM subcategory  WHERE subcategory.category_id = ?";
        return $this->db->query($query, array($id_category))->result_array();
    }

    public function get_name_category($id)
    {   
        $query= "SELECT category.name FROM category  WHERE category.id = ?";
        return $this->db->query($query, array($id))->result_array();
    }


    public function create_sub_category($name, $id)
    {   
        $name = strtoupper($name);
        /* Query para saber si ya se encuentra resgistrado */
        $query= "SELECT * FROM subcategory  WHERE (subcategory.name = ? AND subcategory.category_id = ?)";
        $result= $this->db->query($query, array($name, $id));

    
        if($result->num_rows() > 0){
            $s = array(
                "status" => "repetition"
            );
            return $s;
        }else{
            try {
                $datos_subcategory= array(
                    'name' => $name,
                    'category_id' => $id,
                );

                $this->db->insert("subcategory", $datos_subcategory);
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


    public function update_sub_category($data)
    {   
        $id = $data['id'];
        $name = strtoupper($data['name']);
        $currentName = $data['currentName'];
        $query= "SELECT * FROM subcategory  WHERE (subcategory.name = ? AND subcategory.name != ? AND subcategory.category_id = ?)";
        $result= $this->db->query($query, array($name, $currentName, $id));

        if($result->num_rows() > 0){
            $s = array(
                "status" => "repetition"
            );
            return $s;
        }else{
            $query = "UPDATE subcategory SET subcategory.name= ? WHERE id=?";
            $result= $this->db->query($query, array($name, $id));
            $s = array(
                "status" => "success"
            );
            return $s;
        }
   
    }
    
    public function change_state($id_sub_category, $state)
    {   
        $query = "UPDATE subcategory  SET subcategory.state = ? WHERE id = ?";
        return $this->db->query($query, array($state, $id_sub_category));
    }


}