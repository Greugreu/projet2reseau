<?php

include 'inc/forgot_password.inc.php';
include 'inc/header.php'; ?>

    <div class="wrap10">
    <h4 class="forgot_p">Mot de passe oublié</h4>

    <form id="form_forgot" action="" method="post">
        <label for="mail">Votre email</label>
        <input type="email" name="mail" id="mail" placeholder="email" value="<?php if (!empty($_POST['mail'])) { echo
        $_POST['mail'];}
        ?>">
        <p class="error"><?php if (!empty($errors['mail'])) {echo $errors['mail'];} ?></p>

        <input id="submit_forgot" type="submit" name="submitted" value="Modifier">
    </form>
    </div>

<?php include 'inc/footer.php';
