<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/menu.js"></script>
</head>
<body>        
    <?php include 'inc/header.php'; ?>

    <main>
        <h1>Shop</h1>
        <h1 class="bis">Shop</h1>

        <div id="product_container" class="container d-flex flex-wrap">
            <?php
            $displayMode = 'allProducts'; // Default display mode
            
            if (isset($_GET['display'])) {
                $displayMode = $_GET['display'];
            }
            
            switch ($displayMode) {
                case 'bestSales':
                    $products = $product->getRandomBestSales();
                    break;
                case 'newCollection':
                    $products = $product->getRandomNewCollection();
                    break;
                default:
                    $products = $product->getAllProducts();
            }
            ?>
        </div>


    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>