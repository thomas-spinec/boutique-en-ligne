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

    public function getStock($idProduct, $idSize)
    {

        $idProduct = htmlspecialchars($idProduct);
        $idSize = htmlspecialchars($idSize);

        $request = 'SELECT product_size.stock AS stock
        FROM product_size
        WHERE product_size.id_product = :idProduct AND product_size.id_size = :idSize';

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":idProduct" => $idProduct,
            ":idSize" => $idSize,
        ]);

        $result = $select->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getSize($idProduct)
    {
        $idProduct = htmlspecialchars($idProduct);

        $request = "SELECT product_size.id_product AS id_size_product,
        product_size.id_size, size.id_size, size.size
        FROM $this->tablename
        INNER JOIN product_size
        ON product.id_product=product_size.id_product
        INNER JOIN size
        ON product_size.id_size=size.id_size
        WHERE product.id_product = :idProduct";

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":idProduct" => $idProduct,
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

    public function addProduct($product)
    {
        $title = htmlspecialchars($product["title"]);
        $description = htmlspecialchars($product["description"]);
        $idCategory = htmlspecialchars($product["category"]);
        $size = htmlspecialchars($product["size"]);
        $stock = htmlspecialchars($product["stock"]);
        $priceEuro = htmlspecialchars($product["priceEuro"]);
        $priceCentime = htmlspecialchars($product["priceCentime"]);
        $imgName = htmlspecialchars($product["imgName"]);

        // change price into centimes
        $realPrice = (int)$priceEuro * 100 + $priceCentime;
        //Insertion of the product
        $request1 = "INSERT INTO $this->tablename (title, description, image, price) VALUES (:title, :description, :image, :price)";
        $insert = $this->bdd->prepare($request1);
        $insert->execute([
            ":title" => $title,
            ":description" => $description,
            ":image" => $imgName,
            ":price" => $realPrice,
        ]);
        //Get the id of the product we've just inserted
        $lastId = $this->bdd->lastInsertId();


        //Link the product with category
        $request2 = "INSERT INTO link_categ (id_product, id_categ) VALUES (:id_product, :id_categ)";
        $insert2 = $this->bdd->prepare($request2);
        $insert2->execute([
            ":id_product" => $lastId,
            ":id_categ" => $idCategory,
        ]);
        //link the product with the first size
        $request3 = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
        $insert3 = $this->bdd->prepare($request3);
        $insert3->execute([
            ":id_product" => $lastId,
            ":id_size" => $size,
            ":stock" => $stock,
        ]);

        // -----------------------------------------------
        // Not required

        //if we have others sizes we link them

        if (isset($product["size2"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size2'],
                ":stock" => $product['stock2'],
            ]);
        }

        if (isset($product["size3"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size3'],
                ":stock" => $product['stock3'],
            ]);
        }
        if (isset($product["size4"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size4'],
                ":stock" => $product['stock4'],
            ]);
        }
        if (isset($product["size5"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size5'],
                ":stock" => $product['stock5'],
            ]);
        }

        if (isset($product["size6"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size6'],
                ":stock" => $product['stock6'],
            ]);
        }

        // img2
        if (isset($product['imgName_1'])) {
            $requestImg = "UPDATE $this->tablename SET `image_1`= :imgName WHERE id_product = :lastId";
            $insertImg = $this->bdd->prepare($requestImg);
            $insertImg->execute([
                ":imgName" => $product['imgName_1'],
                ":lastId" => $lastId,
            ]);
        }

        //img3
        if (isset($product['imgName_2'])) {
            $requestImg = "UPDATE $this->tablename SET `image_2`= :imgName WHERE id_product = :lastId";
            $insertImg = $this->bdd->prepare($requestImg);
            $insertImg->execute([
                ":imgName" => $product['imgName_2'],
                ":lastId" => $lastId,
            ]);
        }



        if ($insert && $insert2 && $insert3) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function addSize()
    {
        // boucle avec une requete pour ajouter une taille et un stock pour chaque produit
        $products = $this->getAll();
        foreach ($products as $cols => $value) {
            $idProduct = $value['id_product'];
            $idProduct2 = $value['id_product'];
            // si le produit a déjà cette taille, on l'update
            $verif = "SELECT * FROM product_size WHERE id_product = :idProduct AND id_size = 4 OR id_product = :idProduct2 AND id_size = 3";
            $select = $this->bdd->prepare($verif);
            $select->execute([
                ":idProduct" => $idProduct,
                ":idProduct2" => $idProduct2,
            ]);
            // on compte le nombre de ligne et s'il y en a une, on update
            $count = $select->rowCount();
            if ($count > 0) {
                $request = "UPDATE product_size SET stock = 20 WHERE id_product = :idProduct AND id_size = 4 OR id_product = :idProduct2 AND id_size = 3";
                $update = $this->bdd->prepare($request);
                $update->execute([
                    ":idProduct" => $idProduct,
                    ":idProduct2" => $idProduct2,
                ]);
                if ($update) {
                    echo "update ok_";
                } else {
                    echo "error";
                }
            } else {
                // sinon on insert
                $request = "INSERT INTO `product_size` (`id_size`, `id_product`, `stock`) VALUES ('4', :idProduct, '20'), ('3', :idProduct2, '20')";
                $insert = $this->bdd->prepare($request);
                $insert->execute([
                    ":idProduct" => $idProduct,
                    ":idProduct2" => $idProduct2,
                ]);

                if ($insert) {
                    echo "ok";
                } else {
                    echo "error";
                }
            }
        }
    }
}
