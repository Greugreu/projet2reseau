<?php

$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {
    $email = clean($_POST['email']);
    $object = clean($_POST['object']);
    $text = clean($_POST['message']);

    $errors = textValid($errors, $text, 5, 20, 'message');
    $errors = objectValid($errors, $object, 2, 50, 'object');
    $errors = emailValid($errors, $email, 'email');

    if (count($errors) === 0) {
        $sql = "INSERT INTO contact VALUES (NULL, :contactMail, :contactObjet, :contactMessage, NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':contactMail', $email, PDO::PARAM_STR);
        $query->bindValue(':contactObjet', $object, PDO::PARAM_STR);
        $query->bindValue(':contactMessage', $text, PDO::PARAM_STR);
        $query->execute();
        $success = true;
    }
}
