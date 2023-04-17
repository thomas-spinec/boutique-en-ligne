<?php

require_once 'class/Wishlist.php';

$user = new User();
$wishlist = new Wishlist();

if ($user->isLogged()) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $wishlist->addProduct($user_id, $product_id);
} else {
    header('Location: login.php');
    exit();
}
?>