
<?php
session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
$user = new User();
$product = new Product();


if (isset($_GET['delUser'])) {
    $id = $_GET['delUser'];

    $user->deleteOne($id);
}

if (isset($_GET['delProduct'])) {
    $idProduct = $_GET['delProduct'];

    $product->deleteProduct($idProduct);
}


if (isset($_GET['delCategory'])) {
    $idCategory = $_GET['delCategory'];
    $product->deleteCategory($idCategory);
}


if (isset($_POST['changeRole'])) {
    $newRole = $_POST['role'];
    $id = $_POST['id'];
    $user->changeRole($newRole, $id);
}


if (isset($_POST['addProduct'])) {

    var_dump($_POST);
    var_dump($_FILES);

    // form's variables
    $title = $_POST['title'];
    $descritpion = $_POST['description'];
    $idCategory = $_POST['category'];
    $sizeProduct = $_POST['size'];
    $stock = $_POST['stock'];
    $priceEuro = $_POST['priceEuro'];
    $priceCentime = $_POST['priceCentime'];
    $imgName = $_FILES["imageProduct"]["name"];
    if (isset($title) && isset($description) && isset($idCategory) && isset($size) && isset($stock) && isset($priceEuro) && isset($priceCentime) && isset($imgName));


    $target_dir = "../img/shop/";
    $fileName = $_FILES["imageProduct"]["name"];
    // $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    var_dump($fileName);
    var_dump(__DIR__);

    $type = $_FILES["imageProduct"]["type"];
    $size = $_FILES["imageProduct"]["size"];

    $allowedType = [
        'image/jpeg',
        'image/jpg',
        'image/png'
    ];

    if (in_array($type, $allowedType) && $size > 300000) {

        echo "Image too big or type image not allowed";
    } else {
        if (move_uploaded_file($_FILES["imageProduct"]['tmp_name'], $target_dir . $fileName)) {
            echo "The file" . htmlspecialchars(basename($_FILES["imageProduct"]["name"])) . "has been uploaded";
            $product->addProduct($title, $descritpion, $idCategory, $sizeProduct, $stock, $priceEuro, $priceCentime, $imgName);
        } else {
            echo "Sorry there was an error";
        }
    }
}

if (isset($_GET["getStock"])) {
    $idProduct = $_GET['idProduct'];
    $idSize = $_GET['idSize'];
    $stock = $product->getStock($idProduct, $idSize);
    echo json_encode($stock);
}
