<?php
require_once "Model.php";
class Product extends Model{
    protected $bdd;
    protected $tablename = "product";
    
    public function __construct()
    {
            parent::__construct();
    }

    public function getAll($categ=null)
    {
        $request = "SELECT product.id_product, product.title, product.description, product.image, product.price, product.sales, link_categ.id_product 
        AS id_link_product, link_categ.id_categ, category.id_category, category.name 
        AS category 
        FROM $this->tablename 
        INNER JOIN link_categ 
        ON product.id_product=link_categ.id_product 
        INNER JOIN category 
        ON link_categ.id_categ=category.id_category";

        if ($categ!=null){
            $categ=htmlspecialchars($categ);
            $request = $request . " WHERE category.id_category=$categ";
        }

        $select = $this->bdd->prepare($request);

        $select->execute();

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getInfo($table)
    {   
        $table = htmlspecialchars($table);
        $this->tablename = $table;
        $result = parent::getAll();
        $this->tablename = "product";
        return $result;

    }

    public function deleteProduct($id){

        echo parent::deleteProduct($id);
    }

    public function completion() {

        $get = $this->bdd->prepare("SELECT id_product, title FROM $this->tablename");
        $get->execute();
        $result = $get->fetchAll(PDO::FETCH_ASSOC);
        // JSON encode
        $myJSON = json_encode($result);

        echo $myJSON;
    }

    public function searchProducts($search) {
        $search = htmlspecialchars($search) . "%";
    
        $query = $this->bdd->prepare("SELECT id_product, title FROM product WHERE title LIKE :search LIMIT 0,20;");
        $query->execute([':search' => $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        // return the search results
        return $result;
    }

    public function getProductInfo($id) {
        $query = $this->bdd->prepare("SELECT * FROM $this->tablename WHERE id_product = :id");
        $query->execute([':id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
}   

?>