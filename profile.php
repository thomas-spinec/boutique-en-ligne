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
    <script src="inc/js/profil.js"></script>
    <script>
        function openTab(evt, information) {
        let i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";}
            
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");}

        document.getElementById(information).style.display = "block";
            evt.currentTarget.className += " active";}
    </script>
</head>
<body>        
    <?php include 'inc/header.php'; ?>

    <?php
    if(!$user->isLogged()){
       /*  header('Location: index.php'); */
    }
    ?>

    <div class="hero_profile"><div class="bg-dark h-100 w-100 opacity-50"></div></div>

    <main class="container bg-light p-5">

        <h1 class="h1-responsive">Profile</h1>
        <h1 class="h1-responsive bis">Profile</h1>
        <h4 class="mb-5">Welcome <?= $user->getLogin() ?></h4>

        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'infos')">Informations</button>
            <button class="tablinks" onclick="openTab(event, 'orders')">Orders</button>
            <button class="tablinks" onclick="openTab(event, 'login')">Change Login</button>
            <button class="tablinks" onclick="openTab(event, 'password')">Change Password</button>
        </div>

        <!-- Tab infos -->
        <div id="infos" class="tabcontent p-5">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                    <p class="text-muted">Login: <?php $user->getLogin(); ?></p>
                    <p class="text-muted">First Name: <?php $user->getFirstName(); ?></p>
                    <p class="text-muted">Last Name: <?php $user->getLastName(); ?></p>
                    <p class="text-muted">E-mail: <?php $user->getEmail(); ?></p>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                    <P class="text-muted">Address: <?php $user->getAddress(); ?></p>
                    <p class="text-muted">ZipCode: <?php $user->getZip(); ?></p>
                    <p class="text-muted">City: <?php $user->getCity(); ?></P>
                    <p class="text-muted">Country: <?php $user->getCountry(); ?></p>
                </div>
            </div>
        </div>

        <!-- Tab orders -->
        <div id="orders" class="tabcontent p-5">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                    <p class="text-muted">Order ID:</p>
                    <p class="text-muted">Order Date:</p>
                    <p class="text-muted">Order Total:</p>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 bg-white p-3 my-1 shadow">
                    <p class="text-muted">Shipping Address: </p>
                    <p class="text-muted">Billing Address: </p>
                </div>
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

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>