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

    <?php include 'inc/header.php'; ?>

    <main class="container px-5 px-lg-5 mx-5 my-5">
        <?php
        $id = $_GET['id'];
        $product_info = $product->getProductInfo($id);
        $category = $product->getCategoryName($id);
        $comment = $comment->getComment($id);
        ?>

        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="product_img" src="inc/img/shop/<?= $product_info['image'] ?>" alt="<?= $product_info['title'] ?> ">
                <div class="thumbnails">
                    <img class="thumbnail" src="inc/img/shop/<?= $product_info['image'] ?>" data-full-image="inc/img/shop/<?= $product_info['image'] ?>">
                    <?php 
                    if ($product_info['image_1'] != "") { ?>
                        <img class="thumbnail" src="inc/img/shop/<?= $product_info['image_1'] ?>" data-full-image="inc/img/shop/<?= $product_info['image_1'] ?>">
                    <?php } 
                    if ($product_info['image_2'] != "") { ?>
                        <img class="thumbnail" src="inc/img/shop/<?= $product_info['image_2'] ?>" data-full-image="inc/img/shop/<?= $product_info['image_2'] ?>">
                    <?php } 
                    else { ?>
                        <img class="thumbnail" src="inc/img/shop/default.png" data-full-image="inc/img/shop/<?= $product_info['image'] ?>">
                    <?php } ?>
                    
                </div>
            </div>

            <div class="col-md-6">
                <div class="small mb-5">Category: <?php echo $category; ?></div>
                <h2 class="display-5 fw-bolder my-5"><?php echo $product_info['title'] ?></h2>
                <div class="fs-5 mb-5">
                    <p class="">Quantity : <input type="number" name="quantity" id="quantity" min="1" max="10" value="1"></p>
                    <p class="">Size : 
                        <select name="size" id="size">
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select></p>
                    <h3 class="py-5"><?php echo $product_info['price']; ?>€</h3>
                    <p class="lead"><?php echo $product_info['description'] ?></p>
                </div>

                <div class="d-flex mb-5">
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="fas fa-shopping-cart me-1"></i>
                        Add to cart
                    </button>
                </div>
                <div class="d-flex mt-5 justify-content-around">
                    <i class="fab fa-2x fa-cc-visa"></i>
                    <i class="fab fa-2x fa-cc-mastercard"></i>
                    <i class="fab fa-2x fa-cc-paypal"></i>
                    <i class="fab fa-2x fa-cc-amex"></i>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <hr class="my-5">
            <div class="col-md-6">
                <h3>Informations</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Fusce tempor id sapien in sollicitudin. Cras ut ex quis nibh g
                ravida facilisis. Proin tincidunt ante ac ipsum eleifend mattis.</p>
            </div>
            <div class="col-md-6">
                <h3>Shipping</h3>
                <p>Duis euismod lobortis urna vitae vestibulum. Morbi ipsum massa, viverra a massa nec, mattis sagittis lorem. Suspendisse aliquet scelerisque libero, id cursus elit semper hendrerit. Etiam pulvinar gravida velit ut tempus. Suspendisse sagittis enim vitae interdum aliquam.</p>
            </div>
        </div>

        
        <section class="bg-light my-5 py-5">
            <h1>Best Sales</h1>
            <h1 class="ter">Best Sales</h1>
            <?php $product->getRandomBestSales(); ?>
        </section>
        
        <?php $comment = new Comment(); ?>
        
        <section class="container bg-light border radius p-2">
            <h1>Comments</h1>
            <h1 class="ter">Comments</h1>
            <?php
            $id = $_GET['id'];
            $id = (int)$id;
            if (!is_int($id)) {
                // Handle the error
                echo "Error: id should be an integer";
            } else {
                $comments = $comment->getComments($id);
                if ($comments !== null) {
                    foreach ($comments as $c) :
                        $id = $c['id'];
                        $login = $user['login'];
                        $date = $c['date'];
                        $commentary = $c['comment'];
                        $subject = $c['subject'];
                        ?>
                        <div class="comment">
                            <h3><?= $subject ?></h3>
                            <small class="comment-meta">Publié le <?= $date ?></small>
                            <p><?= $commentary ?></p>
                            <hr>
                        </div>
                        <?php
                    endforeach;
                } else {
                    echo '<p>There is no Comment for this product, be the first !</p>';
                }
            }
            ?>

        </section>

        <!-- Leave a comment -->
        <section class="container">
            <h2>Leave a comment</h2>
            <?php
            if (!$user->isLogged()) {
                echo '<p>You must logIn or register, to leave a comment.</p>';
            } else {

                $id_product = $_GET['id'];
                ?>
                <form action="./inc/php/leaveComment.php" method="post" class="m-auto">
                    <input type="hidden" name="id_product" value="<?= $id_product ?>">
                    <input type="subject" class="" name="subject" placeholder="Subject">
                    <label for="comment">Your comment :</label>
                    <textarea name="comment" cols="40" rows="10"></textarea>
                    <input type="submit" class="" name="submit" value="SEND">
                </form>
                <?php
            }
            ?>
        </section>

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.querySelector('.product_img');
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
            const fullImage = thumbnail.dataset.fullImage;
            mainImage.src = fullImage;
            });
        });
    </script>

</body>
</html>