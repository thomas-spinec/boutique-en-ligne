<?php

use User;

session_start();
require_once '../class/User.php';
require_once '../class/Product.php';
require_once "../class/Comment.php";
$user = new User();
$product = new Product();
$comment = new Comment();


if ($user->isLogged()) {
    $id_user = $user->getUserId();
} else {
    // if user not connected, display an error message or redirect to a login page
    header('Location: ./authentification.php?choice=login');
}

    if (isset($_POST['submit']) && $_POST['submit']=='SEND') {

        // Get the data from the form
        $subject = $_POST['subject'];
        $comment = $_POST['comment'];
        $id_product = $_POST['id_product'];
        // Insert the comment into the database
        $comment = $comment->addComment($subject, $comment, $id_product, $id_user);
        // Redirect user to the article page
        header('Location: ./product.php?id=' . $id_product);
        exit();
    }
?>