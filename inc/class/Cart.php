<?php
require_once "Model.php";
class Cart extends Model{

    protected $bdd;

    protected $tablename = "shop_order";

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getCart($id)
    {
        $id = htmlspecialchars($id);
        $request = "SELECT $this->tablename.total,
        date, state,
        detail.id_product, detail.total AS total_product, detail.quantity
        FROM $this->tablename
        INNER JOIN detail ON detail.id_order = shop_order.id_order 
        WHERE $this->tablename.id_user = :id_user";

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":id_user"=>$id
        ]);

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return $result;
        } else {
            $result = "Nothing to show here !";
            return $result;
        }
    }

    public function cartVerify($id){

        $id = htmlspecialchars($id);

        $request = "SELECT id_order FROM $this->tablename WHERE id_user=:id AND state='cart'";

        $select = $this->bdd->prepare($request);
        $select->execute([
            ":id"=>$id
        ]);

        $result = $select->fetch(PDO::FETCH_ASSOC);
        
        if($result){
            return $result['id_order'];
        }
        else{
            $request2 = "INSERT INTO $this->tablename (date, id_user, state) VALUES (NOW(), :id_user, 'cart')";
            $insert = $this->bdd->prepare($request2);
            $insert->execute([
                ":id_user"=>$id
            ]);

            if($insert){
                return $this->bdd->lastInsertId();
            }
            else{
                echo "error";
            }
        }
    }
    public function createDetail($id_order, $id_product,  $quantity, $size, $total){

        $id_order = htmlspecialchars($id_order);
        $id_product = htmlspecialchars($id_product);
        $quantity = htmlspecialchars($quantity);
        $size = htmlspecialchars($size);
        $total = htmlspecialchars($total);

        $request = "SELECT * FROM detail WHERE id_order = :id_order AND id_product = :id_product";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ":id_order"=>$id_order,
            ":id_product"=>$id_product
        ]);
        $result = $select->fetch(PDO::FETCH_ASSOC);
        if($result){

            $quantity = $quantity + $result["quantity"];
            $total = $total + $result['total'];

            $request2 = "UPDATE detail SET total=:total, quantity=:quantity WHERE id_order = :id_order AND id_product = :id_product";
            $update = $this->bdd->prepare($request2);
            $update->execute([
                ":total"=>$total,
                ":quantity"=>$quantity,
                ":id_order"=>$id_order,
                "id_product"=>$id_product
            ]);
            if($update){
                return "ok";
            }
            else{
                return "error update cart";
            }
        }
        else{
            $request2 = "INSERT INTO detail (id_order, id_product, total, quantity, size) VALUES (:id_order, :id_product, :total, :quantity, :size)";

            $insert = $this->bdd->prepare($request2);
            $insert->execute([
                ":id_order"=>$id_order,
                ":id_product"=>$id_product,
                ":total"=>$total,
                ":quantity"=>$quantity,
                ":size"=>$size
            ]);
            
            if($insert){
                return "ok";

            }
            else{
                return "error insert cart";
            }
        }

        


    }


















}
