<?php
include 'inc/header.php';
include 'function/functions.php';
include 'inc/pdo.php';

?>

<div class="form">
    <form action="#" class="signup" method="post">
        <div class="surname">
            <label for="surname"></label>
            <input type="text" name="surname" id="surname" placeholder="Votre nom">
        </div>
        <div class="name">
            <label for="name"></label>
            <input type="text" name="name" id="name" placeholder="Votre prenom">
        </div>
        <div class="mail">
            <label for="mail"></label>
            <input type="email" name="mail" id="mail" placeholder="Votre mail">
        </div>
        <div class="password">
            <label for="password"></label>
            <input type="password" name="password" id="password" placeholder="Votre password">
        </div>
        <div class="cfrmPassword">
            <label for="cfrmPassword"></label>
            <input type="password" name="cfrmPassword" id="cfrmPassword" placeholder="Confirmez votre mdp">
        </div>
        <input type="submit" name="submitted" value="Envoyer">
    </form>
</div>

<?php

session_start();
$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {
    //XSS
    $name = clean($_POST['name']);
    $surname = clean($_POST['surname']);
    $mail = clean($_POST['mail']);
    $pwd = clean($_POST['password']);
    $cfrm = clean($_POST['cfrmPassword']);

    //validation
    textValid($errors, $name, 2, 50, 'name');
    textValid($errors, $surname, 2, 50, 'surname');
    cleanMail($errors, $mail, 'mail');

}
