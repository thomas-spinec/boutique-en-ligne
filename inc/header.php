<?php

session_start();
require_once 'class/User.php';
require_once 'class/Product.php';
require_once "class/Comment.php";
$user = new User();
$product = new Product();
$comment = new Comment();
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
                    }
                }
                // if user is logged in as admin
                if ($user->isAdmin()) { ?>

                    <ul class="navbar-nav flex-row px-3">
                        <li class="currentUser">
                            <a class="nav-link" href="profile.php" id="currentUser"><?= $user->getLogin() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                        <li  id="deconnexion" class="nav-item">
                            <a href="index.php?logout=true">LogOut</a></li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php"><img class="menuIcon" src="inc/img/icons/shop.png" /> Shop</a> Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><img class="menuIcon" src="inc/img/icons/bag.png" /> Cart</a>
                        </li>
                    </ul>
                <?php
                    // if user is logged as member
                } else if ($user->isLogged()) { ?>
                    <ul class="navbar-nav flex-row px-3">
                        <li class="currentUser">
                            <a class="nav-link" href="profile.php" id="currentUser"><?= $user->getLogin() ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?logout=true">LogOut</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php"><img class="menuIcon" src="inc/img/icons/shop.png" /> Shop</a> Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><img class="menuIcon" src="inc/img/icons/bag.png" /> Cart</a>
                        </li>
                    </ul>
                <?php
                } else { ?>
                    <ul class="navbar-nav flex-row px-3">
                        <li class="nav-item">
                            <a class="nav-link" href="authentification.php?choice=login"><img class="menuIcon" src="inc/img/icons/login.png" /> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="authentification.php?choice=register"><img class="menuIcon" src="inc/img/icons/join.png" /> JoinUs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php"><img class="menuIcon" src="inc/img/icons/shop.png" /> Shop</a>
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
    <section class="mainmenu px-5">

        <nav class="navbar navbar-expand-md">

            <div class="container-fluid justify-content-end">

                <a class="navbar-brand me-auto" href="index.php"><img src="inc/img/design/logo_bk.png" alt="logo" width="100px"></a>

                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a id="new_collection" class="nav-link" href="shop.php?display=newCollection">New Collection</a>
                        </li>
                        <li class="nav-item">
                            <a id="best_sales" class="nav-link" href="shop.php?display=bestSales">Best Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lined" href="shop.php?display=clearance">Clearance</a>
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

        <!-- Serach bar -->
        <div class="d-flex">
            <div class="col-lg-11 col-md-1 mx-auto">
                <form class="d-flex search" method="get" action="search.php">
                    <input id="search" class="form-control me-sm-1" type="text" name="search" placeholder="Search..." autocomplete="off">
                    
                    <button class="btn btn-light my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <ul id="matchList"></ul>
                <ul id="matchList2"></ul>
            </div>
    </section> <!-- /mainnav -->

    <!--------------------------------------CATEGMENU-------------------------------------------->
    <nav class="categmenu navbar navbar-expand-md navbar-black bg-light px-5">

        <div class="container-fluid justify-content-start">

            <ul class="navbar-nav flex-row mx-3">
                <li class="nav-item" class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=accessory">Accessory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=coat">Coat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=dress">Dress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=Loungewear">Loungewear</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=pants">Pants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=shirt">Shirt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=skirt">Skirt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=suit">Suit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=sweater">Sweater</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lined" href="shop.php?display=top">Top</a>
                </li>
            </ul>

        </div> <!-- /container-fluid -->

    </nav>

</header>