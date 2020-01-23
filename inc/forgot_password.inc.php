<?php
session_start();

require 'inc/pdo.php';
require 'function/functions.php';

$title = 'Mote de passe oublié';
$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {
    $email = clean($_POST['mail']);
    $sql = "SELECT mail, token FROM user WHERE mail = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (!empty($user)) {
        $token = $user['token'];
        $email = urlencode($user['mail']);
        $html = '<div class="wrap10"><p class="here"><a href="password_modif.php?token='.$token.'&mail='.$email.'">C\'est ici</a></p></div>';
        echo $html;
    } else {
        $errors['email'] = 'Email inconnu';
    }
}
