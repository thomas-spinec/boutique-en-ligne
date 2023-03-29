<?php

class User extends Model
{
    private $tablename = 'users';
    private $id;
    private $login;
    private $firstname;
    private $lastname;
    private $address;
    private $city;
    private $country;
    private $zip;
    private $email;

    public function __construct()
    {
        parent::__construct();

        // get user data
        if (isset($_SESSION['user'])) {
            $this->id = $_SESSION['user']['id'];
            $this->login = $_SESSION['user']['login'];
            $this->firstname = $_SESSION['user']['firstname'];
            $this->lastname = $_SESSION['user']['lastname'];
            $this->address = $_SESSION['user']['address'];
            $this->city = $_SESSION['user']['city'];
            $this->country = $_SESSION['user']['country'];
            $this->zip = $_SESSION['user']['zip'];
            $this->email = $_SESSION['user']['email'];
        }
    }


    // register new user
    public function register($login, $password, $email, $firstname, $lastname, $address, $city, $country, $zip)
    {
        // special characters
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $email = htmlspecialchars($email);
        $firstname = htmlspecialchars($firstname);
        $lastname = htmlspecialchars($lastname);
        $address = htmlspecialchars($address);
        $city = htmlspecialchars($city);
        $country = htmlspecialchars($country);
        $zip = htmlspecialchars($zip);

        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $register = "INSERT INTO $this->tablename (login, password, email, firstname, lastname, address, city, country, zip) VALUES
        (:login, :password, :email, :firstname, :lastname, :address, :city, :country, :zip)";
        // préparation de la requête             
        $insert = $this->bdd->prepare($register);
        // exécution de la requête avec liaison des paramètres
        $insert->execute([
            ':login' => $login,
            ':password' => $password,
            ':email' => $email,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':address' => $address,
            ':city' => $city,
            ':country' => $country,
            ':zip' => $zip
        ]);
        echo "Inscription réussie !";
        $this->bdd = null;
    }

    // Connexion
    public function connect($login, $password)
    {
        // Récupérer le login
        $request = "SELECT * FROM utilisateurs WHERE login = :login";
        // préparation de la requête
        $select = $this->bdd->prepare($request);

        // special characters
        $login = trim(htmlspecialchars($login));
        $password = trim(htmlspecialchars($password));

        // exécution de la requête avec liaison des paramètres
        $select->execute([
            ':login' => $login,
        ]);
        // récupération des résultats
        $result = $select->fetch(PDO::FETCH_ASSOC);
        // vérification de l'existence du login
        if (!$result) {
            echo "erreur";
            die();
        }
        //  password verification
        if (password_verify($password, $result['password'])) {
            $_SESSION['user'] = [
                'id' => $result['id'],
                'login' => $result['login'],
                'password' => $result['password']
            ];
            echo "Connexion réussie !";
        } else {
            echo "erreur";
        }
        $this->bdd = null;
    }

    // check if user exist
    public function isUserExist($login)
    {
        $request = "SELECT * FROM $this->tablename WHERE login = :login";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ':login' => $login
        ]);
        $result = $select->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "Ce login est déjà utilisé";
        } else {
            echo "Ce login est disponible";
        }
        $this->bdd = null;
    }

    // get one user

}
