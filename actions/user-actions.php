<?php
include "../classes/User.php";

if(isset($_POST['register'])){
    //register
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user = new User;

    $user->createUser($first_name, $last_name, $username, $password);
}elseif(isset($_POST['login'])){
    // login
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User;

    $user->login($username, $password);
}
?>