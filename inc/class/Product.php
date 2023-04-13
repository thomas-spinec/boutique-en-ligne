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
    
    public function getAllProducts() {
        $query = $this->bdd->prepare("SELECT id_product, title, image, price, promotion FROM $this->tablename");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($results) > 0) { ?>
            <div class="d-flex flex-wrap justify-content-between">
            <?php
            foreach ($results as $result) { 
                $id = $result['id_product'];
                $title = $result['title'];
                $price = $result['price'];
                $image = $result['image']; ?>

                <!-- card -->
                <div class="card shadow col-lg-3 col-md-6 col-sm-12 p-3 justify-content-center">
                    <div class=" position-relative">
                        <h4 class="card-title"><?= $title ?></h4>
                        <img src="inc/img/shop/<?= $image ?>" class="card-img-top" alt="<?= $title ?>">                            
                        <div class="w-100 d-flex px-3 justify-content-between bg-dark position-absolute bottom-0">
                            <!-- love -->
                            <div class="d-flex ">
                                <a href="#" class="my-auto px-2"><i class="fas fa-heart"></i></a>
                                <!-- see -->
                                <a href="#" class="my-auto px-2 pt-1"><i class="fas fa-search"></i></a>
                            </div>
                            <div class="d-flex">
                                <!-- shop -->
                                <a href="product.php?id=<?= $id ?>" class="btn"><i class="fas fa-shopping-cart"> See</i></a>
                                <!-- price -->
                                <p class="card-text text-white my-auto"><?= $price ?>€</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- /card -->
                <?php
            } 
        }  else {
            echo 'No products';
        }
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
    
        echo '<div class="d-flex flex-wrap justify-content-between my-5">';
        if (count($results) > 0) {
            foreach ($results as $result) { ?>
                <div class="card col-lg-3 col-md-6 col-sm-12 p-3">
                    <img src="./inc/img/shop/<?php echo $result['image'] ?>" alt="<?php echo $result['new_collection'] ?>" class="img-fluid">
                    <div class="d-flex justify-content-between">
                        <p class="text-center"> <?php echo $result['title'] ?> </p>
                        <p class="text-center"> <?php echo $result['price'] ?> € </p>
                    </div>
                    <button type="button" class="btn btn-outline-dark "><a class="text-decoration-none text-black" href="./product.php?id=<?php echo $result['id_product'] ?>">SEE MORE</a></button>
                </div>
            <?php }
        } else {
            echo 'Coming soon';
        }
    }

    public function getAllPromotionProducts(){
        $query = $this->bdd->prepare("SELECT id_product, title, image, price, promotion, promotion_percentage 
        FROM $this->tablename
        WHERE promotion_percentage = :promotion_percentage AND promotion = 1 ORDER BY promotion_percentage DESC");
        $query->execute([':promotion_percentage' => 1]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($results) > 0) { ?>
            <div class="d-flex flex-wrap justify-content-between">
            <?php
            foreach ($results as $result) { 
                $id = $result['id_product'];
                $title = $result['title'];
                $image = $result['image']; 
                $price = $result['price'];
                $percentage = $result['promotion_percentage'];
                $newPrice = $price - ($price * $percentage)?>

                <!-- card -->
                <div class="card shadow col-lg-3 col-md-6 col-sm-12 p-3 justify-content-center">
                    <div class=" position-relative">
                        <h4 class="card-title"><?= $title ?></h4>
                        <img src="inc/img/shop/<?= $image ?>" class="card-img-top" alt="<?= $title ?>">                            
                        <div class="w-100 d-flex px-3 justify-content-between bg-dark position-absolute bottom-0">
                            <!-- love -->
                            <div class="d-flex ">
                                <a href="#" class="my-auto px-2"><i class="fas fa-heart"></i></a>
                                <!-- see -->
                                <a href="#" class="my-auto px-2 pt-1"><i class="fas fa-search"></i></a>
                            </div>
                            <div class="d-flex">
                                <!-- shop -->
                                <a href="product.php?id=<?= $id ?>" class="btn"><i class="fas fa-shopping-cart"> See</i></a>
                                <!-- price -->
                                <p class="card-text text-white my-auto"><?= '<p class="text-decoration-line-through">' . $price . '€</style>' . $percentage . '% off' . $newPrice ?> </p>
                            </div>
                        </div>
                    </div>
                </div> <!-- /card -->
                <?php
            } 
        }  else {
            echo 'No promotion products for now, check back soon';
        }
    }

    public function getCategory($id)
    {
        $request = "SELECT * FROM $this WHERE id_category = :id";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ':id' => $id
        ]);
        $result = $select->fetch();
        $this->bdd = null;
        return $result;
    }

    public function getProductsByCategory($id) {
        $request = "SELECT product.id_product, product.title, product.description, product.image, product.price, product.promotion, link_categ.id_product 
        AS id_link_product, link_categ.id_categ, category.id_category, category.name 
        AS category 
        FROM product 
        INNER JOIN link_categ 
        ON product.id_product=link_categ.id_product 
        INNER JOIN category 
        ON link_categ.id_categ=category.id_category
        WHERE category.id_category = :id";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ':id' => $id
        ]);
        $results = $select->fetchAll(PDO::FETCH_ASSOC);
        $this->bdd = null;
            // si il y a des résultats
            if (count($results) > 0) {
                return $results;
            } else {
    
                $results = 'No products in this category';
                return $results;
            }

    }
}
