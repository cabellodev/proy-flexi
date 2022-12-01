<?php


class GalleryModel extends CI_Model
{

    
    public function __construct()
    {
            parent::__construct();
    }

    //traer imagenes por id 
    public function getGallery($id_service)
    {
        $sql = "SELECT * FROM gallery_service WHERE id_service =?"  ;
        return $this->db->query($sql, array($id_service))->result_array();
    
    }

   //subir imagenes
    public function create_image($data)
    {   

        $data = array( 
            "name" => $data["name"],
            "id_service" => $data["id_service"],    
        );
        try {
          
            $this->db->insert("gallery_service", $data);
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


    public function up_image($id_image, $url)
    {  
        $data = array(
            'url' => $url, 
        );
    
        try {
            
            $this->db->where("id", $id_image);
            $this->db->update("gallery_service", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }
    

    public function edit_imagen($data)
    {
        
        $name= array(
            "name" => $data["name"],
        );

        try {   
         
            $this->db->where('id', $data['id']);
            $this->db->update("gallery_service", $name);

            $s = array(
                "id" => $data['id'],
                "status" => "success",
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


    public function edit_description($data){
        $update = array(
            "description" => $data["description"],
        );
        try {

            $this->db->where('id_service', $data['id_service']);
            return  $this->db->update("services", $update);
        
        } catch (Exception $e) {
            $s = array(
                "status" => "fail"
            );
            return $s;
        }

    }


    public function insert_image($id, $image) // esta funcion es para el guardado multiple
    {   
        $data =array (
           'name'=>'---',
           'url'=>$image,
           'id_service'=>$id

        );

        try {
            
            $this->db->insert("gallery_service", $data);
            $id = $this->db->insert_id();
            return $s ="success";
            
        } catch (Exception $e) {
            $s = array(
                "id" => null,
                "status" => "fail"
            );
            return $s;
        }
    }

  
       
    public function delete_image($id)
    {
        $sql = "DELETE 
                FROM gallery_service
                WHERE id= ?";
        return $this->db->query($sql, array($id));

     
    }
    

}


