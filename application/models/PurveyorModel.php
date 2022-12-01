<?php
class PurveyorModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_supplier()
    {   
        $sql= "SELECT * FROM supplier";
        return $this->db->query($sql)->result_array();
    }

    public function create_supplier($data)
    {   

        $data = array( 
            "name" => strtoupper($data["name"]),
        );

        /* Query para saber si ya se encuentra resgistrado */
        $name = strtoupper($data['name']);
        $query= "SELECT * FROM supplier  WHERE supplier.name = ?";
        $result= $this->db->query($query, array($name));


        if($result->num_rows() > 0){
            $s = array(
                "id" => null,
                "status" => "repetition"
            );
            return $s;
        }else{
            try {     
                $this->db->insert("supplier", $data);
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


    public function update_supplier($id_supplier, $data)
    {   
        $name = strtoupper($data['name']);
        $query= "SELECT * FROM supplier  WHERE (supplier.name = ? AND supplier.name != ?)";
        $result= $this->db->query($query, array($name, $data['currentName']));

        if($result->num_rows() > 0){
            $s = array(
                "status" => "repetition"
            );
            return $s;
        }else{
            $query = "UPDATE supplier SET supplier.name= ? WHERE id=?";
            $result= $this->db->query($query, array($name, $id_supplier));
            $s = array(
                "status" => "success"
            );
            return $s;
        }
   
    }


     public function change_state($id_supplier, $state)
    {   
        $query = "UPDATE supplier  SET supplier.state = ? WHERE id = ?";
        return $this->db->query($query, array($state, $id_supplier));
    }
}