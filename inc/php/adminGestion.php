
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


if(isset($_POST['changeRole'])){
    $newRole = $_POST['role'];
    $id = $_POST['id'];
    $user->changeRole($newRole, $id);
}


if(isset($_POST['addProduct'])){

    var_dump($_FILES);
    var_dump($_POST);
$target_dir = "inc/img/shop";
$target_file = $target_dir . basename($_FILES["imageProduct"]["name"]);
$uploadOk = 1;
$imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["imageProduct"]["tmp_name"]);

    if($check !== false){
        $uploadOk=1;
    }
    else{
        echo "is not an image";
        $uploadOk = 0;
    }

    if($_FILES["imageProduct"]["size"] > 500000000){

        echo "Image too big";
        $uploadOk = 0;
    }
    if($imgFileType !== "jpg" && $imgFileType !== "png" && $imgFileType !== "jpeg" && $imgFileType !== "gif"){
    
        echo "Sorry only jpg, png, jpeg, and gif are allowed";
        $uploadOk = 0;
    }
    if($uploadOk == 0){
    
        echo "Sorry upload failed";
    }
    else{
        if(move_uploaded_file($_FILES["imageProduct"]['tmp_name'], $target_file)){
            echo "The file" . htmlspecialchars(basename($_FILES["imageProduct"]["name"])) . "has been uploaded";
            $product->addProduct();
        }else{
            echo "Sorry there was an error";
        }
    }
    }
