<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- JQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/scrollToTop.js"></script>
    <script src="inc/js/stickToTop.js"></script>
    <script src="inc/js/profil.js"></script>

    <script>
        /* Tabs script */
        function openTab(evt, information) {
            let i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
            }

            document.getElementById(information).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>

<body>
    <?php include 'inc/header.php'; ?>

    <?php
    if ($user->isLogged()) {
        require_once "inc/class/User.php";
        require_once "inc/class/Cart.php";
        $user = new User();
        $cart = new Cart();

        $userId = $_SESSION['user']['id'];
        // get whishlist products for the user

        $wishlist_items = $wishlist->getWishlistItems($userId);
        $login = $user->getLogin();
        $firstName = $user->getFirstname();
        $lastName = $user->getLastname();
        $email = $user->getEmail();
        $adress = $user->getAddress();
        $zip = $user->getZip();
        $city = $user->getCity();
        $country = $user->getCountry();

        $orders = $cart->getOrder($userId);
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

    <div class="hero_profile">
        <h1 class="h1-responsive text-dark">Profile</h1>
        <h1 class="h1-responsive bis opacity-25">Profile</h1>
    </div>

    <main class="container bg-light p-5">

        <h4 class="mb-5">Welcome <?= $user->getLogin() ?></h4>

        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'infos')">Informations</button>
            <button class="tablinks" onclick="openTab(event, 'orders')">Orders</button>
            <button class="tablinks" onclick="openTab(event, 'login')">Change Login</button>
            <button class="tablinks" onclick="openTab(event, 'password')">Change Password</button>
            <button class="tablinks" onclick="openTab(event, 'whishlist')">WhishList</button>
        </div>

        <!-- Tab infos -->
        <div id="infos" class="tabcontent p-5">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                    <p class="text-muted">Login: <?= $login ?></p>
                    <p class="text-muted">First Name: <?= $firstName ?></p>
                    <p class="text-muted">Last Name: <?= $lastName ?></p>
                    <p class="text-muted">E-mail: <?= $email ?></p>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                    <P class="text-muted">Address: <?= $adress ?></p>
                    <p class="text-muted">ZipCode: <?= $zip ?></p>
                    <p class="text-muted">City: <?= $city ?></P>
                    <p class="text-muted">Country: <?= $country ?></p>
                </div>
            </div>
        </div>

        <!-- Tab orders -->
        <div id="orders" class="tabcontent p-5">
            <div class="row justify-content-between">
                <?php foreach ($orders as $order) : ?>
                    <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                        <p class="text-muted">Order ID: <?= $order['id_order'] ?></p>
                        <p class="text-muted">Order Date: <?= $order['date'] ?></p>
                        <p class="text-muted">Order Total: <?= $order['total'] ?>€</p>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                        <p class="text-muted">Shipping Address: <?= $adress ?>, <?= $zip ?>, <?= $city ?></p>
                        <p class="text-muted">Billing Address: <?= $adress ?>, <?= $zip ?>, <?= $city ?> </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tab login -->
        <div id="login" class="tabcontent p-5">
            <div class="row wrap justify-content-between">
                <div class="col">
                    <?php $login = $user->getLogin(); ?>
                    <!-- FORMS -->
                    <form action="" method="post" id="loginForm" class="col-lg-6 col-md-12 col-sm-12 bg-white shadow my-2 p-5">
                        <div class="d-flex my-5">
                            <i class="fa fa-user fa-2x mx-2"></i>
                            <h5 class="mb-3">Change login</h5>
                        </div>
                        <div class="col">
                            <div class="row">
                                <label for="login">login</label>
                                <input type="text" name="login" class="login" value="<?= $login ?>" required>
                                <p></p>
                            </div>
                            <div class="row">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="password" placeholder="" required>
                                <p></p>
                            </div>
                            <div class="col">
                                <input type="submit" value="Change" name="send" id="btnModifLogin" class="btn btn-dark my-2">
                                <p></p>
                            </div>
                        </div> <!-- /col -->
                    </form>
                </div> <!-- /col -->
            </div> <!-- /row -->
        </div>

        <!-- Tab password -->
        <div id="password" class="tabcontent p-5">
            <div class="row wrap justify-content-between">
                <div class="col">
                    <form action="" method="post" id="passwordForm" class="col-lg-6 col-md-12 col-sm-12 bg-white shadow my-2 p-5">
                        <div class="d-flex my-5">
                            <i class="fa fa-lock fa-2x mx-2"></i>
                            <h5 class="mb-3">Change password</h5>
                        </div>
                        <div class="row">
                            <label for="password">Current password</label>
                            <input type="password" name="password" class="password" placeholder="" id="oldPassword" required>
                            <p></p>
                        </div>
                        <div class="row">
                            <label for="newPassword">New password</label>
                            <input type="password" name="newPassword" id="newPassword" class="password" placeholder="" required>
                            <p></p>
                        </div>
                        <div class="row">
                            <label for="newPassword2">Confirmation</label>
                            <input type="password" name="newPassword2" id="newPassword2" class="password" placeholder="" required>
                            <p></p>
                        </div>
                        <div class="col">
                            <input type="submit" value="Change" name="send" id="btnModifPass" class="btn btn-dark my-2">
                            <p></p>
                        </div>

                    </form>
                </div> <!-- /col -->
            </div> <!-- /row -->
        </div>

        <!-- Tab wishlist -->
        <div id="whishlist" class="tabcontent p-5">
            <h3>My Wishlist</h3>
            <div class="row wrap justify-content-between">
                <?php if (count($wishlist_items) > 0) : ?>
                    <?php foreach ($wishlist_items as $item) : ?>
                        <div class="col">
                            <a href="product.php?id=<?= $item['id_product'] ?>">
                                <p><?= $item['date'] ?></p>
                                <?= $item['title'] ?>
                            </a>
                            <img src="inc/img/shop/<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                            <p><?= $item['price'] / 100 ?>€</p>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col text-center">
                        <p>Your wishlist is empty!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>