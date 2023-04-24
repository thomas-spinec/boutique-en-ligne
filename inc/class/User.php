<?php
require_once 'Model.php';
class User extends Model
{
    protected $bdd;
    protected $tablename = 'user';
    private $id;
    private $login;
    private $firstname;
    private $lastname;
    private $address;
    private $city;
    private $country;
    private $zip;
    private $email;
    private $role;

    public function __construct()
    {
        parent::__construct();

        $this->id;
        $this->login;
        $this->firstname;
        $this->lastname;
        $this->address;
        $this->city;
        $this->country;
        $this->zip;
        $this->email;
        $this->role;

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
            $this->role = $_SESSION['user']['role'];
        }
    }


    // register new user
    public function register($login, $password, $email, $firstname, $lastname, $address, $city, $zip, $country)
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

        $register = "INSERT INTO $this->tablename (login, password, email, firstname, lastname, address, zip, city, country) VALUES
        (:login, :password, :email, :firstname, :lastname, :address, :zip, :city, :country)";
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
            ':zip' => $zip,
            ':city' => $city,
            ':country' => $country
        ]);
        echo "Successfully registered!";
        $this->bdd = null;
    }

    // Connection
    public function connect($login, $password)
    {
        // Récupérer le login
        $request = "SELECT * FROM $this->tablename WHERE login = :login";
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
            echo "error";
            die();
        }
        //  password verification
        if (password_verify($password, $result['password'])) {
            $_SESSION['user'] = [
                'id' => $result['id_user'],
                'login' => $result['login'],
                'firstname' => $result['firstname'],
                'lastname' => $result['lastname'],
                'address' => $result['address'],
                'city' => $result['city'],
                'country' => $result['country'],
                'zip' => $result['zip'],
                'email' => $result['email'],
                'role' => $result['role']
            ];
            echo "Successfull connection !";
        } else {
            echo "error";
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
            echo "indispo";
        } else {
            echo "dispo";
        }
        $this->bdd = null;
    }

    // check if user is admin
    public function isAdmin()
    {
        if ($this->role === "admin") {
            return true;
        } else {
            return false;
        }
    }

    // check if user is connected
    public function isLogged()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    // disconnect user
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    // get user data
    public function getLogin()
    {
        return $this->login;
    }

    // get user id
    public function getUserId()
    {
        return $this->id;
    }

    // get user firstname
    public function getFirstname()
    {
        return $this->firstname;
    }

    // get user lastname
    public function getLastname()
    {
        return $this->lastname;
    }

    // get user address
    public function getAddress()
    {
        return $this->address;
    }

    // get user city
    public function getCity()
    {
        return $this->city;
    }

    // get user country
    public function getCountry()
    {
        return $this->country;
    }

    // get user zip
    public function getZip()
    {
        return $this->zip;
    }

    // get user email
    public function getEmail()
    {
        return $this->email;
    }

    // get user role
    public function getRole()
    {
        return $this->role;
    }

    // Modification login
    public function updateLogin($login, $old, $password)
    {
        // requête
        $requete = "SELECT * FROM user where login = :old";

        // préparation de la requête
        $select = $this->bdd->prepare($requete);

        // htmlspecialchars pour les paramètres
        $old = htmlspecialchars($old);
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        // récupération du mot de passe avec ASSOC
        $select->execute(array(':old' => $old));
        $fetch_assoc = $select->fetch(PDO::FETCH_ASSOC);
        $password_hash = $fetch_assoc['password'];

        if (password_verify($password, $password_hash)) {
            // requête pour modifier le login dans la base de données
            $requete2 = "UPDATE user SET login=:login WHERE id=:id";
            // préparation de la requête
            $update = $this->bdd->prepare($requete2);
            // exécution de la requête avec liaison des paramètres
            $update->execute(array(
                ':login' => $login,
                ':id' => $this->id,
            ));
            // récupération des données pour les attribuer aux attributs
            $this->id = $fetch_assoc['id'];
            $this->login = $login;
            $this->$password = $fetch_assoc['password'];

            $_SESSION['user'] = [
                'id' => $fetch_assoc['id'],
                'login' => $login,
                'password' => $fetch_assoc['password'],
            ];
            // update réussie
            $error = "ok";
            echo $error;
        } else {
            $error = "incorrect";
            echo $error; // mot de passe incorrect
        }

        // fermer la connexion
        $this->bdd = null;
    }

    // Modification mot de passe
    public function updatePassword($password, $newPassword)
    {
        // requête
        $requete = "SELECT * FROM user where login = :login";

        // préparation de la requête
        $select = $this->bdd->prepare($requete);

        // htmlspecialchars pour les paramètres
        $login = htmlspecialchars($this->login);
        $password = htmlspecialchars($password);
        $newPassword = htmlspecialchars($newPassword);

        // récupération du mot de passe avec ASSOC
        $select->execute(array(':login' => $login));
        $fetch_assoc = $select->fetch(PDO::FETCH_ASSOC);
        $password_hash = $fetch_assoc['password'];

        if (password_verify(
            $password,
            $password_hash
        )) {
            // requête pour modifier le mdp dans la base de données
            $requete2 = "UPDATE user SET password=:password WHERE id=:id";
            // préparation de la requête
            $update = $this->bdd->prepare($requete2);
            // hash du nouveau mdp
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            // exécution de la requête avec liaison des paramètres
            $update->execute(array(
                ':password' => $newPassword,
                ':id' => $this->id,
            ));
            // récupération des données pour les attribuer aux attributs
            $this->id = $fetch_assoc['id'];
            $this->login = $login;
            $this->$password = $newPassword;

            $_SESSION['user'] = [
                'id' => $fetch_assoc['id'],
                'login' => $login,
                'password' => $newPassword,
            ];
            // update réussie
            $error = "ok";
            echo $error;
        } else {
            $error = "incorrect";
            echo $error; // mot de passe incorrect
        }


        // fermer la connexion
        $this->bdd = null;
    }


    public function getAll()
    {
        return parent::getAll();
    }

    public function deleteOne($id)
    {

        echo parent::deleteOne($id);
    }

    public function changeRole($newRole, $id)
    {

        $newRole = htmlspecialchars($newRole);
        $id = htmlspecialchars($id);
        $request = "UPDATE $this->tablename SET `role` = :role WHERE id_user=:id";

        $updateRole = $this->bdd->prepare($request);

        $updateRole->execute([
            ":role" => $newRole,
            ":id" => $id,
        ]);

        if ($updateRole) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
