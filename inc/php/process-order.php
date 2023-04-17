<?php

session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
require_once "../class/Cart.php";
$user = new User();
$product = new Product();
$cart = new Cart();
$id = $user->getUserId();


if(isset($_GET["cart"]))
{
    
    $carts = $cart->getCart($id);
    var_dump($carts);

    foreach ($carts as $order) {
        $id_pro = $order['id_product'];
        $item = $product->getProductInfo($id_pro);
        var_dump($item);
        ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div>
                            <img src="inc/img/shop/<?= $item['image']?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                            <h5><?= $item['title']?></h5>
                            <p>Size: M</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                            <div class="form-outline">
                                <input id="form1" min="0" name="quantity" value="<?=$order['quantity']?>" type="number" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div style="width: 80px;">
                            <h5 class="mb-0"><?=$item['price']*$order['quantity']?>€</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

if(isset($_GET["addToCart"])){

    // $id_product = $_POST["id"];
    // $quantity = $_POST["quantity"];
    // $size = $post["size"];
    $id_product = 44;
    $quantity = 2;
    $size = "XS";

    $id_order=$cart->cartVerify($id);
    $item = $product->getProductInfo($id_product);
    var_dump($item);
    $total = $item["price"]*$quantity;

    var_dump($total);
    $result= $cart->createDetail($id_order, $id_product, $quantity, $size, $total);
    echo $result;
}





// // Retrieve the JSON order data from the HTTP POST request
// $orderData = json_decode(file_get_contents('php://input'), true);

// // Check if the order data was retrieved successfully
// if (!$orderData) {
//     // Send an error response back to the client
//     header('Content-Type: application/json');
//     http_response_code(400);
//     echo json_encode(['message' => 'Error: could not retrieve order data.']);
//     exit();
// }

// // Process and store the order data in a database
// $query = $db->prepare('INSERT INTO shop_order (order_data) VALUES (:order_data)');

// // Send a success response back to the client
// header('Content-Type: application/json');
// http_response_code(200);
// echo json_encode(['message' => 'Order successfully processed.']);
// exit();

?>