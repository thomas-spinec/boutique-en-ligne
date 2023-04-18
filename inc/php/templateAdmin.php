<?php
session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
$user = new User();
$users = $user->getAll();
$product = new Product();
$tableSize = 'size';
$sizes = $product->getInfo($tableSize);
$tableCategory = 'category';
$categories = $product->getInfo($tableCategory);

// GESTION DES UTILISATEURS --------------------------------
if (isset($_GET["users"])) :
?>

    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Role</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $cols => $value) {
            ?>
                <tr>
                    <th>
                        <?= $value["login"]; ?>
                    </th>
                    <th>
                        <?= $value['role']; ?>
                    </th>
                    <?php if ($user->getLogin() != $value["login"]) { ?>
                        <th>
                            <form method="post" id="formRole">
                                <select name="role" id="catchRole" data-id="<?= $value['id_user'] ?>" class="role">
                                    <option data-id="user" value="user">user</option>
                                    <option data-id="admin" value="admin">admin</option>
                                </select>
                                <input type="submit" class="changeDroit" id="changeDroit" data-id="<?= $value['id_user'] ?>" value="Change">
                            </form>

                        </th>
                        <th>
                            <p class="delUser" data-id="<?= $value['id_user'] ?>">cross</p>
                        </th>
                    <?php
                    } else {
                    ?>
                        <th>
                            <span>Current user</span>
                        </th>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }

            ?>
        </tbody>

    </table>


    <!-- GESTION DES PRODUITS -------------------------------- -->
<?php
elseif (isset($_GET["products"])) :
    if ($_GET['categ'] != "") {
        $products = $product->getAll($_GET['categ']);
    } else {
        $products = $product->getAll();
    }
?>
    <select class="filterCateg">
        <option value="" selected>Category</option>

        <?php foreach ($categories as $cols => $value) {
        ?>
            <option value="<?= $value['id_category'] ?>"><?= $value['name'] ?></option>
        <?php
        } ?>
    </select>
    <table>
        <thead>
            <tr>
                <th>PRODUCT</th>

                <th>REFERENCE</th>

                <th>CATEGORY</th>

                <th>SIZE</th>

                <th>STOCK</th>
            </tr>

        </thead>
        <tbody>


            <?php
            if ($products == "Nothing to show here !") {
            ?>
                <tr>
                    <th><?= $products ?></th>
                </tr>
                <?php
            } else {
                foreach ($products as $cols => $value) {
                ?>
                    <tr>
                        <th>
                            <p class="delProduct" data-id="<?= $value['id_product'] ?>">cross</p> <span class="changeProduct" data-id="<?= $value['id_product'] ?>">crayon</span> <?= $value['title'] ?>
                        </th>
                        <th><?= $value['id_product'] ?></th>
                        <th><?= $value['category'] ?></th>
                        <th>
                            <select class="displayStock" name="size" data-id="<?= $value['id_product'] ?>">
                                <option value="" selected disabled>Choisir une taille</option>
                                <?php
                                // size pour le produit en cours;
                                $sizesProduct = $product->getSize($value['id_product']);
                                foreach ($sizesProduct as $cols => $valueSize) {
                                ?>
                                    <option value="<?= $valueSize['id_size'] ?>"><?= $valueSize['size'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </th>
                        <!-- partie qui affichera le stock -->
                        <th></th>
                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- MODIFIER UN PRODUIT -------------------------------- -->
<?php
elseif (isset($_GET["changeProduct"])) :
    $id = $_GET["changeProduct"];
    $product_info = $product->getProductInfo($id);
    $category = $product->getCategoryName($id);
    $size = $product->getSize($id);
    $title = $product_info['title'];
    $price = $product_info['price'] / 100;
    $image = $product_info['image'];
    $image1 = $product_info['image_1'];
    $image2 = $product_info['image_2'];
    $promotion = $product_info['promotion'];
    $percentage = $product_info['promotion_percentage'];
    $description = $product_info['description'];
    $bestSellers = $product_info['best_sellers'];
    $newCollection = $product_info['new_collection'];
    // mettre chaque taille dans un tableau
    $sizesProduct = array();
    foreach ($size as $cols => $value) {
        array_push($sizesProduct, $value['size']);
    }
?>
    <span class="closePopUp">Cross</span>
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img class="product_img" src="inc/img/shop/<?= $image ?>" alt="<?= $title ?> ">
            <div class="thumbnails">
                <img class="thumbnail" src="inc/img/shop/<?= $image ?>" data-full-image="inc/img/shop/<?= $image ?>">
                <?php
                if ($image1 != "") { ?>
                    <img class="thumbnail" src="inc/img/shop/<?= $image1 ?>" data-full-image="inc/img/shop/<?= $image1 ?>">
                <?php }
                if ($image2 != "") { ?>
                    <img class="thumbnail" src="inc/img/shop/<?= $image2 ?>" data-full-image="inc/img/shop/<?= $image2 ?>">
                <?php } else { ?>
                    <img class="thumbnail" src="inc/img/shop/default.png" data-full-image="inc/img/shop/<?= $image ?>">
                <?php } ?>

            </div>
        </div>

        <div class="col-md-6">
            <div class="small mb-5">Category: <?php echo $category; ?></div>
            <h2 class="display-5 fw-bolder my-5"><?php echo $title ?></h2>
            <div class="fs-5 mb-5">
                <!-- Size with Stock-->
                <table>
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Stock</th>
                            <th>Refill</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($size as $value) {
                            $stock = $product->getStock($id, $value['id_size']);
                        ?>
                            <tr>
                                <th class="sizeName"><?= $value['size'] ?></th>
                                <th class="stock"><?= $stock['stock'] ?></th>
                                <th>
                                    <input type="number" class="changeStock" data-id="<?= $value['id_size'] ?>" data-product="<?= $id ?>" value="0" min="0">
                                </th>
                            </tr>
                        <?php
                        }
                        // Add size -----------------
                        ?>
                        <tr>
                            <th>
                                <select class="addSize" name="size" data-id="<?= $id ?>">
                                    <option value="" selected disabled>Choisir une taille</option>
                                    <?php
                                    // size pour le produit en cours
                                    foreach ($sizes as $cols => $valueSize) {
                                        if (!in_array($valueSize['size'], $sizesProduct)) {
                                    ?>
                                            <option value="<?= $valueSize['id_size'] ?>"><?= $valueSize['size'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <input type="number" class="addStock" data-id="<?= $id ?>" value="0" min="0">
                            </th>
                            <th>
                                Add size
                            </th>

                        </tr>
                    </tbody>
                </table>

                <!-- Best Seller/ New collection with radio checked or not-->
                <?php if ($newCollection == 1) { ?>
                    <input type="radio" name="newCollection" class="newCollection" data-id="<?= $id ?>" data-value="checked" checked>New Collection
                <?php } else { ?>
                    <input type="radio" name="newCollection" class="newCollection" data-id="<?= $id ?>" data-value="unchecked">New Collection
                <?php } ?>
                <?php if ($bestSellers == 1) { ?>
                    <input type="radio" name="bestSeller" class="bestSeller" data-id="<?= $id ?>" data-value="checked" checked>Best Seller
                <?php } else { ?>
                    <input type="radio" name="bestSeller" class="bestSeller" data-id="<?= $id ?>" data-value="unchecked">Best Seller
                <?php } ?>

                <!--  Price & Promotion -->
                <?php
                if ($promotion == 1) {
                    $newPrice = $price - ($price * $percentage / 100);
                ?>
                    <p class="card-text my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€' ?> </p>
                <?php
                } else {
                ?>
                    <p class="card-text my-auto"><?= $price ?>€</p>
                <?php
                } ?>

                <select name="promotion" class="promotion" data-id="<?= $id ?>">
                    <option value="" selected disabled>Choose a promotion</option>
                    <option value="0">Not on sale</option>
                    <option value="5">5%</option>
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="50">50%</option>
                    <option value="75">75%</option>
                </select>


                <!-- Description -->
                <p class="lead"><?php echo $product_info['description'] ?></p>
            </div>
        </div>
    </div>

    <!-- AJOUTER UN PRODUIT -------------------------------- -->
<?php
elseif (isset($_GET["addProducts"])) :
?>

    <form method="POST" id="formProduct">

        <label for="title">Title</label>
        <input type="text" name="title">

        <label for="descritpion">Description</label>
        <input type="text" name="description">

        <label for="imageProduct">photo</label>
        <input type="file" name="imageProduct" required>

        <label for="imageProduct_1">photo 2</label>
        <input type="file" name="imageProduct_1">

        <label for="imageProduct_2">photo 3</label>
        <input type="file" name="imageProduct_2">

        <label for="category">Category</label>
        <select name="category">
            <option value="" disabled selected>Category</option>
            <?php
            foreach ($categories as $cols => $value) {
            ?>
                <option value="<?= $value['id_category'] ?>"><?= $value['name'] ?></option>
            <?php
            }
            ?>
        </select>

        <div class="sizeDiv">
            <label for="size">Size</label>
            <select class="selectSize" name="size">
                <option value="" disabled selected>Size</option>
                <?php
                foreach ($sizes as $cols => $value) {
                ?>
                    <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                <?php
                }
                ?>
            </select>

            <label for="stock">Stock</label>
            <input type="number" name="stock" min="1">

            <button data-id="size2" class="addSize"><span>+</span> add a new size</button>
        </div>

        <label for="price">Price</label>
        <input type="number" name="priceEuro" min="1" id="euros">
        <span>€</span>
        <input type="number" name="priceCentime" min="0" id="centimes">

        <input type="submit" name="add" value="ADD" class="submitAdd">
    </form>

<?php
// ajout d'une taille --------------------------------------------
elseif (isset($_GET["size2"])) :
?>
    <label for="size2">Size</label>
    <select class="selectSize" name="size2">
        <option value="" disabled selected>Size</option>
        <?php
        foreach ($sizes as $cols => $value) {
        ?>
            <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="stock2">Stock</label>
    <input type="number" name="stock2" min="1">

    <button data-id="size3" class="addSize"><span>+</span>add a new size </button>

<?php
elseif (isset($_GET["size3"])) :
?>
    <label for="size3">Size</label>
    <select class="selectSize" name="size3">
        <option value="" disabled selected>Size</option>
        <?php
        foreach ($sizes as $cols => $value) {
        ?>
            <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="stock3">Stock</label>
    <input type="number" name="stock3" min="1">

    <button data-id="size4" class="addSize"><span>+</span>add a new size </button>

<?php
elseif (isset($_GET["size4"])) :

?>
    <label for="size4">Size</label>
    <select class="selectSize" name="size4">
        <option value="" disabled selected>Size</option>
        <?php
        foreach ($sizes as $cols => $value) {
        ?>
            <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="stock4">Stock</label>
    <input type="number" name="stock4" min="1">

    <button data-id="size5" class="addSize"><span>+</span>add a new size </button>

<?php
elseif (isset($_GET["size5"])) :
?>
    <label for="size5">Size</label>
    <select class="selectSize" name="size5">
        <option value="" disabled selected>Size</option>
        <?php
        foreach ($sizes as $cols => $value) {
        ?>
            <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="stock5">Stock</label>
    <input type="number" name="stock5" min="1">

    <button data-id="size6" class="addSize"><span>+</span>add a new size </button>

<?php
elseif (isset($_GET["size6"])) :
?>
    <label for="size6">Size</label>
    <select class="selectSize" name="size6">
        <option value="" disabled selected>Size</option>
        <?php
        foreach ($sizes as $cols => $value) {
        ?>
            <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
        <?php
        }
        ?>
    </select>

    <label for="stock6">Stock</label>
    <input type="number" name="stock6" min="1">

<?php
// GESTION DES CATEGORIES --------------------------------------------
elseif (isset($_GET["categories"])) :
?>
    <table>
        <thead>
            <tr>
                <th>Manage</th>
                <th>CATEGORY</th>
            </tr>

        </thead>
        <tbody>
            <?php
            foreach ($categories as $col => $value) {


            ?>
                <tr>
                    <th>
                        <span class="delCategory" data-id="<?= $value['id_category'] ?>">Dustbin</span> <span class="changeCategory" data-id="<?= $value['id_category'] ?>">Pencil</span>
                    </th>
                    <th>
                        <?= $value['name'] ?>
                    </th>
                </tr>
            <?php } ?>
        </tbody>


    </table>
<?php
elseif (isset($_GET["addCategories"])) :
?>

    <form method="POST" id="addCategory">
        <label for="category">Add a category</label>
        <input type="text" name="category">
        <button class="validate">ADD</button>
    </form>

<?php
elseif (isset($_GET["changeCategory"])) :
    $category = $product->getCategory($_GET["changeCategory"]);
?>
    <span class="closePopUp">Cross</span>
    <form method="POST" id="UpdateCategory">
        <label for="category">Change the category</label>
        <input type="text" name="category" value="<?= $category['name'] ?>">
        <input type="hidden" name="id_category" value="<?= $category['id_category'] ?>">
        <button class="validate">CHANGE</button>
    </form>
<?php
endif;
