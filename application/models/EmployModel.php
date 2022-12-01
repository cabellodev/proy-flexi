<?php

class EmployModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_charges()
    {   
        $sql= "SELECT * FROM charges ";
        return $this->db->query($sql)->result_array();

    }

    public function get_charges_enable()
    {   
        $sql= "SELECT * FROM charges WHERE state=?";
        return $this->db->query($sql,array(true))->result_array();

    }


    public function create_charge($data)
    {   
        $sql= "SELECT * FROM charges WHERE charges.name=?";
        $result= $this->db->query($sql,array($data['name']))->result_array();

       if(sizeof($result)>0){
        return false;
       }else{
        $charge =array (
            'name'=>$data['name'],
            'state'=>true,
         );
 
       return $this->db->insert("charges", $charge);

        }
    }

    public function get_notifications()
    {   
        $sql= "SELECT * FROM employ";
        return $this->db->query($sql)->result_array();

    }



    public function create_notification($data){

        $notification =array (
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'charge'=>$data['charge'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'date_send'=>date('Y-m-d')
 
         );
 
       return $this->db->insert("employ", $notification);
            
    }

    public function update_publication($data,$id_publication){

        $publication =array (
            'date_from'=>$data['date_from'],
            'date_to'=>$data['date_to'],
            'state'=>true,
         );
       
         $this->db->where("id", $id_publication);
         return $this->db->update("publications", $publication);
        
       
    }
    public function change_state($state){

        $publication =array (
            'state'=>$state,
         );
       
         $this->db->where("id", 1);
         return $this->db->update("publications", $publication);
        
       
    }


    public function state_charge($data){
        $charge = array( 'state'=> $data['state']);
        $this->db->where("id", $data['id']);
        return $this->db->update("charges", $charge);

    }

    

    public function get_publications()
    {   
        $sql= "SELECT * FROM publications";
        return $this->db->query($sql)->result_array();

    }

    public function delete_charge($data){
       
        $sql= "DELETE FROM charges WHERE id=?";
        return $this->db->query($sql,array($data['id']));
    }

}