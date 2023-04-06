
<?php
session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
$user = new User();
$product = new Product();


if(isset($_GET['delUser'])){
    $id = $_GET['delUser'];
    
    $user->deleteOne($id);

}

if(isset($_GET['delProduct'])){
    $idProduct = $_GET['delProduct'];

    $product->deleteProduct($idProduct);

}


if(isset($_GET['delCategory'])){
    $idCategory = $_GET['delCategory'];
    $product->deleteCategory($idCategory);
}


if(isset($_POST['changeDroit'])){
    $newRole = $_POST['changeDroit'];
    $user->changeRole($newRole);
}
?>
