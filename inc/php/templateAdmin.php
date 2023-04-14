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


<?php
elseif (isset($_GET["products"])) :
    if ($_GET['categ'] != "") {
        $products = $product->getAll($_GET['categ']);
    } else {
        $products = $product->getAll();
    }
    // var_dump($categories);

    // $idProduct = $product['id_product'];
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
            if (empty($products)) {
            ?>
                <tr>
                    <th>Il n'y a aucun article</th>
                </tr>
                <?php
            } else {
                foreach ($products as $cols => $value) {
                ?>
                    <tr>
                        <th>
                            <p class="delProduct" data-id="<?= $value['id_product'] ?>">cross</p> <span>crayon</span> <?= $value['title'] ?>
                        </th>
                        <th><?= $value['id_product'] ?></th>
                        <th><?= $value['category'] ?></th>
                        <th>
                            <select class="displayStock" name="size" data-id="<?= $value['id_product'] ?>">
                                <option value="" selected disabled>Choisir une taille</option>
                                <?php
                                // size pour le produit en cours
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

<?php
elseif (isset($_GET["addProducts"])) :
?>

    <form method="POST" id="formProduct">

        <label for="title">Title</label>
        <input type="text" name="title">

        <label for="descritpion">Description</label>
        <input type="text" name="description">

        <label for="imageProduct">photo</label>
        <input type="file" name="imageProduct" required >

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
                        <span class="delCategory" data-id="<?= $value['id_category'] ?>">Dustbin</span> <span>Pencil</span>
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
        <input type="text">
        <button id="validate">ADD</button>
    </form>

<?php
endif;