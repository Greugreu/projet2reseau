<?php

include('function/functions.php');
include('inc/pdo.php');
require_once ("inc/header.php");
include 'inc/contact.inc.php';
?>

<section id="background">
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
        <div class="mail2">
            <i class="material-icons">&#xe0be;</i>
            <p class="email">dcrypt@gmail.com</p>
        </div>
    </div>
</div>
</section>

<?php
require_once("inc/footer.php");
