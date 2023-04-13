<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            
    <?php include 'inc/header.php'; ?>

        
    <section class="hero">
        <!-- <video class="w-100" autoplay loop muted>
            <source src="inc/img/design/shop.mp4" type="video/mp4" />
            <span class="slogan">Veni, vedi,</span>
            <h1>Vetix</h1>
        </video> -->

        <div class="slogan">Veni, vedi,</div>
        <img class="logo_big" src="inc/img/design/logo_wt.png" alt="logo">
<a href="./shop.php"><button class="btn btn-light my-5 d-flex justify-items-center">SHOP NOW</button></a>

    </section>
        
    <main>
        <div class="container my-5">
            <!-- NEW COLLECTION -->
            <h1>New Collection</h1>
            <h1 class="bis">New Collection</h1>
            <?php
            $product = new Product();
            $products = $product->getRandomNewCollection(4); ?>
            <a class="mx-auto " href="shop.php?display=newCollection"><button class="btn btn-dark my-5 d-flex justify-items-center ">SEE ALL</button></a>
        </div>

        <div class="photo w-100 d-flex my-5 pt-5"> 
            <span class="text-body-tertiary fs-3 lh-5 col-lg-6 align-content-center my-auto text-center">SPRING <br>COLLECTION</span>
        </div>
    
        <!-- BEST SALES -->
        <section class="bg-light my-5 py-5">
            <h1>Best Sales</h1>
            <h1 class="ter">Best Sales</h1>
            <?php $product->getRandomBestSellers(4); ?>
        </section>
    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>