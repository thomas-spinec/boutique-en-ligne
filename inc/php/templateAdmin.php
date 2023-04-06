<?php
session_start();
if(isset($_GET["users"])):
require_once "../class/User.php";
$user = new User();
$users = $user->getAll();
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
        foreach($users as $cols=>$value){
            ?> 
            <tr>
                <th>
                    <?= $value["login"];?>
                </th>
                <th>
                    <?= $value['role'];?>
                </th>
                <?php if ($user->getLogin()!=$value["login"]) {?>
                <th>
                    <select name="role" data-id="<?=$value['id_user'] ?>" class="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" class="changeDroit" data-id="<?=$value['id_user'] ?>" value="Change">

                </th>
                <th>
                    <p class="delUser" data-id="<?=$value['id_user'] ?>" >cross</p>
                </th>
                    <?php  
                }
                else{
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
elseif(isset($_GET["products"])):
    require_once "../class/Product.php";
    $product = new Product();
    $products = $product->getAll();
    var_dump($products)
    // $idProduct = $product['id_product'];
?>
    <table>
        <thead>
            <tr>
                <th>PRODUCT</th>
        
                <th>REFERENCE</th>
           
                <th>CATEGORY</th>

                <th>STOCK</th>

                <th>NOTES</th>
            </tr>

        </thead>
        <tbody>
        <?php
            if (empty($products)){
                ?>
                <tr>
                    <th>Il n'y a aucun article</th>
                </tr>
                <?php
            } else {
                foreach($products as $cols=>$value){
            ?> 
            <tr>
                <th> <p class="delProduct" data-id="<?=$value['id_product']?>">cross</p> <span>crayon</span> <?= $value['title'] ?></th>
                <th><?= $value['id_product']?></th>
                <th><?= $value['category']?></th>
                <th><?= "5"?></th>
                <th><?= $value['description']?></th>
            </tr>

        <?php
        }
        } 
        ?>
        </tbody>
    </table>

    <?php 
elseif(isset($_GET["addProducts"])):
    require_once "../class/Product.php";
    $product = new Product();
    $tableSize = 'size';
    $tableCategory = 'category';
    $sizes = $product->getInfo($tableSize);
    $categories = $product->getInfo($tableCategory);
?>

<form method="POST" id="addProduct">

    <label for="title">Title</label>
    <input type="text" name="title">

    <label for="descritpion">Description</label>
    <input type="text" name="description">

    <label for="image">photo</label>
    <input type="file" name="image">

    <label for="category">Category</label>
    <select name="category">
        <option value="" disabled selected>Category</option>
        <?php  
        foreach($categories as $cols=>$value){
            ?>
            <option value="<?= $value['id_category'] ?>"><?= $value['name']?></option>
            <?php
        }
        ?>
    </select>

    <div class="size">
    <label for="size">Size</label>
    <select name="size">
        <option value="" disabled selected>Size</option>
        <?php  
        foreach($sizes as $cols=>$value){
            ?>
            <option value="<?= $value['id_size'] ?>"><?= $value['size']?></option>
            <?php
        }
        ?>
    </select>

    <button id="addSize"><span>+</span> </button> add a new size
    </div>

    <label for="stock">Stock</label>
    <input type="number" name="stock" min="1">

    <label for="price">Price</label>
    <input type="number" name="price" min="1"id="euros">
    <span>€</span>
    <input type="number" name="price" min="0" id="centimes">

    <input type="submit" name="add" value="ADD">
</form>

<?php 
elseif(isset($_GET["categories"])):
    require_once "../class/Product.php";
    $product = new Product();
    $tableCategory = 'category';
    $categories = $product->getInfo($tableCategory);
    var_dump($categories);
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
            foreach($categories as $col=>$value){

            
        ?>
        <tr>
            <th>
                <span class="delCategory" data-id="<?=$value['id_category']?>">Dustbin</span> <span>Pencil</span> 
            </th>
            <th>
                <?= $value['name'] ?>
            </th>
        </tr>
        <?php } ?>
    </tbody>


</table>
<?php 
elseif(isset($_GET["addCategories"])):

?>

<form method="POST" id="addCategory">
    <label for="category">Add a category</label>
    <input type="text">
    <button id="validate">ADD</button>
</form>

<?php
endif;

