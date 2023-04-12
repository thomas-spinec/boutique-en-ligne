<?php
require_once "Model.php";
class Product extends Model
{
    protected $bdd;
    protected $tablename = "product";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($categ = null)
    {
        $request = "SELECT product.id_product, product.title, product.description, product.image, product.price, product.sales, link_categ.id_product 
        AS id_link_product, link_categ.id_categ, category.id_category, category.name 
        AS category, 
        product_size.id_product AS id_size_product,
        product_size.id_size, size.id_size, size.size,
        FROM $this->tablename 
        INNER JOIN link_categ 
        ON product.id_product=link_categ.id_product 
        INNER JOIN category 
        ON link_categ.id_categ=category.id_category
        INNER JOIN product_size
        ON product.id_product=product_size.id_product
        INNER JOIN size
        ON product_size.id_size=size.id_size
        ORDER BY product.id_product";

        if ($categ != null) {
            $categ = htmlspecialchars($categ);
            $request = $request . " WHERE category.id_category=$categ";
        }
        

        $select = $this->bdd->prepare($request);

        $select->execute();

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getStock($idProduct, $idSize){

        $idProduct = htmlspecialchars($idProduct);
        $idSize = htmlspecialchars($idSize);

        $request = 'SELECT product_size.stock AS stock
        FROM product_size
        INNER JOIN $this->tablename
        ON product.id_product=product_size.id_product
        INNER JOIN size
        ON product_size.id_size=size.id_size
        WHERE product.id_product = :idProduct AND product_size.id_size = :idSize';
        
        $select = $this->bdd->prepare($request);

        $select->execute([
            ":idProduct" => $idProduct,
            ":idSize" => $idSize,
        ]);

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

    public function deleteProduct($idProduct)
    {
        $idProduct = htmlspecialchars($idProduct);

        $request = "DELETE FROM $this->tablename WHERE id_product = :id ";

        $delete = $this->bdd->prepare($request);

        $delete->execute([
            ":id" => $idProduct,
        ]);

        if ($delete) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function deleteCategory($idCategory)
    {
        $idCategory = htmlspecialchars($idCategory);

        $request = "DELETE FROM category WHERE id_category = :id ";

        $delete = $this->bdd->prepare($request);

        $delete->execute([
            ":id" => $idCategory,
        ]);

        if ($delete) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function completion()
    {

        $get = $this->bdd->prepare("SELECT id_product, title FROM $this->tablename");
        $get->execute();
        $result = $get->fetchAll(PDO::FETCH_ASSOC);
        // JSON encode
        $myJSON = json_encode($result);

        echo $myJSON;
    }

    public function searchProducts($search)
    {
        $search = htmlspecialchars($search) . "%";

        $query = $this->bdd->prepare("SELECT id_product, title FROM product WHERE title LIKE :search LIMIT 0,20;");
        $query->execute([':search' => $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // return the search results
        return $result;
    }

    public function getProductInfo($id)
    {
        $query = $this->bdd->prepare("SELECT * FROM $this->tablename WHERE id_product = :id");
        $query->execute([':id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addProduct($title, $description, $idCategory, $size, $stock, $priceEuro, $priceCentime, $imgName)
    {

        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $idCategory = htmlspecialchars($idCategory);
        $size = htmlspecialchars($size);
        $stock = htmlspecialchars($stock);
        $priceEuro = htmlspecialchars($priceEuro);
        $priceCentime = htmlspecialchars($priceCentime);
        $imgName = htmlspecialchars($imgName);

        // change price into centimes
        $realPrice = (int)$priceEuro * 100 + $priceCentime;

        $request1 = "INSERT INTO $this->tablename (title, description, image, price) VALUES (:title, :description, :image, :price)";
        $insert = $this->bdd->prepare($request1);
        $insert->execute([
            ":title" => $title,
            ":description" => $description,
            ":image" => $imgName,
            ":price" => $realPrice,
        ]);

        $lastId = $this->bdd->lastInsertId();

        $request2 = "INSERT INTO link_categ (id_product, id_categ) VALUES (:id_product, :id_categ)";
        $insert2 = $this->bdd->prepare($request2);
        $insert2->execute([
            ":id_product" => $lastId,
            ":id_categ" => $idCategory,
        ]);

        $request3 = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
        $insert3 = $this->bdd->prepare($request3);
        $insert3->execute([
            ":id_product" => $lastId,
            ":id_size" => $size,
            ":stock" => $stock,
        ]);

        if ($insert && $insert2 && $insert3) {
            echo "ok";
        } else {
            echo "error";
        }
    }

}
