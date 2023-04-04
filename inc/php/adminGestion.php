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
                    <p>cross</p>
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
    var_dump($products);
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
                <th> <span>cross</span> <span>crayon</span> <?= $value['title'] ?></th>
                <th><?= $value['id_product']?></th>
                <th><?= "yo" ?></th>
            </tr>

        <?php
        }
        } 
        ?>
        </tbody>
    </table>


<?php
endif;

