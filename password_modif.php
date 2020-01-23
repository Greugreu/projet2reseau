<?php
session_start();
require 'inc/pdo.php';
require 'function/functions.php';

$title = 'Mote de passe oublié';
$errors = array();
$success = false;

include 'inc/header.php';

if (!empty($_GET['token'] && !empty($_GET['mail']))) {
    $token_url = urldecode($_GET['token']);
    $email_url = $_GET['mail'];
    $sql = "SELECT mail, token FROM user WHERE mail = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email_url, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user['mail'] === $email_url && $user['token'] === $token_url) { ?>

        <div class="backgroundMdp">
            <div class="wrapMdp">
                <h3 class="h3Mdp">Mot de passe oublie :</h3>

                <form class="newPassword" action="" method="post">

                    <label class="passwordModif passwordModif1" for="password">Nouveau mot de passe : </label>
                    <input class="pwdModif pwdModif1" type="password" name="password" id="password">

                    <label class="passwordModif passwordModif2" for="password2">Confirmez mot de passe : </label>
                    <input class="pwdModif pwdModif2" type="password" name="password2" id="password2">

                    <input class="inputPwd" type="submit" name="submitted" value="Envoyer">

                </form>
            </div>
        </div>

        <?php require_once ("inc/footer.php");?>
        <?php
        if (!empty($_POST['submitted'])) {
            $password1 = clean($_POST['password']);
            $password2 = clean($_POST['password2']);
            if (empty($_POST['password'])) {
                $errors['password'] = 'Veuillez renseigner ce champ';
            } elseif (empty($_POST['password2'])) {
                $errors['password'] = 'Veuillez renseigner ce champ';
            } elseif ($password1 != $password2) {
                $errors['password'] = 'Les mots de passes ne sont pas identiques';
            } else {
                if (count($errors) === 0) {
                    $hash = password_hash($password1, PASSWORD_BCRYPT);
                    $token = generateRandomString(255);
                    $sql = "UPDATE user SET password = :pass, token = :token";
                    $query = $pdo->prepare($sql);
                    $query->bindValue(':pass', $hash, PDO::PARAM_STR);
                    $query->bindValue(':token', $token, PDO::PARAM_STR);
                    $query->execute();
                }
            }
        }
    }
} else {
    die('Erreur dans le formulaire');
}


