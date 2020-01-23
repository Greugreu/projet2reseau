<?php
require_once ('function/functions.php');
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
    $errors = textValid($errors, $name, 2, 50, 'name');
    $errors = textValid($errors, $surname, 2, 50, 'surname');
    $errors = cleanMail($errors, $mail, 'mail');
    if(!isset($_POST['checklog'])){
        $errors['checklogErr'] = "Merci d'accepter les conditions";
    }

    if (!empty($mail)) {
        $sql = "SELECT id FROM user WHERE mail = :mail LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->bindValue(':mail', $mail, PDO::PARAM_STR);
        $query->execute();
        $check = $query->fetch();

        if (!empty($check)) {
            $errors['mail'] = 'Cette adresse existe déjà';
        }
    }

    $errors = passwordValid($pwd, $errors, 6, 'password');

    if (!empty($pwd)) {
        if ($pwd !== $cfrm) {
            $errors['cfrmPassword'] = 'Les deux mots de passe ne correspondent pas';
        }
    }

    if (count($errors) === 0) {
        $hash = password_hash($pwd, PASSWORD_BCRYPT);
        $token = generateRandomString(255);

        $sql = "INSERT INTO user VALUES (NULL, :name, :surname, :mail, :pwd, :token, 'user' , NOW(), NULL)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':surname', $surname, PDO::PARAM_STR);
        $query->bindValue(':mail', $mail, PDO::PARAM_STR);
        $query->bindValue(':pwd', $hash, PDO::PARAM_STR);
        $query->bindValue(':token', $token, PDO::PARAM_STR);
        $query->execute();

        $success = true;

        //redirection
        header('Location: index.php');
    }

}
