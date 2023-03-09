<?php
class NewsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_news()
    {   
        $sql= "SELECT * FROM news";
        return $this->db->query($sql)->result_array();
    }

    
    public function create_new($data)
    {   

        $new = array( 
            'title'=> $data["title"],
            'date' => date("Y-m-d"),
            'description' => $data["description"],
            'date_expiration'=> $data["date_to"],
        );

      
        
        try {
          
         $this->db->insert("news", $new);
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


    public function update_new($data)
    {   

        $new = array( 
            'title'=> $data["title"],
            'description' => $data["description"],
            'date_expiration' => $data['date_to'],
        );
        try {
            $this->db->where("id", $data['id']);
            return $this->db->update("news", $new);
         
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
            $this->db->update("news", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
        }


        public function delete_new($data)
        {  
            $sql= "DELETE FROM news WHERE id = ? ";
             return $this->db->query($sql, array($data['id']));
        }

        public function changeState ($data){
                
            $state = array(
                'state' => $data['state'],

            );
            
            try {
            $this->db->where("id", $data['id']);
            return $this->db->update("news", $data);
            }catch (Exception $e) {
                return false;
            }

        }




}