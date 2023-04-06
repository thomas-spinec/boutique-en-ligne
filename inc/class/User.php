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
        echo "Successfully registered!";
        $this->bdd = null;
    }

    // Connexion
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

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getAll()
    {
       return parent::getAll();
    }

    public function deleteOne($id){

        echo parent::deleteOne($id);


    }

    public function changeRole($id){

        echo parent::changeRole($id);


    }

    
}
