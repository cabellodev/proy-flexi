<?php
class ProductsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_products()
    {    
        $query = "SELECT p.id, p.name, p.code, p.image_first url, p.price, p.stock, c.name category, s.name supplier, sc.name subCategory, ssc.name subSubCategory 
        FROM product p
        LEFT JOIN supplier s ON p.supplier_id = s.id
        LEFT JOIN category c ON p.category_id = c.id
        LEFT JOIN subcategory sc ON p.subcategory_id = sc.id
        LEFT JOIN subsubcategory ssc ON p.subsubcategory_id = ssc.id";
        return $this->db->query($query)->result_array();
    }

    public function get_product($id)
    {    
        $query = "SELECT p.code, p.name, p.price, p.stock, p.image_first imageP, p.model, p.supplier_id supplier, p.category_id category, p.subcategory_id subcategory, p.subsubcategory_id subsubcategory, p.images, p.description, p.image_first 
        FROM product p
        WHERE p.id = $id";
        return $this->db->query($query)->row_array();
    }

    public function create_product($data)
    {   
        /* Query para saber si ya se encuentra resgistrado */
        $code = $data['code'];
        $query= "SELECT * FROM product  WHERE product.code = ?";
        $result= $this->db->query($query, array($code));
   

        if($result->num_rows() > 0){
            $s = array(
                "id" => null,
                "status" => "repetition"
            );
            return $s;
        }else{
            try {

                $description = '';
                $images = '';
                $stock = '';
                $category = '';
                $subCategory = '';
                $subSubCategory = '';

                if(!$data['description']) $description = null; else $description = json_encode($data['description'], JSON_UNESCAPED_UNICODE);
                if(!$data['images']) $images = null; else $images = $data['images'];
                if(!$data['stock']) $stock = null; else $stock = $data['stock'];
                if(!$data['category']) $category = null; else $category = $data['category'];
                if(!$data['subCategory']) $subCategory = null; else $subCategory = $data['subCategory'];
                if(!$data['subSubCategory']) $subSubCategory = null; else $subSubCategory = $data['subSubCategory'];

               
                $data_product = array(
                    'code' => $data['code'],
                    'name' => strtoupper($data['name']),
                    'stock'=> $stock,
                    'price'=> $data['price'],
                    'model'=> $data['model'],
                    'supplier_id' => $data['supplier'],
                    'description' => $description,
                    'images' => $images,
                    'category_id' => $category,
                    'subcategory_id ' => $subCategory,
                    'subsubcategory_id' => $subSubCategory,
                    'state' => '1',
                    'image_first' => "dsadsa"
                );

                      
                /* $sql = $this->db->set($data_product)->get_compiled_insert('product'); */
                $this->db->insert("product", $data_product);
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
    }

    public function update_product($data)
    {   
        /* Query para saber si ya se encuentra resgistrado */
        $code = $data['code'];
        $currentCode = $data['currentCode'];
        $query= "SELECT * FROM product  WHERE (product.code = ? AND product.code != ?)";
        $result= $this->db->query($query, array($code, $currentCode));
   
        if($result->num_rows() > 0){
            $s = array(
                "id" => null,
                "status" => "repetition"
            );
            return $s;
        }else{
            try {

                $description = '';
                $stock = '';
                $category = '';
                $subCategory = '';
                $subSubCategory = '';

                if(!$data['description']) $description = null; else $description = json_encode($data['description'], JSON_UNESCAPED_UNICODE);
                if(!$data['stock']) $stock = null; else $stock = $data['stock'];
                if(!$data['category']) $category = null; else $category = $data['category'];
                if(!$data['subCategory']) $subCategory = null; else $subCategory = $data['subCategory'];
                if(!$data['subSubCategory']) $subSubCategory = null; else $subSubCategory = $data['subSubCategory'];

               
                $data_product = array(
                    'code' => $data['code'],
                    'name' => strtoupper($data['name']),
                    'stock'=> $stock,
                    'model'=> $data['model'],
                    'price'=> $data['price'],
                    'supplier_id' => $data['supplier'],
                    'description' => $description,
                    'category_id' => $category,
                    'subcategory_id ' => $subCategory,
                    'subsubcategory_id' => $subSubCategory,
                ); 

                $this->db->where('id', $data['id']);
                $this->db->update('product', $data_product);

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

    public function up_imageP($id_product, $image)
    {  
        $data = array(
            'image_first' => $image
        );
    
        try {
            
            $this->db->where("id", $id_product);
            $this->db->update("product", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }

    public function update_up_imageP($id_product, $image)
    {  
        $data = array(
            'image_first' => $image
        );
    
        try {  

            $query = "SELECT p.image_first
            FROM product p
            WHERE p.id = $id_product";
            $result = $this->db->query($query)->row_array();

            unlink("./assets/images/products/image_first/".$result['image_first']);

            $this->db->where("id", $id_product);
            $this->db->update("product", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }

    public function up_images($id_product, $images)
    {  
        $data = array(
            'images' => json_encode($images), 
        );
    
        try {
            
            $this->db->where("id", $id_product);
            $this->db->update("product", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }

    public function update_up_images($id_product, $images)
    {  
        $data = array(
            'images' => json_encode($images), 
        );
    
        try {
            $this->db->where("id", $id_product);
            $this->db->update("product", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }

    public function delete_product($id_product)
    {   

        /* Obtener la row a eliminar, para eliminar en cascada sus imagenes */
        $query = "SELECT * FROM product p WHERE p.id = $id_product";
        $result = $this->db->query($query)->row_array();
        $images = json_decode($result['images'], true);


        $sql_delete= "DELETE FROM product WHERE id = ? " ;
        if($this->db->query($sql_delete,array($id_product))){

            /* Eliminar la imagen principal */
            $image_first = $result['image_first']; 
            unlink("./assets/images/products/image_first/".$image_first);

            /*Eliminar las imagenes asociadas */
            $cont = 1;
            foreach ($images as $value) {
                $url = $value['imagen'.$cont];
                if($url){
                    unlink("./assets/images/products/".$url);
                }
                $cont = $cont + 1;
            }

            $s = array("status" => "success");
            return $s;

        }else{
            $s = array("status" => "fail");
            return $s;
        }

    }



    public function get_supplier()
    {   
        $sql= "SELECT * FROM supplier WHERE supplier.state =1";
        return $this->db->query($sql)->result_array();
    }

    public function get_category()
    {   
        $sql= "SELECT * FROM category WHERE category.state =1";
        return $this->db->query($sql)->result_array();
    }

    public function get_sub_category()
    {       
        $query= "SELECT * FROM subcategory WHERE subcategory.state =1";
        return $this->db->query($query)->result_array();
    }

    
    public function get_sub_sub_category()
    {       
        $query= "SELECT * FROM subsubcategory WHERE subsubcategory.state =1";
        return $this->db->query($query)->result_array();
    }


}
