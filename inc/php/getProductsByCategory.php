<?php

require_once '../class/Product.php';
$Product = new Product();

if (isset($_GET['category_id'])):
    $categoryId = $_GET['category_id'];
    $products = $Product->getAll($categoryId);


else: // if no category is selected, show all products
    $products = $Product->getAll();
endif;

if ($products === 'Nothing to show here !'){
    echo $products;
} else{
        ?>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
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
                    <div class="position-relative">
                        <h4 class="card-title"><?= $title ?></h4>
                        <?php
                        // Create an array of the image URLs
                        $images = [$image, $image1, $image2];
                        // Remove any empty values
                        $images = array_filter($images);
                        // Loop through the array and create an <a> element for each image
                        foreach ($images as $image) : ?>
                            <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>" class="">
                            </a>
                        <?php endforeach ?>
                        <?php 
                        // Only show the first image in the card
                        $first_image = reset($images);
                        if ($first_image) { ?>
                            <a href="./inc/img/shop/<?= $first_image ?>" data-lightbox="<?= $title ?>">
                                <img src="./inc/img/shop/<?= $first_image ?>" alt="<?= $title ?>" class="img-fluid">
                            </a>
                        <?php } ?>
                        
                        <div class="w-100 d-flex px-3 justify-content-between bg-dark position-absolute bottom-0">
                            <!-- love -->
                            <div class="d-flex ">
                                <a href="#" class="my-auto px-2"><i class="fas fa-heart"></i></a>
                                <!-- see -->
                                <?php 
                                // Only show the "view" icon if there are more than one image
                                if (count($images) > 1) { ?>
                                    <a href="#" data-lightbox="<?= $title ?>" class="my-auto px-2 pt-1"><i class="fas fa-search"></i></a>
                                <?php } ?>
                                <!-- shop -->
                                <a href="product.php?id=<?= $id ?>" class="btn"><i class="fas fa-shopping-cart"></i></a>
                            </div>
                            <div class="d-flex">
                                <!-- price -->
                                <?php
                                if($promotion == 1) {
                                    $newPrice = $price - ($price * $percentage / 100);
                                    ?>
                                    <p class="card-text text-white my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€'?> </p>
                                    <?php
                                } else {
                                ?>
                                <p class="card-text text-white my-auto"><?= $price ?>€</p>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- /card -->
            <?php endforeach;
            ?>
        </div>
<?php
};

?>
