<?php

require_once '../class/Product.php';
$Product = new Product();

if (isset($_GET['category_id'])):
    $categoryId = $_GET['category_id'];
    $products = $Product->getProductsByCategory($categoryId);
    $product = $products[0];
    $price = $product['price'];
    $percentage = $product['promotion_percentage'];
    $newPrice = $price - ($price * $percentage / 100);
    if ($products === 'No products in this category'){
        echo $products;
    }else{
?>
    <div class="d-flex flex-wrap justify-content-between">
        <?php
        foreach ($products as $product): ?>
            <div class="card col-lg-3 col-md-6 col-sm-12 p-3">
                <img src="./inc/img/shop/<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="img-fluid">
                <div class="d-flex justify-content-between">
                    <p class="text-center"> <?php echo $product['title'] ?> </p>
                    <?php if ($product['promotion'] === '0'): ?>                        
                        <p class="text-center"> <?php echo $product['price'] ?> € </p>
                    <?php elseif ($product['promotion'] === '1'): ?>
                        <p class="card-text text-white my-auto"><?= '<span class="text-decoration-line-through">' . $price . '€</span>' . $percentage . '% off' . $newPrice ?> </p>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn btn-outline-dark "><a class="text-decoration-none text-black" href="./product.php?id=<?php echo $product['id_product'] ?>">SEE MORE</a></button>
                
            </div>
            <?php endforeach;
        ?>
    </div>
<?php
    };
else:
    if (isset($_GET['category'])) {
        if ($_GET['category'] === 'best_sellers') {
            $products = $Product->getRandomBestSellers($limit);
        } else if ($_GET['category'] === 'new_collection') {
            $products = $Product->getRandomNewCollection($limit);
        } else if ($_GET['category'] === 'promotion') {
            $products = $Product->getAllPromotionProducts(true); // récupère les produits en promotion
        } else if ($_GET['category'] === '') {
            $products = $Product->getAllProducts();
        } else if ($_GET['category'] === 'id_category' && isset($_GET['categoryId'])) {
            // récupère l'ID de la catégorie
            $categoryId = $_GET['categoryId'];
            $products = $Product->getProductsByCategory($categoryId);
        } else {
            $products = $Product->getAllProducts();
        }
    } else {
        $products = $Product->getAllProducts();
    }
endif;

?>