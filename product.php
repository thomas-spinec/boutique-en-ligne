<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">    
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script type="text/javascript" src="inc/js/search.js"></script>

</head>
<body>

    <div class="wrapper">
        
        <?php include 'inc/header.php'; ?>

        <main class="container px-5 px-lg-5 mx-5 my-5">
            <?php
            $id = $_GET['id'];
            $product_info = $product->getProductInfo($id);
            ?>

            <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="product_img" src="inc/img/shop/<?= $product_info['image'] ?>" alt="<?= $product_info['title'] ?> ">
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h2 class="display-5 fw-bolder"><?php echo $product_info['title'] ?></h2>
                        <div class="fs-5 mb-5">
                            <p class="lead"><?php echo $product_info['description'] ?></p>
                            <p><?php echo $product_info['price']; ?>€</p>
                    </div>
            </div>

        </main>
        
        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>