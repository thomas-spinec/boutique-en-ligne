<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/profil.js"></script>
</head>
<body>        
    <?php include 'inc/header.php'; ?>

    <?php
    if(!$user->isLogged()){
       /*  header('Location: index.php'); */
    }
    ?>

    <main class="container">

        <h1 class="title">Profile</h1>

        <div class="row wrap">

            <div id="login" class="col">
                <?php $login = $user->getLogin(); ?>

                <form action="" method="post" id="loginForm" class="col">
                    <h2 class="mb-1">Change login</h2>
                    <label for="login">login</label>
                    <input type="text" name="login" class="login" value="<?= $login ?>" required>
                    <p></p>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="password" placeholder="Password" required>
                    <p></p>
                    <input type="submit" value="Change" name="send" id="btnModifLogin">
                    <p></p>
                </form>

                <form action="" method="post" id="passwordForm" class="col my-2">
                    <h2 class="mb-1">Change password</h2>
                    <label for="password">Current password</label>
                    <input type="password" name="password" class="password" placeholder="Password" id="oldPassword" required>
                    <p></p>
                    <div class="row wrap">
                        <div class="col gap">
                            <label for="newPassword">New password</label>
                            <input type="password" name="newPassword" id="newPassword" class="password" placeholder="New password" required>
                            <p></p>
                        </div>
                        <div class="col gap">
                            <label for="newPassword2">Confirmation</label>
                            <input type="password" name="newPassword2" id="newPassword2" class="password" placeholder="Confirmation" required>
                            <p></p>
                        </div>
                    </div>
                    <input type="submit" value="Change" name="send" id="btnModifPass">
                    <p></p>
                </form>
            </div> <!-- /col -->
        </div> <!-- /row -->

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>