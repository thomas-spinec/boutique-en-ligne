<?php

require_once '../class/Product.php';
$Product = new Product();

if (isset($_GET['category_id'])) :
    $categoryId = $_GET['category_id'];
    $products = $Product->getAll($categoryId);


else : // if no category is selected, show all products
    $products = $Product->getAll();
endif;

if ($products === 'Nothing to show here !') {
    echo $products;
} else {
?>
    <div class="d-flex flex-wrap justify-content-center gap">
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
            $price = $price / 100;
            $newPrice = $price - ($price * $percentage / 100);
        ?>
            <!-- card -->
            <div class="card shadow col-lg-3 col-md-6 col-sm-12 justify-content-center my-5">
                <div class="position-relative">
                    <h4 class="card-title text-center p-2"><?= $title ?></h4>
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
                                <a id="favorite" href="#" class="my-auto px-2"><i class="fas fa-heart"></i></a>
                                <!-- shop -->
                                <a href="product.php?id=<?= $id ?>" class="btn"><i class="fas fa-search"></i></a>
                            </div>
                            <div class="d-flex">
                                <!-- price -->
                                <?php if ($promotion == 1) : ?>
                                    <?php $newPrice = $price - ($price * $percentage / 100); ?>
                                    <p class="card-text text-white my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€' ?></p>
                                <?php else : ?>
                                    <p class="card-text text-white my-auto"><?= $price ?>€</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
<?php
}; ?>