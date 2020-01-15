<?php

include('function/functions.php');
include('inc/pdo.php');



$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {
    $email = clean($_POST['email']);
    $object = clean($_POST['object']);
    $text = clean($_POST['message']);

    $errors = textValid($errors, $text, 5, 20, 'message');
    $errors = objectValid($errors, $object, 2, 50, 'object');
    $errors = emailValid($errors, $email, 'email');

    if(count($errors) === 0) {
        $sql = "INSERT INTO contact VALUES (NULL, :contactMail, :contactObjet, :contactMessage, NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':contactMail',   $email,PDO::PARAM_STR);
        $query->bindValue(':contactObjet', $object, PDO::PARAM_STR);
        $query->bindValue(':contactMessage', $text,PDO::PARAM_STR);
        $query->execute();
        $success = true;
    }
}


require_once ("inc/header.php");?>

<h1 class="contact_title">Contactez-nous !</h1>
<div class="barre"></div>
<div class="wrap3">
    <div class="contact">
        <form action="" method="post">

            <input type="text" id="email" name="email" placeholder="Votre email" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">
                <p class="error error1"> <?php if(!empty($errors['email'])) {echo $errors['email'];} ?></p>

            <input type="text" placeholder="Objet" id="object" name="object" value="<?php if (!empty($_POST['object'])) {echo $_POST['object'];} ?>">
                <p class="error error3"><?php if(!empty($errors['object'])) {echo $errors['object'];} ?></p>

            <textarea id="message" placeholder="Votre message" name="message"><?php if (!empty($_POST['message'])) {echo $_POST['message'];} ?></textarea>
                <p class="error error3"><?php if(!empty($errors['message'])) {echo $errors['message'];} ?></p>

            <input id="submit_contact" type="submit" name="submitted" value="Envoyer">

    </div>

    <div class="adress">
        <div class="phone">
            <i class="material-icons">&#xe325;</i>
            <p class="tel">06.35.48.62.46</p>
        </div>
        <div class="mail">
            <i class="material-icons">&#xe0be;</i>
            <p class="email">dcrypt@gmail.com</p>
        </div>
    </div>



<?php require_once("inc/footer.php");?>
