<?php
require_once "Model.php";
class Wishlist extends Model{
    protected $bdd;
    protected $tablename = "wishlist";
    
    public function __construct()
    {
            parent::__construct();
    }

    public function addProduct($user_id, $product_id)
    {
        $user_id = htmlspecialchars($user_id);
        $product_id = htmlspecialchars($product_id);

        $request = "INSERT INTO $this->tablename (id_user, id_product) VALUES (:id_user, :id_product)";
        $select = $this->bdd->prepare($request);
        $select->execute([':id_user' => $user_id, ':id_product' => $product_id]);

        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return $result;
        } else {
            $result = "Your wishlist is empty !";
            return $result;
        }

    }
}