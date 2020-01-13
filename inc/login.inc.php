<?php
session_start();
require 'function/functions.php';
require 'inc/pdo.php';

$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {

    //XSS
    $login = clean($_POST['mail']);
    $password = clean($_POST['password']);

    if (empty($login || empty($password))) {
        $errors = 'Veuillez renseigner ces champs';
    } else {
        $sql = "SELECT * FROM user WHERE mail = :login";
        $query = $pdo->prepare($sql);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if (!empty($user)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['login'] = array(
                    'id' => $user['id'],
                    'nom' => $user['surname'],
                    'prenom' => $user['name'],
                    'ip' => $_SERVER['REMOTE_ADDR']
                );
            } else {
                $errors = 'Login ou mot de passe incorrect';
            }
        } else {
            $errors = 'Mail ou mot de passe incorrect';
        }
    }
}
