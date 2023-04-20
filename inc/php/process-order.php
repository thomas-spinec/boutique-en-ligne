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

    // $displaTitle = $product->getProductInfo($displayCart[0]["id_product"]);
    $carts = $cart->getCart($id);
    $count = count($carts);

    ?>

    <h5 class="mb-3"><a href="#!" class="text-body"><i
                                        class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
    <hr>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="mb-1">Shopping cart</p>
            <p class="mb-0">You have <?= $count ?> different items in your cart</p>
        </div>
    </div>
<?php
    if (empty($carts)){
        die();
    }
    foreach ($carts as $order ) {
        $id_pro = $order['id_product'];
        $item = $product->getProductInfo($id_pro);
        $size = $order["size"];      
        $id_order = $cart->cartVerify($id);
  
        ?>
        <div class="card mb-3">
            <div class="card-body shadow p-3 bg-white rounded">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div>
                            <img src="inc/img/shop/<?=$item['image']?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3" id="article">
                            <h5><?= $item['title']?></h5>
                            <p>Prix unitaire: <?=$item['price']?></p>
                            <p>Size: <?= $size?></p>
                            <?php
                            ?>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                            <div class="form-outline">
                                <input id="form1" min="1" name="quantity" value="<?=$order['quantity']?>" type="number" class="quantity form-control" data-id="<?=$id_pro?>" data-size="<?= $size?>" data-order="<?= $id_order?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div style="width: 80px;">
                            <h5 class="mb-0"><?=$item['price']*$order['quantity']?>€</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt" data-id="<?=$id_pro?>" data-size="<?= $size?>" data-order="<?= $id_order?>" id="delProduct" ></i></a>
                    </div>
                </div>
            </div>
        </div>
        
    <?php
    }
}

if(isset($_GET["pay"]))
{
    $id = $user->getUserId();
    $total = $cart->getCart($id);
?>
    <div class="card bg-dark text-white rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Card details</h5>
                <h6>User</h6>
            </div>

            <p class="small mb-2">Card type</p>
            <a href="#!" type="submit" class="text-white"><i
                class="fab fa-cc-mastercard fa-2x me-2"></i></a>
            <a href="#!" type="submit" class="text-white"><i
                class="fab fa-cc-visa fa-2x me-2"></i></a>
            <a href="#!" type="submit" class="text-white"><i
                class="fab fa-cc-amex fa-2x me-2"></i></a>
            <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

            <form class="mt-4">
                <div class="form-outline form-white mb-4">
                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                    placeholder="Cardholder's Name" />
                    <label class="form-label" for="typeName">Cardholder's Name</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                    placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                    <label class="form-label" for="typeText">Card Number</label>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                            placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg"
                                placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                        </div>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
                <p class="mb-2">Subtotal</p>
                <p class="mb-2"><?= $total[0]['total']?>€</p>
            </div>

            <div class="d-flex justify-content-between">
                <p class="mb-2">Shipping</p>
                <p class="mb-2">00.00€</p>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <p class="mb-2">Total(Incl. taxes)</p>
                <p class="mb-2"><?= $total[0]['total']?>€</p>
            </div>

            <button type="button" class="btn btn-info btn-block btn-lg">
                <div class="d-flex justify-content-between">
                    <span><?= $total[0]['total']?>€ </span>
                    <span>&nbsp; Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                </div>
            </button>
        </div>
    </div>
<?php
}

if(isset($_POST["addToCart"])){

    $id_product = $_POST["id"];
    $quantity = $_POST["quantity"];
    $size = $_POST["size"];

    $id_order = $cart->cartVerify($id);
    $item = $product->getProductInfo($id_product);

    $total = $item["price"]*$quantity;


    $result = $cart->createDetail($id_order, $id_product, $quantity, $size, $total);
    if($result === "ok"){
        $cart->updateTotal($id_order);
    } ;
}

if(isset($_POST["delFromCart"])){

    $id_product = $_POST["id"];
    $size = $_POST["size"];
    $id_order = $_POST["id_order"];

    $result = $cart->deleteProduct($id_product, $id_order, $size);
    if ($result === "ok"){
        $cart->updateTotal($id_order);
    }

}

if(isset($_POST["updateProduct"])){

    $id_product = $_POST["id"];
    $size_product = $_POST["size"];
    $id_order = $_POST["id_order"];
    $quantity = $_POST["quantity"];

    $item = $product->getProductInfo($id_product);
    $total = $item["price"]*$quantity;


    $result = $cart->updateQuantity($id_product, $size_product, $id_order, $quantity, $total);

    if ($result === "ok"){
        $cart->updateTotal($id_order);
    }

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