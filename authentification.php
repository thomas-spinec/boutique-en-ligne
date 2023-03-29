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