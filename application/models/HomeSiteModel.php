<?php
class HomeSiteModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_notice()
    {   
        $sql= "SELECT * FROM notices";
        return $this->db->query($sql)->result_array();
    }

    


}