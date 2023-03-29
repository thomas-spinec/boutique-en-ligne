<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">

            <main>
                <section id="inscription" class="colcenter">

                    <h1>Inscription</h1>

                    <div class="row m-2">
                        <p><b>Vous avez déjà un compte ? </b></p> <button id="switchConn" class="switch">Connexion</button>
                    </div>

                    <form method="post" class="auth_form">
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" placeholder="login" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" autocomplete="off" required>
                        <p></p>
                        <label for="password2">Confirmation du mot de passe</label>
                        <input type="password" name="password2" id="password2" class="password" placeholder="Confirmation" autocomplete="off" required>
                        <p></p>
                        <br>
                        <label for="firstname">Prénom:</label>
                        <input type="text" name="firstname" id="firstname" class="firstname" placeholder="Prénom" required>
                        <p></p>
                        <label for="lastname">Nom:</label>
                        <input type="text" name="lastname" id="lastname" class="lastname" placeholder="Nom" required>
                        <p></p>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="email" placeholder="Email" required>
                        <p></p>
                        <label for="address">Adresse:</label>
                        <input type="text" name="address" id="address" class="address" placeholder="Adresse" required>
                        <p></p>
                        <label for="city">Ville:</label>
                        <input type="text" name="city" id="city" class="city" placeholder="Ville" required>
                        <p></p>
                        <label for="zip">Code postal:</label>
                        <input type="text" name="zip" id="zip" class="zip" placeholder="Code postal" required>
                        <p></p>
                        <label for="country">Pays:</label>
                        <input type="text" name="country" id="country" class="country" placeholder="Pays" required>
                        <p></p>
                        <input type="submit" value="S'inscrire" name="send" id="btnInsc">
                        <p></p>
                    </form>
                    <br>
                </section>

                <!--------------------------------------------------------------------->

                <section id="connexion" class="colcenter">

                    <h1>Connexion</h1>

                    <div class="row m-2">
                        <p><b>Vous n'avez pas encore de compte ? </b></p> <button id="switchInsc" class="switch">Inscription</button>
                    </div>

                    <form method="post" class="auth_form">
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" placeholder="login" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" required>
                        <p></p>
                        <input type="submit" value="Se connecter" id="btnConn">
                        <p></p>
                    </form>
                    <br>
                </section>

            </main>
        </div>
        <div class="push"></div>
    </div>

</body>

</html>