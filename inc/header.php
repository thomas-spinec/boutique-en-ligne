<?php
session_start();
require_once 'class/User.php';
$user = new User();
?>

<header>
    <div class="logo">
        <a href="index.php"><img src="inc/img/logo.png"></a>
    </div>

    <nav class="topMenu">
        <?php
        if (isset($_GET['logout'])) {
            if ($_GET['logout'] == true) {
                $user->logout();
                header('Location: index.php');
            }
        }

        // if user is logged in and is admin
        if ($user->isAdmin()) { ?>
            <div class="currentUser">
                <p id="currentUser"><?= $user->getLogin() ?></p>
            </div>
            <a href="admin.php">Admin</a>
            <a href="index.php?logout=true">Logout</a>
            <a href="profile.php">Account</a>
            <a href="shop.php">Shop Now</a>
            <a href="cart.php">Cart</a>

        <?php
            // if user is logged as member
        } else if ($user->isLogged()) { ?>
            <div class="currentUser">
                <p id="currentUser"><?= $user->getLogin() ?></p>
            </div>
            <a href="index.php?logout=true">Logout</a>
            <a href="profile.php">Account</a>
            <a href="shop.php">Shop Now</a>
            <a href="cart.php">Cart</a>
        <?php
        } else {
        ?>
            <a href="authentification.php?choice=login">Login</a>
            <a href="authentification.php?choice=register">JoinUs</a>
            <a href="shop.php">Shop Now</a>
            <a href="cart.php">Cart</a>
        <?php
        }
        ?>
    </nav>

    <nav class="close">

    </nav>
</header>