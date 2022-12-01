<?php
class PoliciesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_policies()
    {   
        $sql= "SELECT * FROM policies";
        return $this->db->query($sql)->result_array();

    }


    public function  create_policies($data)
    {   
        $policies = array( 'name'=> $data['name'],
                        'description'=> $data['description']);

     try {
       return $this->db->insert('policies',$policies);

     } catch (Exception $e) {
        return $e;
     }
      
    }


    public function  update_policies($data)
    {   
        $policies = array( 
            'name'=> $data['name'],
            'description'=> $data['description']);

     try {
        $this->db->where('id',$data['id']);
       return $this->db->update('policies',$policies);

     } catch (Exception $e) {
        return $e;
     }
      
    }


    public function delete_policies($id)
    {   
        $sql= "DELETE FROM policies WHERE id = ?";
        return $this->db->query($sql, array($id));

    }





  


}