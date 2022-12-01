<?php
class SubSubCategoryModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_sub_category($id_subcategory)
    {       
        $query= "SELECT * FROM subsubcategory  WHERE subsubcategory.subcategory_id = ?";
        return $this->db->query($query, array($id_subcategory))->result_array();
    }

    public function get_name_subcategory($id)
    {   
        $query= "SELECT sb.name nameSubcategoria, c.name nameCategoria, c.id idCategoria
                 FROM subcategory sb
                 LEFT JOIN category c ON sb.category_id = c.id
                 WHERE sb.id = ".$id;  
        return $this->db->query($query)->row_array();
    }


    public function create_sub_category($name, $id)
    {   
        $name = strtoupper($name);
        
        /* Query para saber si ya se encuentra resgistrado */
        $query= "SELECT * FROM subsubcategory  WHERE (subsubcategory.name = ? AND subsubcategory.subcategory_id = ?)";
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
                    'subcategory_id' => $id,
                );

                $this->db->insert("subsubcategory", $datos_subcategory);
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
        $id_sub_category = $data['id_sub_category'];
        $query= "SELECT * FROM subsubcategory  WHERE (subsubcategory.name = ? AND subsubcategory.name != ? AND subsubcategory.subcategory_id = ?)";
        $result= $this->db->query($query, array($name, $currentName, $id_sub_category));

        if($result->num_rows() > 0){
            $s = array(
                "status" => "repetition"
            );
            return $s;
        }else{
            $query = "UPDATE subsubcategory SET subsubcategory.name= ? WHERE id=?";
            $result= $this->db->query($query, array($name, $id));
            $s = array(
                "status" => "success"
            );
            return $s;
        }
   
    }
    
    public function change_state($id_sub_category, $state)
    {   
        $query = "UPDATE subsubcategory  SET subsubcategory.state = ? WHERE id = ?";
        return $this->db->query($query, array($state, $id_sub_category));
    }


}