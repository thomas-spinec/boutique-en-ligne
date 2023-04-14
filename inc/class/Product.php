<?php
require_once "Model.php";
class Product extends Model{
    protected $bdd;
    protected $tablename = "product";
    
    public function __construct()
    {
            parent::__construct();
    }

    public function getAll($categ = null)
    {
        $request = "SELECT product.id_product, product.title, product.description, product.image, product.image_1, product.image_2, product.price, product.promotion, product.promotion_percentage, link_categ.id_categ, category.id_category, category.name 
        AS category
        FROM $this->tablename 
        INNER JOIN link_categ 
        ON product.id_product=link_categ.id_product 
        INNER JOIN category 
        ON link_categ.id_categ=category.id_category";

            if ($categ != null) {
            $categ = htmlspecialchars($categ);
            $request = $request . " WHERE category.id_category=$categ";
        }


        $select = $this->bdd->prepare($request);

        $select->execute();

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return $result;
        } else {
            $result = "Nothing to show here !";
            return $result;
        }

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
    
    public function updateProduct($id, $title, $description, $image, $price, $sales, $categ) {
        $query = $this->bdd->prepare("UPDATE $this->tablename SET title = :title, description = :description, image = :image, price = :price, sales = :sales WHERE id_product = :id");
        $query->execute([':id' => $id, ':title' => $title, ':description' => $description, ':image' => $image, ':price' => $price, ':sales' => $sales]);
        $query = $this->bdd->prepare("UPDATE link_categ SET id_categ = :categ WHERE id_product = :id");
        $query->execute([':id' => $id, ':categ' => $categ]);
    }

    public function getCategoryName($id) {
        $query = $this->bdd->prepare("SELECT name FROM category INNER JOIN link_categ ON category.id_category = link_categ.id_categ WHERE link_categ.id_product = :id");
        $query->execute([':id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['name'];
        } else {
            return 'not ok';
        }
    }

    public function getProductImages($id) {
        $query = $this->bdd->prepare("SELECT image, image_1, image_2 FROM product WHERE id_product = :id ORDER BY image ASC");
        $query->execute([':id' => $id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRandomBestSellers($limit) {
        $query = $this->bdd->prepare("SELECT id_product, title, image, price, best_sellers 
        FROM $this->tablename 
        WHERE best_sellers = 1
        ORDER BY RAND() 
        LIMIT " . intval($limit));
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        // si il y a des résultats
        if (count($results) > 0) {
            return $results;
        } else {

            $results = 'No best sellers';
            return $results;
        }
    }

    public function getRandomNewCollection($limit) {
        $query = $this->bdd->prepare("SELECT id_product, title, image, price, new_collection 
        FROM $this->tablename
        WHERE new_collection = 1
        ORDER BY RAND() 
        LIMIT " . intval($limit));
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($results) > 0) {
            return $results;
        } else {

            $results = 'Coming soon';
            return $results;
        }
    }

    public function getCategory($id) {
        $request = "SELECT * FROM $this WHERE id_category = :id";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ':id' => $id
        ]);
        $result = $select->fetch();
        $this->bdd = null;
        return $result;
    }
}
