<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- JQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script type="text/javascript" src="inc/js/search.js"></script>
    <script type="text/javascript" src="inc/js/menu.js"></script>

    <script>
        // jQuery : change logo on scroll
        $(window).scroll(function() {
            if ($(this).scrollTop() > 60) { 
                $('#logo').attr('src','inc/img/design/logo_icon.png'); 
            } else {
                $('#logo').attr('src','inc/img/design/logo_bk.png'); 
            }
        });

        // jQuery : see first menu on scroll up
        var prevScrollpos = window.pageYOffset;
        $(window).scroll(function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            $('.sticky-top').addClass('active');
        } else {
            $('.sticky-top').removeClass('active');
        }
        prevScrollpos = currentScrollPos;
        });
    </script>

</head>
<body>
            
    <?php include 'inc/header.php'; ?>

    <section class="hero">
        <div class="slogan">Veni, vedi,</div>
        <img class="logo_big" src="inc/img/design/logo_wt.png" alt="logo">
        <a href="./shop.php"><button class="btn btn-white fw-bold my-5 d-flex justify-items-center">SHOP NOW</button></a>
    </section>
        
    <main>

        <section class="container my-5">
            <!-- NEW COLLECTION -->
            <h1>New Collection</h1>
            <h1 class="bis">New Collection</h1>
            <div class="d-flex flex-wrap justify-content-center">
                <?php 
                $product = new Product();
                $products = $product->getRandomNewCollection(4);
                foreach ($products as $result) :
                    $id = $result['id_product'];
                    $title = $result['title'];
                    $price = $result['price'];
                    $image = $result['image'];
                    $image1 = $result['image_1'];
                    $image2 = $result['image_2'];
                    $promotion = $result['promotion'];
                    $percentage = $result['promotion_percentage'];
                    $newPrice = $price - ($price * $percentage / 100);
                    ?>
    
                    <!-- card -->
                    <div class="card shadow col-lg-3 col-md-6 col-sm-12 p-3 justify-content-center">
                        <div class="position-relative mb-5">
                            <h4 class="card-title"><?= $title ?></h4>
                            <?php $images = [$image, $image1, $image2]; ?>
                            <?php foreach ($images as $index => $image) : ?>
                                <?php if (!empty($image) && $index === 0) : ?>
                                    <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>">
                                    <img src="./inc/img/shop/<?= $image ?>" alt="<?= $title ?>" class="img-fluid">
                                    </a>
                                <?php elseif (!empty($image) && $index !== 0) : ?>
                                    <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>" style="display:none;"></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="bottom-menu bg-dark position-absolute w-100">
                                <div class="d-flex justify-content-between px-3">
                                    <div class="d-flex">
                                        <!-- love -->
                                        <a href="#" class="my-auto px-2"><i class="fas fa-heart"></i></a>
                                        <!-- shop -->
                                        <a href="product.php?id=<?= $id ?>" class="btn"><i class="fas fa-search"></i></a>
                                    </div>
                                    <div class="d-flex">
                                        <!-- price -->
                                        <?php if ($promotion == 1) : ?>
                                            <?php $newPrice = $price - ($price * $percentage / 100); ?>
                                            <p class="card-text text-white my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€'?></p>
                                        <?php else : ?>
                                            <p class="card-text text-white my-auto"><?= $price ?>€</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /card -->
                                    
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center">
                <a class="" href="shop.php?category_id=7" data-id="7"><button class="btn btn-dark my-5">SEE ALL</button></a>
            </div>
        </section> <!-- /container -->

        <!-- SPRING COLLECTION TEASER -->
        <section>
            <div class="photo w-100 d-flex my-5 pt-5"> 
                <span class="text-body-tertiary fs-3 lh-5 col-lg-6 align-content-center my-auto text-center">SPRING <br>COLLECTION</span>
            </div>
        </section>

        <!-- BEST SALES -->
        <section class="container bg-light my-5 py-5">
            <h1>Best Sales</h1>
            <h1 class="ter">Best Sales</h1>
            <div class="d-flex flex-wrap justify-content-center">
                <?php 
                $product = new Product();
                $products = $product->getRandomBestSellers(4);
                foreach ($products as $result) :
                    $id = $result['id_product'];
                    $title = $result['title'];
                    $price = $result['price'];
                    $image = $result['image'];
                    $image1 = $result['image_1'];
                    $image2 = $result['image_2'];
                    $promotion = $result['promotion'];
                    $percentage = $result['promotion_percentage'];
                    $newPrice = $price - ($price * $percentage / 100);
                    ?>
    
                    <!-- card -->
                    <div class="card shadow col-lg-3 col-md-6 col-sm-12 p-3 justify-content-center">
                        <div class="position-relative mb-5">
                            <h4 class="card-title"><?= $title ?></h4>
                            <?php $images = [$image, $image1, $image2]; ?>
                            <?php foreach ($images as $index => $image) : ?>
                                <?php if (!empty($image) && $index === 0) : ?>
                                    <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>">
                                    <img src="./inc/img/shop/<?= $image ?>" alt="<?= $title ?>" class="img-fluid">
                                    </a>
                                <?php elseif (!empty($image) && $index !== 0) : ?>
                                    <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>" style="display:none;"></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="bottom-menu bg-dark position-absolute w-100">
                                <div class="d-flex justify-content-between px-3">
                                    <div class="d-flex">
                                        <!-- love -->
                                        <a href="#" class="my-auto px-2"><i class="fas fa-heart"></i></a>
                                        <!-- shop -->
                                        <a href="product.php?id=<?= $id ?>" class="btn"><i class="fas fa-search"></i></a>
                                    </div>
                                    <div class="d-flex">
                                        <!-- price -->
                                        <?php if ($promotion == 1) : ?>
                                            <?php $newPrice = $price - ($price * $percentage / 100); ?>
                                            <p class="card-text text-white my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€'?></p>
                                        <?php else : ?>
                                            <p class="card-text text-white my-auto"><?= $price ?>€</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /card -->
                                    
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center">
                <a class="" href="shop.php?category_id=2" data-id="2"><button class="btn btn-dark my-5">SEE ALL</button></a>
            </div>
        </section>

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>