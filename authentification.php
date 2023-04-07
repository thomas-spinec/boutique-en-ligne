<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="inc/js/auth.js"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>

<body>

    
    <div class="wrapper">
        
        <?php include 'inc/header.php'; ?>

        <main class="container">

            <section id="inscription" class="colcenter">

                <h1>Inscription</h1>

                <div class="row m-2">
                    <p><b>Already a member ? </b></p> <button id="switchConn" class="switch">Connexion</button>
                </div>

                <form method="post" class="auth_form">
                    <label for="login">login</label>
                    <input type="text" name="login" class="login" placeholder="login" required>
                    <p></p>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="password" placeholder="Mot de passe" autocomplete="off" required>
                    <p></p>
                    <label for="password2">Password confirm</label>
                    <input type="password" name="password2" id="password2" class="password" placeholder="Confirmation" autocomplete="off" required>
                    <p></p>
                    <br>
                    <label for="firstname">firstname:</label>
                    <input type="text" name="firstname" id="firstname" class="firstname" placeholder="Prénom" required>
                    <p></p>
                    <label for="lastname">lastname:</label>
                    <input type="text" name="lastname" id="lastname" class="lastname" placeholder="Nom" required>
                    <p></p>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="email" placeholder="Email" required>
                    <p></p>
                    <label for="address">Adress:</label>
                    <input type="text" name="address" id="address" class="address" placeholder="Adresse" required>
                    <p></p>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" class="city" placeholder="Ville" required>
                    <p></p>
                    <label for="zip">Zip:</label>
                    <input type="text" name="zip" id="zip" class="zip" placeholder="Code postal" required>
                    <p></p>
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" class="country" placeholder="Pays" required>
                    <p></p>
                    <input type="submit" value="Register" name="send" id="btnInsc">
                    <p></p>
                </form>
                <br>
            </section>

            <!--------------------------------------------------------------------->

            <section id="connexion" class="colcenter">

                <h1>Connexion</h1>

                <div class="row m-2">
                    <p><b>You don't have an account ? </b></p> <button id="switchInsc" class="switch">Inscription</button>
                </div>

                <form method="post" class="auth_form">
                    <label for="login">login</label>
                    <input type="text" name="login" class="login" placeholder="login" required>
                    <p></p>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="password" placeholder="Mot de passe" required>
                    <p></p>
                    <input type="submit" value="Connect" id="btnConn">
                    <p></p>
                </form>
                <br>
            </section>

        </main>

        <div class="push"></div>

    </div> <!-- wrapper -->

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>