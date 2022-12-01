<?php
class ServicesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_services()
    {   
        $sql= "SELECT * FROM services";
        return $this->db->query($sql)->result_array();
    }

    public function delete_service($id)
    {   
        $sql= "DELETE FROM services WHERE id_service = ? " ;
        return $this->db->query($sql,array($id));
    }

    public function create_service($data)
    {   
        
        $service = array( 
        "name" => $data["name"] , 
        "title" => $data["title"], 
        "state"=> true
        );


        try {
          
           $this->db->insert("services", $service);
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


    public function update_service($data)
    {   
        
        $service = array( 
        "name" => $data["name"] , 
        "title" => $data["title"], 
        );


        try {
            $this->db->where("id_service", $data['id']);
           
           return $this->db->update("services", $service);
          
        
         
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


        $data = array( 'url' => $url );
    
        try {
            
            $this->db->where("id_service", $id_image);
            $this->db->update("services", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }


    public function change_state($data){

        $service =array (
            'state'=>$data['state'],
         );
       
         $this->db->where("id_service", $data['id']);
         return $this->db->update("services", $service);
        
       
    }



    


}