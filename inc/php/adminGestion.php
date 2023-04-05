
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
?>
