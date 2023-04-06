<?php

use User;

session_start();
require_once 'class/User.php';
$user = new User();
?>

<header class="header">

    <!--------------------------------------TOPMENU---------------------------------------------->
    <div class="d-flex">
        <nav class="topmenu navbar navbar-expand-md navbar-black bg-dark px-3">

            <div class="container-fluid justify-content-end">

                <?php
                // if user click on logout
                if (isset($_GET['logout'])) {
                    if ($_GET['logout'] == true) {
                        $user->logout();
                        header('Location: index.php');
                    }
                }
                // if user is logged in and is admin
                if ($user->isAdmin()) { ?>

                    <ul class="navbar-nav flex-row mx-3">
                        <li class="currentUser">
                            <a class="nav-link" href="profile.php" id="currentUser"><?= $user->getLogin() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?logout=true">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                    </ul>
                <?php
                    // if user is logged as member
                } else if ($user->isLogged()) { ?>
                    <ul class="navbar-nav flex-row mx-3">
                        <li class="currentUser">
                            <a class="nav-link" href="profile.php" id="currentUser"><?= $user->getLogin() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?logout=true">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                    </ul>
                <?php
                } else { ?>
                    <ul class="navbar-nav flex-row mx-3">
                        <li class="nav-item">
                            <a class="nav-link" href="authentification.php?choice=login"><img class="menuIcon" src="inc/img/icons/login.png" /> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="authentification.php?choice=register"><img class="menuIcon" src="inc/img/icons/join.png" /> JoinUs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php"><img class="menuIcon" src="inc/img/icons/shop.png" /> Shop Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><img class="menuIcon" src="inc/img/icons/bag.png" /> Cart</a>
                        </li>
                    </ul>
                <?php
                } ?>
            </div>
        </nav> <!-- /menu-top -->
    </div> <!-- /d-flex -->

    <!--------------------------------------MAINMENU---------------------------------------------->
    <section class="mainmenu">

        <nav class="navbar navbar-expand-md">

            <div class="container-fluid justify-content-end">

                <a class="navbar-brand me-auto" href="index.php"><img src="inc/img/design/logo_bk.png" alt="logo" width="100px"></a>

                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link lined" href="shop.php?page=new">New collection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lined" href="shop.php?page=best">Best sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lined" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lined" href="shop.php?page=clearance">Clearance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lined" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lined" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div> <!-- /collapse -->
            </div> <!-- /container-fluid -->
        </nav>

        <div class="d-flex">
            <div class="col-lg-11 col-md-1 mx-auto">
                <form class="d-flex search" method="get" action="recherche.php">
                    <input id="search" class="form-control me-sm-1" type="text" name="search" placeholder="Search...">

                    <button class="btn btn-light my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <ul id="matchList"></ul>
                <ul id="matchList2"></ul>
            </div>
    </section> <!-- /mainnav -->

    <!--------------------------------------CATEGMENU-------------------------------------------->
    <nav class="categmenu navbar navbar-expand-md navbar-black bg-light px-3">

        <div class="container-fluid justify-content-start">

            <ul class="navbar-nav flex-row mx-3">
                <li class="nav-item" class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=accessory">accessory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=dress">dress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=shirt">shirt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=skirt">skirt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=suit">suit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=sweater">sweater</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=trouser">trouser</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?page=coat">coat</a>
                </li>
            </ul>

        </div> <!-- /container-fluid -->

    </nav>

</header>