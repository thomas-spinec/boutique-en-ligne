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

    <main class="mt-0">

        <section class="shop_header">
            <p class="w-100 d-flex big m-0">SHOP</p>
        </section>

        <section class="deg w-100 mx-0">
            <div class="row grid mx-0 justify-content-between">
                <div class="g-col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="btn btn-default square-button">
                    <div class="square-button-content">
                        <h4>New Collection</h4>
                        <img src="inc/img/icons/new.png">
                    </div>
                    </div>
                </div>
                <div class="g-col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="btn btn-default square-button">
                    <div class="square-button-content">
                        <h4>Accessory</h4><br>
                        <img src="inc/img/icons/accessory.png">
                    </div>
                    </div>
                </div>
                <div class="g-col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="btn btn-default square-button">
                    <div class="square-button-content">
                        <h4>Best Sales</h4><br>
                        <img src="inc/img/icons/bestsales.png">
                    </div>
                    </div>
                </div>
                <div class="g-col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="btn btn-default square-button">
                    <div class="square-button-content">
                        <h4>Clearance</h4><br>
                        <img src="inc/img/icons/sales.png">
                    </div>
                    </div>
                </div>
                <div class="g-col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="btn btn-default square-button">
                    <div class="square-button-content">
                        <h4>Underwear</h4><br>
                        <img src="inc/img/icons/underwear.png">
                    </div>
                    </div>
                </div>
            </div>
        </section>


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