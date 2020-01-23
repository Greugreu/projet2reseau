<?php
session_start();
include 'function/functions.php';
include 'function/debug.php';
require 'inc/pdo.php';

$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {

    //XSS
    $login = clean($_POST['mail']);
    $password = clean($_POST['password']);

    if (empty($login)) {
        $errors = 'Veuillez renseigner ce champ';
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
                    'role' => $user['role'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                );

                header('Location: index.php');

            } else {
                $errors = 'Login ou mot de passe incorrect';
            }
        } else {
            $errors = 'Mail ou mot de passe incorrect';
        }
    }
}
