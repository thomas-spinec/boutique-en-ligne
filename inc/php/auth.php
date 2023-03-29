<?php
session_start();
require_once "../class/User.php";

$user = new User();

// is user exist
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// register
